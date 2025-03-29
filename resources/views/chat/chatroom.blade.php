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
                        <h6 class="mb-0">{{ $group->name }}</h6>
                        <span class="text-xs">{{ $group->users->count() }} Members</span>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 bg-grey">
                <div class="chat-content" id="chat-content">
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
                </div>
            </div>
            <div class="card-footer">
                <form id="sendMessageForm" action="{{ route('chat.send', $group) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="message-form d-flex align-items-center">
                        <input type="text" name="message" class="form-control" placeholder="Type your message...">
                        <input type="file" name="media" class="form-control-file mx-2">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
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
                }
            });
        });

        // Fetch messages via AJAX
        function fetchMessages() {
            $.get('{{ route('chat.index', $group) }}', function (html) {
                $('#chat-content').html(html);
            });
        }

        // Poll for new messages every 5 seconds
        // setInterval(fetchMessages, 5000);
    });
</script>

@include('user_header_footer.footer')