<?php
    session_start();
    include('db_connect.php');
    
    //var_dump($_POST);
    if(!isset($_SESSION['valid'])) {
        header("Location: login.php");
    }
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
        echo "<h1>Acesso Negado!</h1>";
        die();
    }

    if (isset($_POST) && !empty($_POST['nome']) 
        && !empty($_POST['sobrenome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

        $nome = strip_tags($_POST['nome']);
        $sobrenome = strip_tags($_POST['sobrenome']);
        $email = strip_tags($_POST['email']);
        $senha = password_hash(strip_tags($_POST['senha']), PASSWORD_DEFAULT);
        $isAdmin = !isset($_POST['admin']) || empty($_POST['admin']) ? 0 : true;

        $sql = "INSERT INTO usuario (nome, sobrenome, email, senha, admin)
        VALUES ('$nome', '$sobrenome', '$email', '$senha', '$isAdmin')";

        if ($conn->query($sql) === TRUE) {
            $msg = urlencode("Usuário Cadastrado com Sucesso!");
            $conn->close();
            header("Location: cadastroUsuario.php?sucesso=1&msg=$msg");
        } else {
            $msg = urlencode($conn->error);
            $conn->close();
            header("Location: cadastroUsuario.php?sucesso=0&msg=$msg");
        }
    }
?>
<!doctype html>
<html>

<head>
    <title>Cadastro de Usuário</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Cadastro de Usuário</p>
    </header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="meusitens.php">Meus Itens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="usuarios.php">Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            <?php
                $nome = $_SESSION['nome'];
                echo "<a class=\"nav-link float-end text-secondary mr-5\" href=\"meusdados.php\"><i class=\"fas fa-user\" style=\"color:gray\"></i>&nbsp;&nbsp;&nbsp;$nome</a>"
            ?>
        </div>
    </nav>

    <article class="container mt-5" style="margin-bottom: 150px;">
    <?php
        if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
            $msg = $_GET['msg'];
            echo "<div class=\"toast show\">
            <div class=\"toast-header\">
            <strong class=\"me-auto\">Mensagem</strong>
              <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\"></button>
            </div>
            <div class=\"toast-body\">
              $msg
            </div>
          </div>";
        } else if (isset($_GET['sucesso']) && $_GET['sucesso'] == 0){
            $msg = $_GET['msg'];
            echo "<div class=\"toast show\">
            <div class=\"toast-header\">
            <strong class=\"me-auto text-danger\">Erro!</strong>
              <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\"></button>
            </div>
            <div class=\"toast-body\">
              $msg
            </div>
          </div>";
        }
        $conn->close();
    ?>
        <div>
            <h1>Cadastro de Usuário</h1>
        </div>
        <div>
            <form action="cadastroUsuario.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Ex: João" required autofocus />
                </div>
                <div class="mb-3">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" name="sobrenome" class="form-control" placeholder="Ex: da Silva" required />
                </div>
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="joao@hotmail.com" required />
                </div>
                <div class="mb-3">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" class="form-control" placeholder="*********" required />
                </div>
                <div class="mb-3">
                    <label for="confirma">Repita a Senha:</label>
                    <input type="password" name="confirma" class="form-control" placeholder="*********" required />
                </div>
                <div class="mb-3">
                    <label for="admin" class="form-check-label">É administrador:</label>
                    <input type="checkbox" name="admin" class="form-check-input" value=1/>
                </div>
                <div style="margin-bottom: 150px;">
                    <input value="Enviar" type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </article>

    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>