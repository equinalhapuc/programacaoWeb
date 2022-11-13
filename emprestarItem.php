<!doctype html>
<html>
    <head>
        <title>Emprestar um Item</title>
    </head>
    <body>
        <div>
            <h1>Emprestar um Item</h1>
        </div>
        <div>
            <h2>Violão folk</h2>
            <img src="Violão.jpeg" width="300"/>
            <p>Violão tipo folk, cordas de aço, captação elétrica.</p>
        </div>
        <div>
            <h2>Pertence a:</h2>
            <span>João Silva</span>
            <span><a href="mailto:joao@hotmail.com">joao@hotmail.com</a></span><br>
            <span>(41)98732-2133</span><br>
        </div>
        <div>
            <h2>Emprestar:</h2>
            <form>
                <label>Data do empréstimo</label><br>
                <input type="date" required /><br>
                <label>Data da devolução</label><br>
                <input type="date" required /><br>
                <label>Observação</label><br>
                <textarea rows="4"></textarea><br>
                <input type="reset" /><input type="submit" />
            </form>
        </div>
    </body>
</html>