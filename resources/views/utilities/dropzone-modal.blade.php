<div class="modal fade" id="dropzoneModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-lg font-weight-bold text-primary" id="dropzoneModalTitle">Saving to: @if($folder->name == 'local')My Storage @else {{$folder->name}} @endif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" value="{{$folder->parent_folder_id}}" id="fileLocal">
                        <form action="{{route('files.upload')}}" method="POST" class="dropzone" id="myDropzone">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
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
</script>
