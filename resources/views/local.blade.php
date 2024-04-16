@extends('layout.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@if($folder->name == 'local')My Storage @else {{$folder->name}} @endif</h1>
            <a class="btn btn-primary btn-icon-split" onclick="newFolder()">
                <span class="icon text-white-50"><i class="fa fa-folder-plus"></i></span>
                <span class="text">New Folder</span>
            </a>
        </div>
        <!-- Folders -->
        @if(isset($folders))
            <div class="row">
                @foreach($folders as $folder)
                    <div class="col-4">
                        <a class="text-decoration-none" href="{{route('folder.view', [$folder->name])}}">
                            <div class="card mb-4 border-bottom-primary">
                                <div class="card-body">
                                    <span class="icon text-blue-50"><i class="fa fa-folder-open"></i></span>
                                    {{$folder->name}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
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

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-4">Enviar arquivo</h2>
            <input type="hidden" value="{{$folder->parent_folder_id}}" id="fileLocal">
            <form action="{{route('files.upload')}}" method="POST" class="dropzone" id="myDropzone">@csrf</form>
        </div>
    </div>

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

        function newFolder()
        {
            Swal.fire({
                title: "Submit your Github username",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Look up",
                showLoaderOnConfirm: true,
                preConfirm: async (name) => {
                    let fileLocal = $('#fileLocal').val();
                    $.ajax({
                        type: 'POST',
                        url: '{{route('folder.create')}}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            name: name,
                            parent_folder: fileLocal,
                        },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function(response){
                            console.log(response)
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {

                }
            });
        }
    </script>
@endsection
