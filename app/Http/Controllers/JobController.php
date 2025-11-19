<?php

namespace App\Http\Controllers;

use App\Imports\JobsImport;
use Illuminate\Http\Request;
use App\Models\JobVacancy as Job;
use Illuminate\Support\Facades\Storage;
use App\Imports\JobsImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'job_type' => 'required|in:Full-time,Part-time',
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'job_type'=> $request->job_type,
            'logo' => $logoPath,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'company' => 'required',
            'job_type' => 'required|in:Full-time,Part-time',
            'logo' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $job = Job::findOrFail($id);

        if ($request->hasFile('logo')) {
            if ($job->logo && Storage::disk('public')->exists($job->logo)) {
                Storage::disk('public')->delete($job->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $job->logo = $logoPath;
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company' => $request->company,
            'salary' => $request->salary,
            'job_type'=> $request->job_type,
            'logo' => $job->logo,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);

        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new JobsImport, $request->file('file'));
        } catch (\Throwable $e) {
            return back()->withErrors(['file' => 'Import gagal: '.$e->getMessage()])->withInput();
        }

        return back()->with('success', 'Lowongan berhasil diimpor!');
    }

    public function downloadTemplate()
    {
        $headings = [
            'title', 
            'description',
            'company', 
            'location', 
            'jenis_pekerjaan',
            'salary',  
        ];

        $data = [
            $headings,
            ['Backend Developer', 'Mengembangkan dan maintain aplikasi backend', 'PT. Tech Indonesia', 'Jakarta', 'Full-time', 8000000],
            ['Frontend Developer', 'Membuat tampilan website yang menarik', 'PT. Digital Media', 'Bandung', 'Part-time', 5000000]
        ];

        $export = new class($data) implements FromArray {
            protected $data;
            public function __construct($data) { $this->data = $data; }
            public function array(): array { return $this->data; }
        };

        return Excel::download($export, 'template_import_jobs.xlsx');
    }
}
