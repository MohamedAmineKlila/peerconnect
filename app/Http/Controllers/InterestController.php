<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $interests = Interest::withCount('profiles')
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%")->orWhere('category', 'like', "%{$search}%"))
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(8)
            ->withQueryString();

        return view('interests.index', compact('interests', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('interests.create', ['interest' => new Interest()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $interest = Interest::create($this->validatedData($request));

        return redirect()->route('interests.show', $interest)->with('success', 'Interest created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interest $interest)
    {
        $interest->load('profiles.user');

        return view('interests.show', compact('interest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interest $interest)
    {
        return view('interests.edit', compact('interest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interest $interest)
    {
        $interest->update($this->validatedData($request, $interest));

        return redirect()->route('interests.show', $interest)->with('success', 'Interest updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        $interest->delete();

        return redirect()->route('interests.index')->with('success', 'Interest deleted.');
    }

    private function validatedData(Request $request, ?Interest $interest = null): array
    {
        $id = $interest?->id ?? 'NULL';

        return $request->validate([
            'name' => ['required', 'string', 'max:80', "unique:interests,name,{$id}"],
            'category' => ['required', 'string', 'max:80'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
