<!doctype html>
<html>

<head>
    <title>Cadastro de Item</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buscarItens.php">Buscar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="cadastroItem.php">Cadastrar Itens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastroUsuario.php">Cadastrar Usuários</a>
                </li>
            </ul>
        </div>
    </nav>

    <article class="container mt-5">
        <div>
            <h1>Cadastro de Item</h1>
        </div>
        <div>
            <form>
                <div class="mb-3 mt-3">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Ex: Violão folk" required autofocus />
                </div>
                <div class="mb-3">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" name="foto"/>
                </div>
                <div class="mb-3">
                    <label for="desc">Descrição</label>
                    <textarea rows="4" cols="25" class="form-control" name="desc" placeholder="Descrição ..."></textarea>
                </div>
                <div class="mb-3">
                    <input value="Enviar" type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </article>
    <footer class="mt-5 p-4 bg-dark text-white text-center" style="position: fixed;left: 0;bottom: 0;width: 100%;">
        Coisas Emprestadas - Todos os direitos reservados
    </footer>
</body>

</html>