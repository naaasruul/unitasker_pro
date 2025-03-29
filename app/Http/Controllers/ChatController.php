<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function index(Group $group)
    {
        // Ensure the user belongs to the group
        if (!Auth::user()->groups->contains($group)) {
            abort(403, 'Unauthorized');
        }

        // Fetch messages for the group
        $messages = $group->messages()->with('user')->latest()->get();

        return view('chat.chatroom', compact('group', 'messages'));
    }
    public function send(Request $request, Group $group)
    {
        // Ensure the user belongs to the group
        if (!Auth::user()->groups->contains($group)) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'message' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov|max:20480', // Max 20MB
        ]);

        $data = [
            'user_id' => Auth::id(),
            'message' => $request->message,
        ];

        // Handle media upload
        if ($request->hasFile('media')) {
            $data['media'] = $request->file('media')->store('chat_media', 'public');
        }

        $group->messages()->create($data);

        return response()->json(['success' => true]);
    }
}
