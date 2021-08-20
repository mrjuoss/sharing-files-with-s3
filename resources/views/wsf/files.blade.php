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
        <div class="col-8 order-2 order-md-1 col-md-3 offset-1 my-md-auto text-center text-md-start">
            <p>File Name : <strong>{{ $file->file_name }}</strong></p>
            <div class="d-flex justify-content-between">
                <p>Views : <strong>{{ $file->views }}</strong></p>
                <p>Downloads : <strong>{{ $file->downloads }}</strong></p>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('file.sharing.download', [$file->id]) }}" class="btn btn-primary" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')">Download</a>
                <form method="POST" action="{{ route('file.sharing.delete', [$file->id]) }}">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-outline-warning" onclick="return confirm('Apakah anda yakin akan menghapus file ini ?')">Delete</button>
                </form>
            </div>
            <div class="input-group input-group-sm mt-3">
                <input type="text" class="form-control" id="copyUrl" value="{{ route('file.sharing.files', $file->id) }}" readonly />
                <button class="btn btn-outline-secondary" type="button" id="copyBtn">Copy</button>
            </div>
            <img class="mt-4 img-thumbnail" src="{{ $file['path'] ."/". $file->file_name }}" alt="{{ $file->file_name}}" />
        </div>
        <div class="col-md-6 order-md-2 my-auto mb-4 my-md-auto text-center">
            <img src="{{ asset('images/wsf-logo.svg') }}" alt="logo wsf" />
            <p>Wegodev Sharing Files</p>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</html>
