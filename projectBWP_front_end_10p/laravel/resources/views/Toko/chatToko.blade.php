@extends('template.punyatoko')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Chat History
                </div>
                <div class="card-body">
                    <div class="receiver-list">
                        @foreach($senderNames as $sender)
                            <div class="receiver-item" data-receiver-id="{{ $sender->user_id }}">
                                <b style="cursor: pointer">{{ $sender->receiver_name }}</b>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <span id="chat-container-label">- Choose Message History -</span>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="chat-messages">

                    </ul>
                </div>
                <div class="card-footer">
                    <form action="{{ url('/send-message') }}" method="post" id="send-message-form">
                        @csrf
                        <input type="hidden" name="senderId" value="{{ $senderId }}">
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="2" placeholder="Type your message..."></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    var currentReceiverId;

    $(document).ready(function () {
        $(".receiver-item").click(function () {
            var receiverId = $(this).data("receiver-id");
            $("input[name='senderId']").val("{{ $senderId }}");
            $("input[name='receiverId']").val(receiverId);

            currentReceiverId = receiverId;
            updateChatContainerLabel($(this).text());
            getMessages(receiverId);
        });
    });

    function updateChatContainerLabel(senderName) {
        $("#chat-container-label").html("<b>"+senderName+"</b>");
    }

    function getMessages(receiverId) {
        receiverId = receiverId || currentReceiverId;

        if (receiverId) {
            $.ajax({
                type: "POST",
                url: "{{ url('/get-messages') }}",
                data: {
                    senderId: $("input[name='senderId']").val(),
                    receiverId: receiverId,
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    $("#chat-messages").empty();
                    response.forEach(function (message) {
                        const timestampDate = new Date(message.created_at);

                        const hours = timestampDate.getHours();
                        const minutes = timestampDate.getMinutes();
                        const seconds = timestampDate.getSeconds();

                        const formattedTime = hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

                        let messageHtml = '<li class="list-group-item d-flex justify-content-between align-items-start">';
                        messageHtml += '<div class="ms-2 me-auto">';

                        if (message.sender_id !== currentReceiverId) {
                            // Message is from the receiver, align left
                            messageHtml += '<div class="fw-bold text-start">' + message.sender_name + '</div>';
                            messageHtml += '<div class="text-start">' + message.content + '</div>';
                        } else {
                            // Message is from the sender, align right
                            messageHtml += '<div class="fw-bold text-end">' + message.sender_name + '</div>';
                            messageHtml += '<div class="text-end">' + message.content + '</div>';
                        }

                        messageHtml += '</div>';
                        messageHtml += '<span class="text-muted">' + formattedTime + '</span>';
                        messageHtml += '</li>';

                        $("#chat-messages").append(messageHtml);
                    });
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    }

    getMessages();

    setInterval(function () {
        getMessages(currentReceiverId);
    }, 500);

    $("#send-message-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('/send-message') }}",
            data: $(this).serialize() + "&receiverId=" + currentReceiverId.toString(),
            success: function (response) {
                $("textarea[name='content']").val("");
                getMessages(currentReceiverId);
            },
            error: function (error) {
                console.log("Error sending message:", error);
            },
        });
    });
</script>
@endsection
