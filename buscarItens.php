<!doctype html>
<html>

<head>
    <title>Buscar itens</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="p-5 bg-secondary text-white">
        <h1>Coisas Emprestadas</h1>
        <p>Busca</p>
    </header>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="buscarItens.php">Buscar</a>
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
        <div>
            <h1>O que deseja pedir emprestado?</h1>
        </div>
        <div>
            <form>
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <input type="search" class="form-control"/>
                    </div>
                    <div class="col">
                        <input value="Buscar" type="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </article>
    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>