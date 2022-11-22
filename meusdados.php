<?php
session_start();
include('db_connect.php');

//var_dump($_POST);
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
if (
    isset($_POST) && !empty($_POST['nome'])
    && !empty($_POST['sobrenome']) && !empty($_POST['email'])
) {

    $id = $_SESSION['userId'];
    $nome = strip_tags($_POST['nome']);
    $sobrenome = strip_tags($_POST['sobrenome']);
    $email = strip_tags($_POST['email']);

    $sql = "UPDATE usuario set nome = '$nome', sobrenome = '$sobrenome', email = '$email' WHERE id = $id";

    $result = $conn->query($sql);
    // var_dump($conn->error);

    if ($conn->query($sql) === TRUE) {
        $_SESSION['nome'] = $nome;
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
    <title>Cadastro de Usuário</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Meus Dados</p>
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
        } else if (isset($_GET['sucesso']) && $_GET['sucesso'] == 0) {
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
        ?>
        <div>
            <h1>Meus Dados</h1>
        </div>
        <div>
            <form action="meusdados.php" method="post">
                <?php
                $id = $_SESSION['userId'];
                $sql = "SELECT id, nome, sobrenome, email FROM usuario WHERE id = $id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = mysqli_fetch_assoc($result);
                    //var_dump($row);
                    $nome = $row['nome'];
                    $sobrenome = $row['sobrenome'];
                    $email = $row['email'];
                }

                echo "<div class=\"mb-3 mt-3\">
                    <label for=\"nome\">Nome</label>
                    <input type=\"text\" name=\"nome\" class=\"form-control\" required autofocus value=\"$nome\" />
                </div>
                <div class=\"mb-3\">
                    <label for=\"sobrenome\">Sobrenome</label>
                    <input type=\"text\" name=\"sobrenome\" class=\"form-control\" required value=\"$sobrenome\" />
                </div>
                <div class=\"mb-3\">
                    <label for=\"email\">E-mail</label>
                    <input type=\"email\" name=\"email\" class=\"form-control\" required value=\"$email\" />
                </div>
                <div style=\"margin-bottom: 150px;\">
                    <input value=\"Atualizar\" type=\"submit\" class=\"btn btn-success\">
                    <a href=\"alterasenha.php\"<button class=\"btn btn-success\">Alterar Senha</button></a>
                </div>";
                $conn->close();
                ?>

            </form>
        </div>
    </article>

    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>