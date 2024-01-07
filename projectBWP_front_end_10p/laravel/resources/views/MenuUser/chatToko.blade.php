@extends('template.main')
<style>
    .quantity-selector {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        margin: 0 10px;
    }

    .quantity-button {
        cursor: pointer;
        font-size: 1.2em;
        user-select: none;
    }
</style>
@section('content')
    <div class="container mt-5 mb-5">
        <button class="btn btn-danger mb-3" onclick="goBack()">
            <- Kembali Ke Produk
        </button>
        <div class="card">
            <div class="card-header">
                Nama pemilik toko : <b>{{ $receiverName }}</b>
            </div>
            <div class="card-body" id="messages">
                <ul class="list-group" id="chat-messages">

                </ul>
            </div>
            <div class="card-footer">
                <form action="{{ url('/send-message') }}" method="post" id="send-message-form">
                    @csrf
                    <input type="hidden" name="senderId" value="{{ $senderId }}">
                    <input type="hidden" name="receiverId" value="{{ $receiverId }}">
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="2" placeholder="Type your message..."></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"
    ></script>
    <script>
        function goBack() {
            window.history.back();
        }

        function getMessages() {
            $.ajax({
                type: "POST",
                url: "{{ url('/get-messages') }}",
                data: {
                    senderId: "{{ $senderId }}",
                    receiverId: "{{ $receiverId }}",
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
                        messageHtml += '<div class="fw-bold">' + message.sender_name + '</div>';
                        messageHtml += message.content;
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

        getMessages();

        setInterval(getMessages, 500);

        $("#send-message-form").submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ url('/send-message') }}",
                data: $(this).serialize(),
                success: function () {
                    $("textarea[name='content']").val("");
                    getMessages();
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
    </script>
@endsection
