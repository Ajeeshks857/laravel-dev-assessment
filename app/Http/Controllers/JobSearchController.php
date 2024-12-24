<?php

namespace App\Http\Controllers;

use App\Models\JobDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JobSearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $cacheKey = 'jobs_search_' . md5(json_encode($request->all()));
            $jobs     = Cache::get($cacheKey);

            if (!$jobs) {
                $query = JobDetail::query();

                if ($request->has('title') && $request->input('title') !== '') {
                    $query->where('title', 'like', '%' . $request->input('title') . '%');
                }

                if ($request->has('location') && $request->input('location') !== '') {
                    $query->where('location', 'like', '%' . $request->input('location') . '%');
                }

                $jobs = $query->with('skills')->get();
                $jobs = $jobs->map(function ($job) {
                    $job->extra_info = json_decode($job->extra_info);
                    return $job;
                });

                Cache::put($cacheKey, $jobs, now()->addMinutes(60));
            }

            return response()->json(['jobs' => $jobs]);

        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'An error occurred while processing your request.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
