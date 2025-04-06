<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNITASKER</title>

    <link rel="stylesheet" href="{{ asset('assets/calendar.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
    .chat {
        display: flex;
        margin-bottom: 15px;
    }

    .chat-left {
        justify-content: flex-start;
    }

    .chat-right {
        justify-content: flex-end;
    }

    .chat-body {
        max-width: 70%;
        padding: 10px;
        border-radius: 10px;
        background-color: #f1f1f1;
    }

    .chat-left .chat-body {
        background-color: #e9ecef;
    }

    .chat-right .chat-body {
        background-color: #007bff;
        color: white;
    }

    .chat-message strong {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
</style>

<body>