<?php
session_start();
include('db_connect.php');

//var_dump($_POST);
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}

if (isset($_POST) && !empty($_POST['destinatario']) && !empty($_POST['data']) && !empty($_POST['itemId'])) {
    $idDest = $_POST['destinatario'];
    $idItem = $_POST['itemId'];
    $dataEmprestimo = date('Y-m-d');
    $dataCombinada = $_POST['devolucao'];

    if (!empty($_POST['devolucao'])) {
        $sql = "INSERT INTO emprestimo (idItem, idDestinatario, dataEmprestimo, dataCombinada)
        VALUES ('$idItem', '$idDest', '$dataEmprestimo', '$dataCombinada')";
    } else {
        $sql = "INSERT INTO emprestimo (idItem, idDestinatario, dataEmprestimo, dataCombinada)
        VALUES ('$idItem', '$idDest', '$dataEmprestimo', null)";
    }

    $sql2 = "UPDATE item SET status = 1 WHERE id = $idItem";

    if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
        $msg = urlencode("Emprestimo registrado com sucesso!");
        $from = $_POST['from'];
        $conn->close();
        header("Location: $from?sucesso=1&msg=$msg");
    } else {
        $msg = urlencode($conn->error);
        $conn->close();
        header("Location: $from?sucesso=0&msg=$msg");
    }
}

?>
<!doctype html>
<html>

<head>
    <title>Emprestar item</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/dc6e25b1b9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Emrpéstimo</p>
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
        <div class="row">
            <div class="col">
                <h2>Emprestar Item</h2>
            </div>
        </div>
        <div class="row">
            <div>
                <form action="emprestarItem.php" method="post" name="emprestimo">
                    <?php
                    if (!isset($_GET['item']) || empty($_GET['item'])) {
                        $userId = $_SESSION['userId'];
                        $sql = "SELECT id, nome, descricao FROM item WHERE proprietario = $userId and status=0";
                        $result = $conn->query($sql);
                        echo "<select name=\"itemId\" class=\"form-select\" required>";
                        echo "<option value=0 disabled>Selecione um item</option>";
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $itemId = $row['id'];
                                $nome = $row['nome'];
                                echo "<option value=$itemId>$nome</option>";
                            }
                        }
                        echo "</select>";
                    } else {
                        $itemId = $_GET['item'];
                        $sql = "SELECT * FROM item WHERE id = $itemId and status = 0";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $itemId = $row['id'];
                                $nome = $row['nome'];
                                $desc = substr($row['descricao'], 0, 50);

                                echo "<table class=\"table table-striped\">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                echo "<tr>
                                    <td>$itemId</td>
                                    <td>$nome</td>
                                    <td>$desc</td>
                                </tr></tbody>
                                </table>";

                                $itemId = $_GET['item'];
                            }
                        } else {
                            echo "<tr><td colspan=3><strong>Item não encontrado</strong></td></tr>";
                        }
                    }
                    ?>

                    <?php
                    $from = $_GET['from'];
                    if (isset($_GET['item']) && !empty($_GET['item'])) {
                        echo "<input type=\"hidden\" name=\"itemId\" value=$itemId />";
                    }
                    echo "<input type=\"hidden\" name=\"from\" value=$from />";
                    ?>
                    <div class="mb-3 mt-3">
                        <label for="data">Destinatário</label>
                        <select name="destinatario" class="form-select" required>
                            <option value=0 disabled>Selecione um destinatário</option>
                            <?php
                            $meuId = $_SESSION['userId'];
                            $sql = "SELECT * FROM usuario WHERE id != $meuId";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $userId = $row['id'];
                                    $destNome = $row['nome'];
                                    $destSobrenome = $row['sobrenome'];
                                    $destEmail = $row['email'];

                                    echo "<option value=$userId>$destNome $destSobrenome - $destEmail</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="data">Data do empréstimo</label>
                        <input type="date" name="data" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label for="devolucao">Data da devolucao (opcional)</label>
                        <input type="date" name="devolucao" class="form-control" />
                    </div>
                    <div style="margin-bottom: 150px;">
                        <input value="Enviar" type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </article>
    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>