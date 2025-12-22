<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{
    public function create()
    {
        return view('buat_laporan');
    }
    // Get all reports (Feed)
    public function index(Request $request)
    {
        // Simple pagination for the feed
        // You can add filters here based on $request->query() (e.g., status, location)
        $reports = Report::with('user') // Eager load user
            ->withCount(['likes', 'comments']) // Count social interactions
            ->latest()
            ->paginate(10);
if (!$request->wantsJson()) {
            return view('laporan', compact('reports'));
        }
        return response()->json($reports);
    }

    // Get single report detail

    // Create a new report
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => 'nullable|image|max:10240', // Max 10MB
            'province_id' => 'nullable|exists:provinces,id',
            'regency_id' => 'nullable|exists:regencies,id',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reports', 'public');
        }

        $report = $request->user()->reports()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'image_path' => $path ? Storage::url($path) : null,
            'status' => 'pending',
        ]);
if (!$request->wantsJson()) {
            return redirect('/laporan')->with('success', 'Laporan berhasil dibuat!');
        }
        return response()->json([
            'message' => 'Report submitted successfully',
            'data' => $report
        ], 201);
        return redirect('/laporan')->with('success', 'Laporan berhasil dikirim!');
    }

public function show($id)
    {
        $report = Report::with(['user', 'comments.user', 'progressUpdates'])
            ->withCount('likes')
            ->findOrFail($id);
            
        if (!request()->wantsJson()) {
             return view('detail_laporan', compact('report'));
        }

        return response()->json($report);
    }

    // Add progress update (For admin or official replies)
    public function addProgress(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|in:verified,resolved,rejected,pending', // Update main status
            'image' => 'nullable|image|max:5120',
        ]);

        $report = Report::findOrFail($id);
        
        // Authorization check: Ensure user is admin (You might need policies later)
        // if (!$request->user()->isAdmin()) { abort(403); }

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('progress_updates', 'public');
        }

        // Assuming you have a ProgressUpdate model and relationship
        // If not, you might just be updating the report itself or a related table
        // For now, let's assume we update the report status and store a log/comment-like update
        
        $report->update(['status' => $request->status]);

        // You might want to create a separate "ProgressUpdate" model here
        // $report->progressUpdates()->create(...)

        return response()->json([
            'message' => 'Progress updated successfully',
            'data' => $report
        ]);
    }
}