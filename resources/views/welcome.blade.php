<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>
    <h1>Teste</h1>
    <button id="button">TESTE</button>

    <script>
        $(document).ready(function(){
            $("#button").click(function(){
                alert("Você clicou no botão!");
            });
        });
    </script>
</body>
</html>
