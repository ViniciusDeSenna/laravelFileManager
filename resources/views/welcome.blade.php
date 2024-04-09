<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <!-- Adicionando Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        /* Estilos adicionais podem ser colocados aqui */
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            padding: 20px;
            background-color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 login-container">
            <h2 class="text-center mb-4">Entrar</h2>
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nome de Usuário" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                </div>
                <button type="button" class="btn btn-primary btn-block" onclick="login()">Entrar</button>
            </form>
        </div>
    </div>
</div>

<!-- Adicionando jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Adicionando Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function login()
    {
        $.ajax({
            url: '{{route('folder.view')}}',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                parent: 'local/'
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data){
                console.log(data)
            },
            error: function (data){
                console.log(data)
            }
        })
    }
</script>
</body>
</html>
