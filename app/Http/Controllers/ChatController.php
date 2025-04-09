<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Group $group)
    {
        // Check if the user is authorized to view the group
        if (Auth::user()->role === 'student' && !$group->users->contains(Auth::id())) {
            abort(403, 'Unauthorized access to this group.');
        }

        if (Auth::user()->role === 'lecturer' && $group->created_by !== Auth::id()) {
            abort(403, 'Unauthorized access to this group.');
        }

        // Fetch messages for the group
        $messages = $group->messages()->with('user')->latest()->get();

        return view('chat.chatroom', compact('group', 'messages'));
    }

    public function send(Request $request, Group $group)
    {
        // Ensure only students can send messages
        if (Auth::user()->role !== 'student') {
            abort(403, 'Only students can send messages.');
        }

        $request->validate([
            'message' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,pdf,csv,docx,xlsx|max:20480', // Max 20MB
        ]);

        $mediaPath = null;

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('chat_media', 'public');
        }


        $data = [
           'group_id' => $group->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'media' => $mediaPath,
        ];


        $group->messages()->create($data);

        return response()->json(['success' => true]);
    }

    // public function fetchMessages(Group $group)
    // {
    //     $messages = $group->messages()->with('user')->latest()->get();

    //     return view('chat.partials.messages', compact('messages'))->render();
    // }
}
