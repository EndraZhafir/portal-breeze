<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // untuk dashboard notifikasi
    public function dashboard()
    {
        $user = auth()->user();
        $notifications = [];
        if ($user->role === 'admin') {
            $notifications = $user->notifications;
        }
        return view('dashboard', compact('notifications'));
    }

    // dismiss notification
    public function dismissNotification($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
            return back()->with('success', 'Notifikasi berhasil dihapus.');
        }
        return back()->with('error', 'Notifikasi tidak ditemukan.');
    }
}
