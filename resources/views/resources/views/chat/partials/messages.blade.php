@foreach ($messages as $message)
    <div class="chat {{ $message->user_id === Auth::id() ? '' : 'chat-left' }}">
        <div class="chat-body">
            <div class="chat-message">
                <strong>{{ $message->user->name }}:</strong> 
                {{ $message->message }}
                @if ($message->media)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $message->media) }}" alt="Media" class="img-fluid">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach