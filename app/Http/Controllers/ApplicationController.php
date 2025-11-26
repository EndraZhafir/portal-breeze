<?php

namespace App\Http\Controllers;

use App\Exports\ApplicationsExport;
use App\Jobs\SendApplicationMailJob;
use App\Jobs\SendApplicationStatusMailJob;
use App\Mail\JobAppliedMail;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\JobVacancy as Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\NewApplicationNotification;
use App\Models\User;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $applications = [];
        $jobs = [];

        if ($user->role == 'admin') {
            $applications = Application::with('user', 'job')->get();
            $jobs = Job::all();
        } else {
            $applications = Application::with('user', 'job')->where('user_id', $user->id)->get();
        }

        return view('applications.index', compact('applications', 'jobs'));
    }

    /**
     * Export applications to an Excel file (admin only).
     */
    public function export(Request $request)
    {
        return Excel::download(new ApplicationsExport(), 'applications.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $jobId)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');
        $application = Application::create([
            'user_id' => Auth::id(),
            'job_id' => $jobId,
            'cv' => $cvPath,
        ]);

        $admin = User::where('role', 'admin')->first();
        $admin->notify(new NewApplicationNotification($application));

        dispatch(new SendApplicationMailJob($application->job, Auth::user()))->delay(now()->addSeconds(5));

        // Kirim email ke user
        // Mail::to(Auth::user()->email)
        //     ->send(new JobAppliedMail(
        //         $application->job,
        //         Auth::user()
        //     ));

        return back()->with('success', 'Lamaran berhasil dikirim! Cek email Anda.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Hanya admin yang bisa update.');
        }

        $request->validate([
            'status' => 'required|in:Accepted,Rejected',
        ]);

        $application->update(['status' => $request->status]);

        dispatch(new SendApplicationStatusMailJob($application))->delay(now()->addSeconds(2));

        return redirect()->route('applications.index')->with('success', 'Status pelamar berhasil diupdate & notifikasi dikirim.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Hanya admin yang bisa menghapus.');
        }

        if ($application->cv && Storage::disk('public')->exists($application->cv)) {
            Storage::disk('public')->delete($application->cv);
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil dihapus.');
    }
}
