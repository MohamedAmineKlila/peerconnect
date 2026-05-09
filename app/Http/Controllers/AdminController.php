<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Models\Connection;
use App\Models\ContactMessage;
use App\Models\Interest;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Report;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'usersCount' => User::where('role', '!=', 'admin')->count(),
            'studentsCount' => User::where('role', 'student')->count(),
            'teachersCount' => User::where('role', 'teacher')->count(),
            'profilesCount' => Profile::count(),
            'matchesCount' => Connection::where('status', 'matched')->count(),
            'likesCount' => Connection::where('status', 'liked')->count(),
            'messagesCount' => Message::count(),
            'interestsCount' => Interest::count(),
            'reportsCount' => Report::count(),
            'pendingReportsCount' => Report::where('status', 'pending')->count(),
            'contactMessagesCount' => ContactMessage::count(),
            'recentUsers' => User::where('role', '!=', 'admin')->latest()->take(8)->get(),
            'recentReports' => Report::with(['reporter', 'reported'])->latest()->take(5)->get(),
            'recentLogs' => AccessLog::with('user')->latest()->take(12)->get(),
        ]);
    }

    public function exportAccessLogs(): StreamedResponse
    {
        $fileName = 'peerconnect-access-logs-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'User', 'Role', 'Method', 'Path', 'Route', 'Status', 'IP', 'User Agent', 'Date']);

            AccessLog::with('user')->latest()->chunk(200, function ($logs) use ($handle) {
                foreach ($logs as $log) {
                    fputcsv($handle, [
                        $log->id,
                        $log->user?->email ?? 'Guest',
                        $log->user?->role ?? 'guest',
                        $log->method,
                        $log->path,
                        $log->route_name,
                        $log->status_code,
                        $log->ip_address,
                        $log->user_agent,
                        $log->created_at?->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
