<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobVacancy as Job;
use Illuminate\Support\Facades\Auth;
use App\Exports\ApplicationsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\JobAppliedMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendApplicationMailJob;
use App\Models\User;
use App\Notifications\NewApplicationNotification;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
     * export applications ke Excel.
     */
    public function export(Request $request)
    {
        if (Auth::user()->role != 'admin') {abort(403);}        
        $jobId = $request->input('job_id');
        
        if ($jobId !== null && $jobId !== '') {
            if (!ctype_digit($jobId)) {
                return back()->withErrors(['job_id' => 'Job ID tidak valid.']);
            }
            $jobId = (int)$jobId;
        } else {
            $jobId = null;
        }

        $fileName = $jobId ? 'applications_job_' . $jobId . '.xlsx' : 'applications_all.xlsx';
        try {
            return Excel::download(new ApplicationsExport($jobId), $fileName);
        } catch (\Throwable $e) {
            return back()->withErrors(['export' => 'Export gagal: '.$e->getMessage()]);
        }
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
            'user_id' => auth()->id(),
            'job_id' => $jobId,
            'cv' => $cvPath,
        ]);

        // Kirim email ke pelamar (via queue)
        dispatch(new SendApplicationMailJob($application->job, auth()->user()));

        // Kirim notifikasi ke admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new NewApplicationNotification($application));
        }

        return back()->with('success', 'Lamaran berhasil dikirim! Cek email Anda. Good Luck.');
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
    if (Auth::user()->role != 'admin') {abort(403, 'Hanya admin yang bisa update.');}

        $request->validate(['status' => 'required|in:Accepted,Rejected',]);

        $application->update(['status' => $request->status]);

        return redirect()->route('applications.index')->with('success', 'Status pelamar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        if (Auth::user()->role != 'admin') { 
            abort(403, 'Hanya admin yang bisa menghapus.'); 
        }

        // Hapus file CV dari storage
        if ($application->cv && \Storage::disk('public')->exists($application->cv)) {
            \Storage::disk('public')->delete($application->cv);
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Lamaran berhasil dihapus.');
    }
}
