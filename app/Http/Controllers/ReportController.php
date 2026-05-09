<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->withErrors(['reported_user' => 'You cannot report your own account.']);
        }

        if ($user->role === 'admin') {
            return back()->withErrors(['reported_user' => 'Admin accounts cannot be reported from this page.']);
        }

        $data = $request->validate([
            'category' => ['required', 'in:' . implode(',', array_keys(Report::CATEGORIES))],
            'details' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        Report::create([
            'reporter_id' => Auth::id(),
            'reported_id' => $user->id,
            'category' => $data['category'],
            'details' => $data['details'],
        ]);

        return back()->with('success', 'Report submitted. An admin will review it as soon as possible.');
    }

    public function index()
    {
        $status = request('status');
        $search = request('search');

        $reports = Report::with(['reporter.profile', 'reported.profile', 'reviewer'])
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->when($search, function ($query, $search) {
                $query->where(function ($searchQuery) use ($search) {
                    $searchQuery->whereHas('reporter', fn ($userQuery) => $userQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%"))
                        ->orWhereHas('reported', fn ($userQuery) => $userQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%"))
                        ->orWhere('details', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('reports.index', [
            'reports' => $reports,
            'search' => $search,
            'status' => $status,
            'statuses' => Report::STATUSES,
            'categories' => Report::CATEGORIES,
        ]);
    }

    public function show(Report $report)
    {
        $report->load(['reporter.profile', 'reported.profile', 'reviewer']);

        return view('reports.show', [
            'report' => $report,
            'statuses' => Report::STATUSES,
            'categories' => Report::CATEGORIES,
        ]);
    }

    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(Report::STATUSES))],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $report->update([
            'status' => $data['status'],
            'admin_notes' => $data['admin_notes'] ?? null,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.reports.show', $report)->with('success', 'Report updated.');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Report deleted.');
    }
}
