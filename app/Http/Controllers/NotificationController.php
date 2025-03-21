<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    // Buat notifikasi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'type' => 'required|in:info,event',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $notification = Notification::create($validated);

        return response()->json(['message' => 'Notifikasi berhasil dibuat.', 'data' => $notification], 201);
    }

    // Ambil notifikasi (user-specific atau global)
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = Notification::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhereNull('user_id');
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json(['data' => $notifications]);
    }

    // Tandai notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Pemberitahuan ditandai sebagai telah dibaca.']);
    }
}
