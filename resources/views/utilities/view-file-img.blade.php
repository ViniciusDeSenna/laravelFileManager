<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <img id="img-view-modal" class="img-fluid" alt="..." style="height: 100%; width: 100%; object-fit: contain;">
    </div>
</div>

<script>
    function openImageModal(path){
        $.ajax({
            type: 'POST',
            url: '{{route('files.templink')}}',
            data: {
                _token: '{{ csrf_token() }}',
                path: path,
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                console.log(response)
            }
        });

        let pathFile = '\App\Classes\Util::displayImage(' + path + ')'
        $('#exampleModal').modal('show')
    }
</script>
