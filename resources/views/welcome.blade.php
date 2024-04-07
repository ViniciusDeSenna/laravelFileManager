<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário com AJAX</title>
    <!-- Adicionando Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Formulário com AJAX</h2>
            <form id="meuFormulario">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <div id="mensagem"></div>
        </div>
    </div>
</div>

<!-- Adicionando jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Adicionando Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#meuFormulario').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '{{route('files.upload')}}',
                data: formData,
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                success: function(data){
                    console.log(data)
                },
                error: function(data){
                    console.log(data)
                }
            });
        });
    });
</script>
</body>
</html>
