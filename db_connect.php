<?php
//phpinfo();
$servername = "db";
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
  //$senha = password_hash("12345678", PASSWORD_BCRYPT);
  $senha = password_hash("admin123", PASSWORD_BCRYPT);
  $sql = "INSERT INTO usuario (nome, sobrenome, email, senha)
  VALUES ('Admin', 'admin', 'admin@coisasemprestadas.com', '$senha')";

  if ($conn->query($sql) === TRUE) {
    echo "Usuário admin criado com sucesso!";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }
}
