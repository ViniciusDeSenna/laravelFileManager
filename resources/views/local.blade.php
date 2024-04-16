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
                @foreach($folders as $item)
                    <div class="col-4">
                        <a class="text-decoration-none" href="{{route('folder.view', [$item->name])}}">
                            <div class="card mb-4 border-bottom-primary shadow-sm">
                                <div class="card-body">
                                    <span class="icon text-blue-50"><i class="fa fa-folder-open"></i></span>
                                    {{$item->name}}
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

    <!-- Dropzone Modal -->
    @include('utilities.dropzone-modal', ['folder' => $folder])

    <!-- Dropzone Button -->
    <a class="add_file rounded bg-gradient-primary" onclick="openDropzoneModal()">
        <i class="fas fa-plus"></i>
    </a>

    <script>
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
        function openDropzoneModal()
        {
            $('#dropzoneModal').modal('show');
        }
    </script>
    <style>
        .add_file {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            width: 2.75rem;
            height: 2.75rem;
            text-align: center;
            color: #fff;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            line-height: 46px;
        }

        .add_file:focus, .add_file:hover {
            color: white;
        }

        .add_file:hover {
            background: #5a5c69;
        }

        .add_file i {
            font-weight: 800;
        }
    </style>
@endsection
