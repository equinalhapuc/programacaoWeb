<?php
session_start();
include('db_connect.php');

//var_dump($_POST);
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}

if (isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
    echo "<h1>Acesso Negado!</h1>";
    die();
}

if (isset($_POST) && !empty($_POST['nome'])
    && !empty($_POST['sobrenome']) && !empty($_POST['email'])) {

    $nome = strip_tags($_POST['nome']);
    $sobrenome = strip_tags($_POST['sobrenome']);
    $email = strip_tags($_POST['email']);
    $userId = $_POST['userId'];
    $isAdmin = !isset($_POST['admin']) || empty($_POST['admin']) ? 0 : 1;

    $sql = "UPDATE usuario SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', admin = $isAdmin WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        $msg = urlencode("Usuário Atualizado com Sucesso!");
        $conn->close();
        header("Location: usuarios.php?sucesso=1&msg=$msg");
    } else {
        $msg = urlencode($conn->error);
        $conn->close();
        header("Location: usuarios.php?sucesso=0&msg=$msg");
    }
}
?>
<!doctype html>
<html>

<head>
    <title>Editar Usuário</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Editar Usuário</p>
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
                    <a class="nav-link active" href="cadastroUsuario.php">Cadastrar Usuários</a>
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
            <h1>Editar Usuário</h1>
        </div>
        <div>
            <form action="editarusuario.php" method="post">
                <?php
                if (isset($_GET['userId']) && !empty($_GET['userId'])) {
                    $userId = $_GET['userId'];
                    $sql = "SELECT id, nome, sobrenome, email, admin FROM usuario where id = $userId";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $nome = $row['nome'];
                        $sobrenome = $row['sobrenome'];
                        $email = $row['email'];
                        $admin = $row['admin'];
                        $userId = $row['id'];

                        $form = "<div class=\"mb-3 mt-3\">
                            <input type=\"hidden\" name=\"userId\" value=\"$userId\" />
                            <label for=\"nome\">Nome</label>
                            <input type=\"text\" name=\"nome\" class=\"form-control\" value=\"$nome\" required autofocus />
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"sobrenome\">Sobrenome</label>
                            <input type=\"text\" name=\"sobrenome\" class=\"form-control\" value=\"$sobrenome\" required />
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"email\">E-mail</label>
                            <input type=\"email\" name=\"email\" class=\"form-control\" value=\"$email\" required />
                        </div>
                        <div class=\"mb-3\">
                            <label for=\"admin\" class=\"form-check-label\">É administrador:</label>";

                        if ($admin == 1) {
                            $form = $form . "<input type=\"checkbox\" name=\"admin\" class=\"form-check-input\" checked value=1/>
                            </div>
                            <div style=\"margin-bottom: 150px;\">
                                <input value=\"Enviar\" type=\"submit\" class=\"btn btn-success\">
                            </div>";
                        } else {
                            $form = $form . "<input type=\"checkbox\" name=\"admin\" class=\"form-check-input\" value=1/>
                            </div>
                            <div style=\"margin-bottom: 150px;\">
                                <input value=\"Atualizar\" type=\"submit\" class=\"btn btn-success\">
                            </div>";
                        }

                        echo $form;

                    } else {
                        echo "Usuário não encontrado";
                    }
                } else {
                    echo "Usuário não encontrado";
                }
                ?>

            </form>
        </div>
    </article>

    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>