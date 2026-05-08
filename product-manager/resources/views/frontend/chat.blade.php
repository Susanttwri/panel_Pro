@extends('layouts.frontend')
@section('title', 'Community Chat — EduCRM')

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
                <div style="display: flex; flex-direction: column; {{ $msg->is_admin ? 'align-items: flex-end;' : 'align-items: flex-start;' }}">
                    <div style="font-size: 11px; color: var(--muted); margin-bottom: 4px; display: flex; gap: 8px; align-items: center;">
                        @if($msg->is_admin)
                            <span class="badge" style="background:var(--accent); color:white; padding:2px 6px; font-size:9px; border-radius:4px;"><i class="fas fa-shield-alt"></i> Admin</span>
                        @endif
                        <strong>{{ $msg->user_name }}</strong> &bull; {{ $msg->created_at->diffForHumans() }}
                        
                        @if($isAdmin)
                            <form action="{{ route('chat.destroy', $msg->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this message?');">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:red; cursor:pointer; font-size:11px; margin-left:8px;"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        @endif
                    </div>
                    <div style="max-width: 80%; padding: 12px 16px; border-radius: 14px; font-size: 14px; line-height: 1.5; {{ $msg->is_admin ? 'background:var(--accent); color:white; border-bottom-right-radius: 2px;' : 'background:var(--card); border:1px solid var(--border); border-bottom-left-radius: 2px;' }}">
                        {{ $msg->message }}
                    </div>
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
