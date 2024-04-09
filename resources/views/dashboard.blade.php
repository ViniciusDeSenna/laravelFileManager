<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <!-- Adicionando Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-4">Enviar arquivo</h2>
            <input type="hidden" value="local/" id="fileLocal">
            <form action="{{route('files.upload')}}" class="dropzone" id="myDropzone">@csrf</form>
        </div>
    </div>
</div>
@if(isset($files))
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Arquivos Disponíveis</h2>
                <ul class="list-group">
                    @foreach($files as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="#">{{$file->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<!-- Adicionando jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Adicionando Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    Dropzone.options.myDropzone = {
        paramName: "file",
        maxFilesize: 2,
        maxFiles: 5,
        acceptedFiles: '.jpg, .jpeg, .png, .pdf',
        sending: function(file, xhr, formData) {
            let fileLocal = $('#fileLocal').val();
            formData.append("fileLocal", fileLocal);
        },
        success: function(file, data) {
            console.log(data)
        },
        error: function(data) {
            alert(data)
        }
    };
</script>
</body>
</html>