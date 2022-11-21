<?php
session_start();
include('db_connect.php');

if (
    isset($_POST['login']) && !empty($_POST['email'])
    && !empty($_POST['password'])
) {

    $email = strip_tags($_POST['email']);
    $sql = "SELECT id, nome, sobrenome, email, senha, admin FROM usuario WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        //var_dump($row);
        $id = $row['id'];
        $nome = $row['nome'];
        $hash = $row['senha'];
        $senha = $_POST['password'];
        $admin = $row['admin'];
        if (password_verify($senha, $hash)) {
            $_SESSION['valid'] = true;
            $_SESSION['userId'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['admin'] = $admin;
            $conn->close();
            //var_dump($row);
            //var_dump($sql);
            header('Location: home.php');
        }
    }
    echo 'Erro de usuário/senha';
}
?>
<!doctype html>
<html>

<head>
    <title>Login - Coisas Emprestadas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="mt-4 p-5 bg-secondary text-white rounded">
            <h1>Login </h1>
            <p>Coisas Emprestadas</p>
        </div>
        <form action="login.php" method="post">
            <div class="mb-3 mt-3">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" placeholder="usuario@dominio.com" name="email" />
            </div>
            <div class="mb-3">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" placeholder="**********" name="password" />
            </div>
            <button type="submit" class="btn btn-primary" name="login">Enviar</button>
        </form>
    </div>
</body>

</html>