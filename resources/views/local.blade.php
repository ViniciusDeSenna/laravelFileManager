@extends('layout.dashboard')

@section('content')
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Enviar arquivo</h2>
                <input type="hidden" value="{{$folder->id}}" id="fileLocal">
                <form action="{{route('files.upload')}}" method="POST" class="dropzone" id="myDropzone">@csrf</form>
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
                console.log(data)
            }
        };
    </script>
@endsection
