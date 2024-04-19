@extends('layout.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <input type="hidden" id="fileLocal" value="{{$folder->id}}">
            <input type="hidden" id="viewMode" value="card">
            <h1 class="h3 mb-0 text-gray-800">@if($folder->name == 'local')
                    My Storage
                @else
                    {{$folder->name}}
                @endif</h1>
            <div>
                <a class="btn btn-primary btn-icon-split" onclick="newFolder()">
                    <span class="icon text-white-50"><i class="fa fa-folder-plus"></i></span>
                    <span class="text d-none d-sm-block">New Folder</span>
                </a>
                <a class="btn btn-danger btn-icon-split" onclick="viewMode()">
                    <span class="icon text-white-50"><i class="fas fa-arrow-right"></i></span>
                    <span class="text d-none d-sm-block" id="viewButtonText">View in list</span>
                </a>
            </div>
        </div>
        <div id="viewContent">
            <div class="" id="viewCard">
                <!-- Folders -->
                @if(isset($folders))
                    <div class="row">
                        @foreach($folders as $item)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <a class="text-decoration-none" href="{{route('folder.view', ['file_id' => $item->id, 'view_mode' => 'card'])}}">
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
                <div class="m-5"></div>
                <!-- Files -->
                @if(isset($files))
                    <div class="row">
                        @foreach($files as $file)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4">
                                <a class="text-decoration-none" href="#" onclick="openImageModal({{$file->id}})">
                                    <div class="card shadow-sm">
                                        <div class="card-img-top mt-3" style="height: 10em; overflow: hidden;">
                                            <img src="{{\App\Classes\Util::displayImage($file->path)}}" class="img-fluid" alt="..." style="height: 100%; width: 100%; object-fit: contain;">
                                        </div>
                                        <div
                                            class="card-body py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">{{$file->name}}</h6>
                                            @include('utilities.file-dropdown-menu')
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="d-none" id="viewList">
                <!-- Folders -->
                @if(isset($folders))
                    <div class="list-group">
                        @foreach($folders as $item)
                            <a href="{{route('folder.view', ['file_id' => $item->id, 'view_mode' => 'card'])}}"
                               class="list-group-item list-group-item-action">
                                <i class="fa fa-folder-open mr-2 text-primary"></i> {{$item->name}}
                            </a>
                        @endforeach
                    </div>
                @endif

                <div class="m-5"></div>

                <!-- Files -->
                @if(isset($files))
                    <div class="list-group">
                        @foreach($files as $file)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#" onclick="openImageModal()">
                                        <div>
                                            <i class="fas fa-file mr-2 text-primary"></i>{{$file->name}}
                                        </div>
                                    </a>
                                    @include('utilities.file-dropdown-menu')
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Dropzone Button -->
    <a class="add_file rounded bg-gradient-primary" onclick="openDropzoneModal()">
        <i class="fas fa-plus"></i>
    </a>

    <!-- Dropzone Modal -->
    @include('utilities.dropzone-modal', ['folder' => $folder])
    <!-- View Image Modal -->
    @include('utilities.view-file-img')

    <script>
        $(function () {
            viewMode();
        })

        function viewMode() {
            let viewMode = $('#viewMode');
            let textButtonView = $('#viewButtonText');
            let divCard = $('#viewCard');
            let divList = $('#viewList');

            if (viewMode.val() == 'card') {
                divCard.addClass('d-none');
                divList.removeClass('d-none');
                viewMode.val('list');
                textButtonView.text('View in card');
            } else {
                divList.addClass('d-none');
                divCard.removeClass('d-none');
                viewMode.val('card');
                textButtonView.text('View in list');
            }
        }

        function newFolder() {
            Swal.fire({
                title: "Enter your folder name!",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Create Folder",
                confirmButtonColor: '#2653d4',
                reverseButtons: true,
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
                        success: function (response) {
                            console.log(response)
                            location.reload();
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {

                }
            });
        }

        function openDropzoneModal() {
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
