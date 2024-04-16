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
                            <div class="card mb-4 border-bottom-primary shadow-sm">
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
        <!-- Files -->
        @if(isset($files))
            <div class="row">
                @foreach($files as $file)
                    <div class="col-4 mb-4">
                        <a class="text-decoration-none" href="#">
                            <div class="card shadow-sm">
                                <img src="{{asset('assets/pdfLogo.png')}}" class="card-img-top" alt="..." style="height: 10em">
                                <div class="card-body py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{$file->name}}</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                            <div class="dropdown-header">File Functions:</div>
                                            <a class="dropdown-item" href="#">Favorite</a>
                                            <a class="dropdown-item" href="#">Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

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
