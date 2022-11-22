<?php
//phpinfo();
$servername = "coisas_db";
$username = "coisas";
$password = "coisas";

// Create connection
$conn = mysqli_connect($servername, $username, $password, "coisas");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, nome, sobrenome FROM usuario";
$result = $conn->query($sql);

// Setup inicial: Se não houver nenhum usuário na base, cria o usuário admin para uso inicial do sistema
if ($result->num_rows == 0) {

  $sql = "CREATE TABLE `usuario` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nome` varchar(25) NOT NULL,
    `sobrenome` varchar(25) NOT NULL,
    `email` varchar(50) NOT NULL,
    `senha` varchar(200) NOT NULL,
    `admin` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;";

  if ($conn->query($sql) === TRUE) {
    echo "Tabela usuario criada com sucesso!<br>";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }

  $senha = password_hash("admin123", PASSWORD_BCRYPT);
  $sql = "INSERT INTO usuario (nome, sobrenome, email, senha, admin)
  VALUES ('Admin', 'admin', 'admin@coisasemprestadas.com', '$senha', 1)";

  if ($conn->query($sql) === TRUE) {
    echo "Usuário admin criado com sucesso! Senha: admin123<br>";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }

  $sql = "CREATE TABLE `item` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nome` varchar(100) NOT NULL,
    `descricao` varchar(100) DEFAULT NULL,
    `proprietario` int(11) DEFAULT NULL,
    `status` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `proprietario` (`proprietario`),
    CONSTRAINT `item_ibfk_1` FOREIGN KEY (`proprietario`) REFERENCES `usuario` (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;";

  if ($conn->query($sql) === TRUE) {
    echo "Tabela item criada com sucesso!<br>";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }

  $sql = "CREATE TABLE `emprestimo` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idItem` int(11) NOT NULL,
    `idDestinatario` int(11) NOT NULL,
    `dataEmprestimo` varchar(30) NOT NULL,
    `dataCombinada` varchar(30) DEFAULT NULL,
    `dataDevolucao` varchar(30) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `idItem` (`idItem`),
    KEY `idDestinatario` (`idDestinatario`),
    CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`idItem`) REFERENCES `item` (`id`),
    CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`idDestinatario`) REFERENCES `usuario` (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;";

  if ($conn->query($sql) === TRUE) {
    echo "Tabela emprestimo criada com sucesso!<br>";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }
}
