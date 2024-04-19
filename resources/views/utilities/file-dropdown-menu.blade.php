<div class="dropdown no-arrow">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
        <div class="dropdown-header">File Functions:</div>
        <a class="dropdown-item" onclick="makeFavorite({{$file->id}})">Favorite</a>
        <a class="dropdown-item" onclick="downloadFile({{$file->id}})">Download</a>
        <a class="dropdown-item" onclick="renameFile({{$file->id}})">Rename</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" onclick="deleteFile{{$file->id}}">Delete</a>
    </div>
</div>

<script>
    function downloadFile(idFile) {
        window.location.href = '{{route('files.download')}}?id=' + idFile;
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

    function renameFile(idFile) {
        Swal.fire({
            title: "{{$file->name}}",
            input: "text",
            showCancelButton: true,
            confirmButtonText: "Change name!",
            confirmButtonColor: '#2653d4',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: async (newName) => {
                $.ajax({
                    type: 'POST',
                    url: '{{route('files.rename')}}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: idFile,
                        newName: newName,
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        console.log(response)
                        location.reload();
                    }
                });
            }
        });
    }

    function deleteFile(idFile) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2653d4",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '{{route('files.delete')}}',
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
        });
    }
</script>
