@extends('layout.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <input type="hidden" id="fileLocal" value="{{$folder->id}}">
            <input type="hidden" id="viewMode" value="card">
            <h1 class="h3 mb-0 text-gray-800">@if($folder->name == 'local') My Storage @else {{$folder->name}} @endif</h1>
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

        </div>
    </div>

    <!-- Dropzone Modal -->
    @include('utilities.dropzone-modal', ['folder' => $folder])

    <!-- Dropzone Button -->
    <a class="add_file rounded bg-gradient-primary" onclick="openDropzoneModal()">
        <i class="fas fa-plus"></i>
    </a>

    <script>
        $(function (){
            // viewMode();
        })
        function carregarArquivos()
        {
            let viewMode = $('#viewMode').val()
            let url = '{{route('folder.view', ['file_id' => '#ID#', 'view_mode' => '#VIEW#'])}}';
            url = url.replace('#ID#', '{{$folder->id}}');
            url = url.replace('#VIEW#', viewMode);
            console.log(url)
            console.log(url)
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    console.log(response)
                    location.reload();
                }
            });
        }
        {{--function viewMode()--}}
        {{--{--}}
        {{--    let viewMode = $('#viewMode');--}}
        {{--    let contentDiv = $('#viewContent');--}}
        {{--    if (viewMode.val() == 'card'){--}}
        {{--        contentDiv.empty();--}}
        {{--        contentDiv.append('@include('utilities.list', ['folders' => $folders, 'files' => $files])')--}}
        {{--        viewMode.val('list')--}}
        {{--    } else {--}}
        {{--        contentDiv.empty();--}}
        {{--        contentDiv.append('@include('utilities.card', ['folders' => $folders, 'files' => $files])')--}}
        {{--        viewMode.val('card')--}}
        {{--    }--}}
        {{--}--}}
        function newFolder()
        {
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

        function makeFavorite(idFile) {
            $.ajax({
                type: 'POST',
                url: '{{route('files.favorite')}}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: idFile,
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    console.log(response)
                    location.reload();
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
