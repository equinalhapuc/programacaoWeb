<?php
    session_start();
    include('db_connect.php');
    
    //var_dump($_POST);
    if(!isset($_SESSION['valid'])) {
        header("Location: login.php");
    }
    if (isset($_POST) && !empty($_POST['senha'])) {

        $id = $_SESSION['userId'];
        $senha = password_hash(strip_tags($_POST['senha']), PASSWORD_DEFAULT);

        $sql = "UPDATE usuario set senha = '$senha' WHERE id = $id";

        $result = $conn->query($sql);
        // var_dump($conn->error);

        if ($conn->query($sql) === TRUE) {
            $msg = urlencode("Usuário Atualizado com Sucesso!");
            $conn->close();
            header("Location: meusdados.php?sucesso=1&msg=$msg");
        } else {
            $msg = urlencode($conn->error);
            $conn->close();
            header("Location: meusdados.php?sucesso=0&msg=$msg");
        }
    }
?>
<!doctype html>
<html>

<head>
    <title>Alterar senha</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Alterar Senha</p>
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
                <?php
                if ($_SESSION['admin'] == 1) {
                    echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"usuarios.php\">Usuários</a>
                    </li>";
                }
                ?>
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
        <div>
            <h1>Alterar Senha</h1>
        </div>
        <div>
            <form action="alterasenha.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="nome">Nova Senha</label>
                    <input type="text" name="senha" class="form-control" required autofocus/>
                </div>
                <div class="mb-3 mt-3">
                    <label for="nome">Repita a Nova Senha</label>
                    <input type="text" name="repetir" class="form-control" required />
                </div>
                <div style="margin-bottom: 150px;">
                    <input value="Atualizar" type="submit" class="btn btn-success">
                </div>
            </form>
        </div>
    </article>

    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>