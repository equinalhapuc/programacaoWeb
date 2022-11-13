<!doctype html>
<html>

<head>
    <title>Página Inicial</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Página inicial</p>
    </header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buscarItens.php">Buscar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastroItem.php">Cadastrar Itens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastroUsuario.php">Cadastrar Usuários</a>
                </li>
            </ul>
        </div>
    </nav>

    <article class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Itens que peguei emprestado</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card" style="width:400px">
                    <img src="Violão.jpeg" class="card-img-top" style="width:100%" />
                    <div class="card-body">
                        <h4 class="card-title">Violão folk</h4>
                        <p class="card-text">Violão tipo folk, cordas de aço, captação elétrica.</p>
                        <p class="card-text">Pertence a: <strong>João Silva</strong><br>
                        <a href="mailto:joao@hotmail.com">joao@hotmail.com</a><br>
                        (41)98732-2133<br>
                        Data do empréstimo: 20/10/2022</p>
                        <a href="#" class="btn btn-primary">Já devolvi!</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h2>Itens que eu emprestei</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card" style="width:400px">
                    <img src="Fone.jpeg" class="card-img-top" style="width:100%"  />
                    <div class="card-body">
                        <h4 class="card-title">Fone de Ouvido</h4>
                        <p class="card-text">Fone tipo "Gamer". Com fio.</p>
                        <p class="card-text">Emprestei para: <strong>Maria silva</strong><br>
                        <a href="mailto:joao@hotmail.com">maria@hotmail.com</a><br>
                        (41)98732-2134<br>
                        Data do empréstimo: 20/10/2022</p>
                        <a href="#" class="btn btn-primary">Confirmar devolução</a>
                    </div>
                </div>
            </div>
        </div>
        
    </article>

    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>

</body>

</html>