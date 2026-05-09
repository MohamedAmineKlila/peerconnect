<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('profiles.index');
        }

        $targetRole = $user->role === 'student' ? 'teacher' : 'student';
        $reactedUserIds = Connection::where('sender_id', $user->id)->pluck('receiver_id');

        $currentProfile = Profile::with(['user', 'interests'])
            ->whereHas('user', fn ($query) => $query->where('role', $targetRole))
            ->where('user_id', '!=', $user->id)
            ->whereNotIn('user_id', $reactedUserIds)
            ->inRandomOrder()
            ->first();

        $remainingCount = Profile::whereHas('user', fn ($query) => $query->where('role', $targetRole))
            ->where('user_id', '!=', $user->id)
            ->whereNotIn('user_id', $reactedUserIds)
            ->count();

        $previewProfiles = Profile::with(['user', 'interests'])
            ->whereHas('user', fn ($query) => $query->where('role', $targetRole))
            ->where('user_id', '!=', $user->id)
            ->latest()
            ->take(4)
            ->get();

        $matches = Connection::with(['sender.profile', 'receiver.profile'])
            ->where('status', 'matched')
            ->where(fn ($query) => $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id))
            ->latest()
            ->get();

        $respondedUserIds = Connection::where('sender_id', $user->id)->pluck('receiver_id');
        $incomingLikes = Connection::with(['sender.profile.interests'])
            ->where('receiver_id', $user->id)
            ->where('status', 'liked')
            ->whereNotIn('sender_id', $respondedUserIds)
            ->latest()
            ->get();

        $ownProfile = $user->profile;
        $likesSentCount = Connection::where('sender_id', $user->id)->where('status', 'liked')->count();
        $passesCount = Connection::where('sender_id', $user->id)->where('status', 'passed')->count();

        return view('dashboard.index', compact('currentProfile', 'remainingCount', 'previewProfiles', 'matches', 'incomingLikes', 'ownProfile', 'targetRole', 'user', 'likesSentCount', 'passesCount'));
    }

    public function react(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'status' => ['required', 'in:liked,passed'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $user = Auth::user();
        $oppositeLike = Connection::where('sender_id', $profile->user_id)
            ->where('receiver_id', $user->id)
            ->where('status', 'liked')
            ->first();

        $status = $data['status'];
        $matchedAt = null;

        if ($status === 'liked' && $oppositeLike) {
            $status = 'matched';
            $matchedAt = now();
            $oppositeLike->update(['status' => 'matched', 'matched_at' => $matchedAt]);
        }

        Connection::updateOrCreate(
            ['sender_id' => $user->id, 'receiver_id' => $profile->user_id],
            ['status' => $status, 'note' => $data['note'] ?? null, 'matched_at' => $matchedAt]
        );

        return redirect()->route('dashboard')->with('success', $status === 'matched' ? 'It is a match. You can start chatting now.' : 'Next profile loaded.');
    }
}
