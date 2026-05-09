<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Profile;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $profiles = Profile::with(['user', 'interests'])
            ->when($search, function ($query, $search) {
                $query->where('headline', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('interests', fn ($interestQuery) => $interestQuery->where('name', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('profiles.index', compact('profiles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->profile) {
            return redirect()->route('profiles.edit', Auth::user()->profile)
                ->with('success', 'You already have a profile. You can update it here.');
        }

        return view('profiles.create', [
            'profile' => new Profile(),
            'users' => Auth::check() ? collect() : User::orderBy('name')->get(),
            'interests' => Interest::orderBy('name')->get(),
            'selectedInterests' => [],
            'isPersonalProfile' => Auth::check(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = Auth::id() ?? $data['user_id'];

        if ($request->hasFile('avatar')) {
            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile = Profile::create($data);
        $profile->interests()->sync($request->input('interests', []));

        return redirect()->route('profiles.show', $profile)->with('success', 'Profile created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $profile->load(['user', 'interests']);

        return view('profiles.show', [
            'profile' => $profile,
            'reportCategories' => Report::CATEGORIES,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        if (Auth::check() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        return view('profiles.edit', [
            'profile' => $profile,
            'users' => Auth::check() ? collect() : User::orderBy('name')->get(),
            'interests' => Interest::orderBy('name')->get(),
            'selectedInterests' => $profile->interests()->pluck('interests.id')->all(),
            'isPersonalProfile' => Auth::check(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        if (Auth::check() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $this->validatedData($request);
        $data['user_id'] = Auth::id() ?? $data['user_id'];

        if ($request->hasFile('avatar')) {
            if ($profile->avatar_path) {
                Storage::disk('public')->delete($profile->avatar_path);
            }
            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);
        $profile->interests()->sync($request->input('interests', []));

        return redirect()->route('profiles.show', $profile)->with('success', 'Profile updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        if (Auth::check() && $profile->user_id !== Auth::id()) {
            abort(403);
        }

        if ($profile->avatar_path) {
            Storage::disk('public')->delete($profile->avatar_path);
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted.');
    }

    private function validatedData(Request $request): array
    {
        $rules = [
            'headline' => ['required', 'string', 'max:120'],
            'bio' => ['required', 'string', 'max:1000'],
            'department' => ['required', 'string', 'max:120'],
            'level' => ['nullable', 'string', 'max:80'],
            'available_for_mentoring' => ['sometimes', 'boolean'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'interests' => ['array'],
            'interests.*' => ['exists:interests,id'],
        ];

        if (! Auth::check()) {
            $rules['user_id'] = ['required', 'exists:users,id'];
        }

        return $request->validate($rules) + ['available_for_mentoring' => false];
    }
}
