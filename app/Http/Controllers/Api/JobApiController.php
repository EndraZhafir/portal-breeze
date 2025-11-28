<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class JobApiController extends Controller
{
    /**
    * @OA\Get(
    *      path="/api/jobs",
    *      summary="Get all job listings",
    *      tags={"Jobs"},
    *      security={{"bearerAuth":{}}},
    *      @OA\Parameter(
    *        name="company",
    *        in="query",
    *        description="Filter by company name",
    *        @OA\Schema(type="string", example="ACME")
    *      ),
    *      @OA\Parameter(
    *        name="location",
    *        in="query",
    *        description="Filter by location",
    *        @OA\Schema(type="string", example="Jakarta")
    *      ),
    *      @OA\Parameter(
    *        name="page",
    *        in="query",
    *        description="Page number",
    *        @OA\Schema(type="integer", default=1, example=2)
    *      ),
    *      @OA\Parameter(
    *        name="per_page",
    *        in="query",
    *        description="Items per page",
    *        @OA\Schema(type="integer", default=10, example=5)
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="List of jobs",
    *          @OA\JsonContent(
    *              type="array",
    *              @OA\Items(
    *                  @OA\Property(property="id", type="integer"),
    *                  @OA\Property(property="title", type="string"),
    *                  @OA\Property(property="company", type="string"),
    *                  @OA\Property(property="location", type="string")
    *              )
    *          )
    *      )
    *   )
    */
    public function index(Request $request)
    {
        $q = JobVacancy::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $q->where(function ($s) use ($keyword) {
                $s->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('company', 'like', '%' . $keyword . '%')
                  ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('company')) {
            $q->where('company', 'like', '%' . $request->company . '%');
        }

        if ($request->filled('location')) {
            $q->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $q->orderBy('created_at', 'desc')->paginate($request->get('per_page', 10));

        return response()->json($jobs);
    }

    /**
     * @OA\Get(
     *   path="/api/jobs/{job}",
     *   tags={"Jobs"},
     *   summary="Get job detail",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="job",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Job details"),
     *   @OA\Response(response=404, description="Job not found")
     * )
     */
    public function show(JobVacancy $job)
    {
        return response()->json($job, 200);
    }

    /**
     * @OA\Post(
     *   path="/api/jobs",
     *   tags={"Jobs"},
     *   summary="Create new job (Admin only)",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"title","description","location","company"},
     *       @OA\Property(property="title", type="string", example="Frontend Developer"),
     *       @OA\Property(property="description", type="string", example="Vue/React experience"),
     *       @OA\Property(property="location", type="string", example="Jakarta"),
     *       @OA\Property(property="company", type="string", example="ACME"),
     *       @OA\Property(property="salary", type="integer", example=12000000)
     *     )
     *   ),
     *   @OA\Response(response=201, description="Job created"),
     *   @OA\Response(response=403, description="Unauthorized")
     * )
     */
    public function store(Request $request)
    {
        // Check if the user is admin
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'title' => 'required|required|string',
            'description' => 'required|required|string',
            'location' => 'required|required|string',
            'company' => 'required|required|string',
            'salary' => 'nullable|integer',
        ]);

        $job = JobVacancy::create($data);
        return response()->json(['message' => 'Created', 'job' => $job], 201);
    }

    /**
     * @OA\Put(
     *   path="/api/jobs/{job}",
     *   tags={"Jobs"},
     *   summary="Update job (Admin only)",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="job",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     @OA\JsonContent(
     *       @OA\Property(property="title", type="string"),
     *       @OA\Property(property="description", type="string"),
     *       @OA\Property(property="location", type="string"),
     *       @OA\Property(property="company", type="string"),
     *       @OA\Property(property="salary", type="integer")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Job updated"),
     *   @OA\Response(response=403, description="Unauthorized")
     * )
     */
    public function update(Request $request, JobVacancy $job)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'title' => 'required|required|string',
            'description' => 'required|required|string',
            'location' => 'required|required|string',
            'company' => 'required|required|string',
            'salary' => 'nullable|integer',
        ]);

        $job->update($data);
        return response()->json(['message' => 'Updated', 'job' => $job], 200);
    }

    /**
     * @OA\Delete(
     *   path="/api/jobs/{job}",
     *   tags={"Jobs"},
     *   summary="Delete job (Admin only)",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *     name="job",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=204, description="Job deleted"),
     *   @OA\Response(response=403, description="Unauthorized")
     * )
     */
    public function destroy(Request $request, JobVacancy $job)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job->delete();
        return response()->json(['message' => 'Deleted'], 204);
    }

    /**
     * @OA\Get(
     *   path="/api/public/jobs",
     *   tags={"Jobs"},
     *   summary="Get all jobs (Public - No authentication)",
     *   @OA\Parameter(
     *     name="company",
     *     in="query",
     *     description="Filter by company",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="location",
     *     in="query",
     *     description="Filter by location",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="page",
     *     in="query",
     *     @OA\Schema(type="integer", default=1)
     *   ),
     *   @OA\Parameter(
     *     name="per_page",
     *     in="query",
     *     @OA\Schema(type="integer", default=10)
     *   ),
     *   @OA\Response(response=200, description="List of jobs")
     * )
     */
    public function publicIndex(Request $request)
    {
        $q = JobVacancy::query();

        if ($request->filled('company')) {
            $q->where('company', 'like', '%' . $request->company . '%');
        }

        if ($request->filled('location')) {
            $q->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $q->orderBy('created_at', 'desc')->paginate($request->get('per_page', 10));
        return response()->json($jobs);
    }
}
