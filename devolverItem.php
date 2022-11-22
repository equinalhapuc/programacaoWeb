<?php
session_start();
include('db_connect.php');

//var_dump($_POST);
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}

if (isset($_POST) && !empty($_POST['devolucao']) && !empty($_POST['idEmprestimo']) && !empty($_POST['item'])) {
    $dataDevolucao = $_POST['devolucao'];
    $idEmprestimo = $_POST['idEmprestimo'];
    $item = $_POST['item'];

    $sql = "update emprestimo set dataDevolucao = '$dataDevolucao' where id = $idEmprestimo";
    $sql2 = "UPDATE item SET status = 0 WHERE id = $item";

    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
        //var_dump($_POST['devolucao']);
        $from = $_POST['from'];
        $msg = urlencode("Devolução registrada com sucesso!");
        $conn->close();
        header("Location: $from?sucesso=1&msg=$msg");
    } else {
        $msg = urlencode($conn->error);
        //var_dump($_POST['devolucao']);
        $conn->close();
        header("Location: $from?sucesso=0&msg=$msg");
    }
}

?>
<!doctype html>
<html>

<head>
    <title>Devolver item</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Devolução</p>
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
        <div class="row">
            <div class="col">
                <h2>Devolver Item</h2>
            </div>
        </div>
        <div class="row">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Destinatário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($_GET['item']) || empty($_GET['item'])) {
                            echo "<tr><td colspan=3><strong>Item não encontrado</strong></td></tr>";
                        } else {
                            $itemId = $_GET['item'];
                            $sql = "select i.id, i.nome, i.descricao, max(e.id) as idEmprestimo, u.nome as dest, u.sobrenome, u.email from item i
                            join emprestimo e on i.id = e.idItem
                            join usuario u on e.idDestinatario = u.id
                            where i.id = $itemId
                            group by i.id, i.nome, i.descricao, u.nome, u.sobrenome, u.email";

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $itemId = $row['id'];
                                    $nome = $row['nome'];
                                    $desc = substr($row['descricao'], 0, 50);
                                    $dest = $row['dest'];
                                    $sobrenome = $row['sobrenome'];
                                    $email = $row['email'];
                                    $idEmprestimo = $row['idEmprestimo'];

                                    echo "<tr>
                                    <td>$itemId</td>
                                    <td>$nome</td>
                                    <td>$desc</td>
                                    <td>$dest $sobrenome - $email</td>
                                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan=3><strong>Item não encontrado</strong></td></tr>";
                            }
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <form action="devolverItem.php" method="post">
                <?php
                $itemId = $_GET['item'];
                $from = $_GET['from'];
                echo "<input type=\"hidden\" name=\"idEmprestimo\" value=$idEmprestimo />";
                echo "<input type=\"hidden\" name=\"item\" value=$itemId />";
                echo "<input type=\"hidden\" name=\"from\" value=$from />";
                ?>
                <div class="mb-3">
                    <label for="devolucao">Data da devolucao</label>
                    <input type="date" name="devolucao" class="form-control" required />
                </div>
                <div style="margin-bottom: 150px;">
                    <input value="Devolvido" type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </article>
    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>