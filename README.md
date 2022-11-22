# ATP da Disciplina de Fundamentos de Programação Web
## Projeto Coisas Emprestadas
### **Aluno:** Eduardo Quinalha

#### Instalação:
**Opção 1** - Docker compose
> docker compose up -d

Acessar: [localhost:8080](http://localhost:8080)

**Usuário:** admin@coisasemprestadas.com 
**Senha:** admin123 

**Opção 2** - Manualmente

1. Copiar o conteúdo desta pasta para o diretório /var/www/html do seu servidor (Apache com PHP);
2. Configurar os dados para acesso ao banco de dados no arquivo db_connect.php;
3. Criar uma base de dados chamada coisas;
4. (Opcional) Carregar o arquivo ./dump/dump.sql para sua base de dados

**Obs**: Se não for carregado nenhum dump, o sistema automaticamente vai criar o usuário admin@coisasemprestadas.com com a senha admin123