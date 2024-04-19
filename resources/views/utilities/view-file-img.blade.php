<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="img-view-modal-content">

    </div>
</div>

<script>
    function openImageModal(id){
        $.ajax({
            type: 'POST',
            url: '{{route('files.templink')}}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                console.log(response)
                $('#img-view-modal-content').empty();
                $('#img-view-modal-content').append(`<img src="${response}" id="img-view-modal" class="img-fluid" alt="..." style="height: 100%; width: 100%; object-fit: contain;">`);
                $('#exampleModal').modal('show');
            }
        });
    }
</script>
