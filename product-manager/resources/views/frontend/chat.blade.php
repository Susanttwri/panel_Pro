@extends('layouts.frontend')
@section('title', 'Community Chat — Edu')

@section('content')
<section style="padding: 100px 5% 60px; max-width: 900px; margin: 0 auto; min-height: 80vh; display: flex; flex-direction: column;">
    <div style="margin-bottom: 20px; text-align: center;">
        <div class="section-label"><i class="fas fa-comments"></i> Group Discussion</div>
        <h1 class="section-title">Community Chat</h1>
        <p style="color:var(--muted); font-size:15px; margin-top:8px;">Ask doubts, discuss courses, and learn together.</p>
    </div>

    <div style="flex: 1; background: var(--card); border: 1px solid var(--border); border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,.05); display: flex; flex-direction: column; overflow: hidden; height: 60vh;">
        
        <!-- Chat Messages -->
        <div id="chat-box" style="flex: 1; padding: 20px; overflow-y: auto; display: flex; flex-direction: column; gap: 16px; background: var(--surface);">
            @if($messages->count() == 0)
                <div style="text-align:center; padding:40px; color:var(--muted);">
                    <i class="fas fa-comment-slash" style="font-size:40px; opacity:0.3; margin-bottom:10px;"></i>
                    <p>No messages yet. Be the first to start the discussion!</p>
                </div>
            @endif
            @foreach($messages as $msg)
                @php
                    $isMe = false;
                    // Check if current session user or auth user matches the message user
                    if (Auth::check() && $msg->is_admin) {
                        $isMe = true;
                    } elseif (!Auth::check() && !$msg->is_admin && session('chat_name') == $msg->user_name) {
                        $isMe = true;
                    }
                @endphp
                
                <div style="display: flex; flex-direction: column; {{ $isMe ? 'align-items: flex-end;' : 'align-items: flex-start;' }} width: 100%;">
                    <!-- Message Bubble -->
                    <div style="
                        position: relative;
                        max-width: 85%;
                        min-width: 80px;
                        padding: 8px 12px 20px 12px;
                        border-radius: 12px;
                        font-size: 14px;
                        line-height: 1.5;
                        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                        {{ $isMe ? 'background: #dcf8c6; color: #303030; border-top-right-radius: 2px;' : 'background: #ffffff; color: #303030; border-top-left-radius: 2px; border: 1px solid #eee;' }}
                    ">
                        <!-- Sender Name -->
                        <div style="font-size: 12px; font-weight: 700; color: {{ $isMe ? '#075e54' : '#34b7f1' }}; margin-bottom: 2px; display: flex; justify-content: space-between; align-items: center;">
                            <span>{{ $msg->user_name }}</span>
                            @if($msg->is_admin)
                                <span style="font-size: 9px; background: rgba(0,0,0,0.1); padding: 1px 4px; border-radius: 4px; margin-left: 4px;">ADMIN</span>
                            @endif
                        </div>

                        <!-- Message Content -->
                        <div style="word-wrap: break-word;">
                            {{ $msg->message }}
                        </div>

                        <!-- Timestamp -->
                        <div style="position: absolute; bottom: 4px; right: 8px; font-size: 10px; color: #888; display: flex; align-items: center; gap: 4px;">
                            {{ $msg->created_at->format('H:i') }}
                            @if($isMe)
                                <i class="fas fa-check-double" style="color: #34b7f1; font-size: 8px;"></i>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Admin Delete Button -->
                    @if($isAdmin)
                        <form action="{{ route('chat.destroy', $msg->id) }}" method="POST" style="margin-top: 4px;" onsubmit="return confirm('Delete this message?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#ef4444; cursor:pointer; font-size:10px; display: flex; align-items: center; gap: 4px;">
                                <i class="fas fa-trash-alt"></i> Delete Message
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Chat Input Form -->
        <div style="padding: 16px 20px; background: var(--card); border-top: 1px solid var(--border);">
            <form action="{{ route('chat.store') }}" method="POST" style="display: flex; gap: 10px; flex-wrap: wrap;">
                @csrf
                @if(!$isAdmin)
                    <input type="text" name="user_name" placeholder="Your Name" required style="width: 140px; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; font-family:'Inter',sans-serif; outline:none; transition:border .2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'" value="{{ old('user_name', session('chat_name')) }}">
                @endif
                <input type="text" name="message" placeholder="{{ $isAdmin ? 'Send a message as Admin...' : 'Type your doubt here...' }}" required style="flex: 1; min-width: 200px; padding: 12px 16px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; font-family:'Inter',sans-serif; outline:none; transition:border .2s;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'" autocomplete="off">
                <button type="submit" class="btn-hero btn-hero-primary" style="padding: 12px 24px;"><i class="fas fa-paper-plane"></i> Send</button>
            </form>
        </div>
    </div>
</section>

<script>
    // Auto scroll to bottom
    const box = document.getElementById('chat-box');
    box.scrollTop = box.scrollHeight;
</script>
@endsection
