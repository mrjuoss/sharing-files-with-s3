<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WSF</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-dark text-light">
<div class="container vh-100 w-100">
    <div class="row justify-content-center h-100">
        <div class="col-8 order-2 order-md-1 col-md-3 offset-1 my-md-auto">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form id="formUpload" action="{{ route('file.sharing.upload') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="file" name="file" id="selectFile" class="form-control">
            </form>
        </div>
        <div class="col-md-6 order-md-2 my-auto mb-4 my-md-auto text-center">
            <img src="{{ asset('images/wsf-logo.svg') }}" alt="logo wsf" />
            <p>Wegodev Sharing Files</p>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
