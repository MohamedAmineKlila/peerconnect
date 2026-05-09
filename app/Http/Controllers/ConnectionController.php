<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $connections = Connection::with(['sender.profile', 'receiver.profile'])
            ->when($search, function ($query, $search) {
                $query->where('status', 'like', "%{$search}%")
                    ->orWhereHas('sender', fn ($userQuery) => $userQuery->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('receiver', fn ($userQuery) => $userQuery->where('name', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('connections.index', compact('connections', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('connections.create', [
            'connection' => new Connection(),
            'users' => User::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['matched_at'] = $data['status'] === 'matched' ? now() : null;

        $connection = Connection::create($data);

        return redirect()->route('connections.show', $connection)->with('success', 'Connection saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Connection $connection)
    {
        $connection->load(['sender.profile', 'receiver.profile', 'messages.sender']);

        return view('connections.show', compact('connection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Connection $connection)
    {
        return view('connections.edit', [
            'connection' => $connection,
            'users' => User::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Connection $connection)
    {
        $data = $this->validatedData($request, $connection);
        $data['matched_at'] = $data['status'] === 'matched' ? ($connection->matched_at ?? now()) : null;
        $connection->update($data);

        return redirect()->route('connections.show', $connection)->with('success', 'Connection updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Connection $connection)
    {
        $connection->delete();

        return redirect()->route('connections.index')->with('success', 'Connection deleted.');
    }

    private function validatedData(Request $request, ?Connection $connection = null): array
    {
        return $request->validate([
            'sender_id' => ['required', 'exists:users,id', 'different:receiver_id'],
            'receiver_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:liked,passed,matched,blocked'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
