<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JobVacancy;
use App\Models\Application;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $unreadNotifications = $user->unreadNotifications;

            $stats = [
                'total_jobs' => JobVacancy::count(),
                'total_applicants' => Application::count(),
                'total_users' => User::where('role', '!=', 'admin')->count(),
            ];

            return view('dashboard', compact('unreadNotifications', 'stats'));
        }

        $myApplicationsCount = Application::where('user_id', $user->id)->count();

        return view('dashboard', compact('myApplicationsCount'));
    }
}