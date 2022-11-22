<?php
session_start();
include('db_connect.php');

//var_dump($_POST);
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>
<!doctype html>
<html>

<head>
    <title>Cadastro de Item</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Cadastro de Item</p>
    </header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="meusitens.php">Meus Itens</a>
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
            <h1>Meus Itens</h1>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id = $_SESSION['userId'];
                    $sql = "SELECT id, nome, descricao, status FROM item WHERE proprietario = $id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $itemId = $row['id'];
                            $nome = $row['nome'];
                            $desc = substr($row['descricao'], 0, 50);
                            $status = $row['status'];

                            $tableItem =  "<tr>
                                    <td>$itemId</td>
                                    <td>$nome</td>
                                    <td>$desc</td>";
                            if($status == 0) {
                                $tableItem = $tableItem . "<td>Disponível</td><td><a href=\"emprestarItem.php?item=$itemId&from=meusitens.php\"><button type=\"button\" class=\"btn btn-success\">Emprestar</button></a></td>";
                            } else {
                                $tableItem = $tableItem . "<td>Emprestado</td><td><a href=\"devolverItem.php?item=$itemId&from=meusitens.php\"><button type=\"button\" class=\"btn btn-warning text-light\">Devolvido</button></a></td>";
                            }

                            $tableItem = $tableItem . "
                                </tr>";
                            echo $tableItem;
                        }
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container">
            <a href="cadastroItem.php"><button type="button" class="btn btn-success">Novo Item</button></a>
        </div>
    </article>
    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>