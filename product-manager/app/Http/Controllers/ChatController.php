<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::latest()->take(50)->get()->reverse();
        $isAdmin = Auth::check();
        return view('frontend.chat', compact('messages', 'isAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:50',
            'message' => 'required|string|max:500'
        ]);

        $isAdmin = Auth::check();

        if (!$isAdmin) {
            session(['chat_name' => $request->user_name]);
        }

        ChatMessage::create([
            'user_name' => $isAdmin ? 'Admin (' . Auth::user()->name . ')' : $request->user_name,
            'message' => $request->message,
            'is_admin' => $isAdmin
        ]);

        return redirect()->route('chat');
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            ChatMessage::findOrFail($id)->delete();
        }
        return redirect()->route('chat');
    }
}
