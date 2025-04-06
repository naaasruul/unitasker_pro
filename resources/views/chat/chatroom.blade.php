@include('user_header_footer.header')

<div id="main">
    @include('layouts.side_menu')        
    <div class="page-heading">
        <h3>Chatroom: {{ $group->name }}</h3>
    </div>
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="media d-flex align-items-center">
                    <div class="avatar me-3">
                        <img src="assets/images/faces/1.jpg" alt="" srcset="">
                        <span class="avatar-status bg-success"></span>
                    </div>
                    <div class="name flex-grow-1">
                        <h6 class="mb-0">{{ $group->group_name }}</h6>
                        <span class="text-xs">{{ $group->users->count() }} Members</span>
                    </div>
                    <div class="ms-auto">
                        <!-- Navigation Button to Group To-Do List -->
                        <a href="{{ route('group-tasks.index', $group->id) }}" class="btn btn-primary">
                            <i class="bi bi-list-task"></i> Group To-Do List
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 bg-grey">
                <div class="chat-content" id="chat-content">
                    @foreach ($messages->reverse() as $message)
                        <div class="chat {{ $message->user_id === Auth::id() ? 'chat-right' : 'chat-left' }}">
                            <div class="chat-body">
                                <div class="chat-message">
                                    <strong>{{ $message->user_id === Auth::id() ? 'You' : $message->user->name }}:</strong>
                                    {{ $message->message }}
                                    @if ($message->media)
                                        <div class="mt-2">
                                            @if (Str::endsWith($message->media, ['jpg', 'jpeg', 'png', 'gif']))
                                            <a href="{{ asset('storage/' . $message->media) }}">
                                                <img src="{{ asset('storage/' . $message->media) }}" alt="Media" class="w-50">
                                            </a>
                                            @elseif (Str::endsWith($message->media, ['mp4', 'avi']))
                                                <video controls class="img-fluid">
                                                    <source src="{{ asset('storage/' . $message->media) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                <a href="{{ asset('storage/' . $message->media) }}" target="_blank">Download File</a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if (Auth::user()->role === 'student')
                <div class="card-footer">
                    <form id="sendMessageForm" action="{{ route('chat.send', $group) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="message-form d-flex align-items-center">
                            <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                            <input type="file" name="media" class="form-control-file mx-2">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="card-footer">
                    <p class="text-muted">You are viewing this chatroom as a lecturer. Messages cannot be sent.</p>
                </div>
            @endif
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        // Handle form submission via AJAX
        $('#sendMessageForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.success) {
                        // Reload messages
                        fetchMessages();
                        form[0].reset();
                    }
                },
                error: function () {
                    alert('Failed to send the message. Please try again.');
                }
            });
        });

        // Fetch messages via AJAX
        function fetchMessages() {
            $.get('{{ route('chat.fetch-messages', $group) }}', function (data) {
                // Update only the chat content
                $('#chat-content').html(data);
            });
        }

        // Poll for new messages every 5 seconds
        // setInterval(fetchMessages, 5000);
    });
</script>

@include('user_header_footer.footer')