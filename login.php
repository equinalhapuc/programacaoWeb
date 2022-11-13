<!doctype html>
<html>
    <head>
        <title>Login - Coisas Emprestadas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h2>Login - Coisas Emprestadas</h2>
            <form action="login.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" placeholder="usuario@dominio.com" name="email"/>
                </div>
                <div class="mb-3">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" placeholder="**********" name="password"/>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </body>
</html>