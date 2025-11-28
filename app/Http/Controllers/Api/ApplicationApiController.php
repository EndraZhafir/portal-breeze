<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationApiController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/applications",
     *   tags={"Applications"},
     *   summary="Get all applications (Admin only)",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     @OA\Schema(type="integer", default=10)
     *   ),
     *   @OA\Response(response=200, description="List of applications"),
     *   @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function index (Request $request)
    {
        // Admin view all applications
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $apps = Application::with(['user','job'])
            ->latest()
            ->paginate($request->get('per_page', 10));

        return response()->json($apps);
    }

    /**
     * @OA\Post(
     *   path="/api/jobs/{job}/apply",
     *   tags={"Applications"},
     *   summary="Apply for job",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="job",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         @OA\Property(property="cv", type="string", format="binary")
     *       )
     *     )
     *   ),
     *   @OA\Response(response=201, description="Application submitted"),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store (Request $request, JobVacancy $job)
    {
        // Job Seeker apply (upload CV optional via API multipart)
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $app = Application::create([
            'user_id'   => $request->user()->id,
            'job_id'    => $job->id,
            'cv'        => $cvPath,
            'status'    => 'Pending'
        ]);

        return response()->json(['message' => 'Application submitted', 'application' => $app], 201);
    }

    /**
     * @OA\Patch(
     *   path="/api/applications/{id}/status",
     *   tags={"Applications"},
     *   summary="Update application status (Admin only)",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"status"},
     *       @OA\Property(property="status", type="string", enum={"Accepted","Rejected"}, example="Accepted")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Status updated"),
     *   @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'status' => 'required|in:Accepted,Rejected'
        ]);

        $app = Application::findOrFail($id);
        $app->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated', 'application' => $app], 200);
    }
}