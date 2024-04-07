<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" rel="stylesheet">
  </head>
  <body>
  
    <div class="container mt-5">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>

        <form action="/file-upload" class="dropzone" id="dropzone"></form>
    </div>    
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var dropzone = document.getElementById('dropzone');

    dropzone.addEventListener('drop', function (e) {
      e.preventDefault();

      var files = e.dataTransfer.files;
      if (files.length > 0) {
        handleFiles(files);
      }
  });

  function handleFiles(files) {
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      uploadFile(file);
    }
  }

  function uploadFile(file) {
    var formData = new FormData();
    formData.append('file', file);
    $.ajax({
      url: '{{route('')}}',
      type: 'POST',
      data: formData,
      success: function(response){

      },
      error: function(response){
        
      }
    })
  }
});
</script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>