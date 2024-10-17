# CRUDPHPUNIT

## Introdução
Foram implementadas melhorias no CRUD (Create, Read, Update, Delete) da classe `Pessoa`, além de testes unitários utilizando o PHPUnit para garantir que as funcionalidades estejam funcionando corretamente.

## 1. Estrutura do CRUD
A classe `Pessoa` agora possui os seguintes métodos para gerenciar os dados de pessoas no banco de dados:

- **`insertPessoaNoBanco()`**: Insere uma nova pessoa no banco de dados.
- **`findPessoaById($id)`**: Recupera uma pessoa do banco de dados pelo seu ID.
- **`getAllPessoas()`**: Recupera todas as pessoas do banco de dados.
- **`updatePessoa($id, $nome, $idade)`**: Atualiza os dados de uma pessoa existente.
- **`deletePessoa($id)`**: Remove uma pessoa do banco de dados.

## 2. Testes Unitários com PHPUnit
Foram criados testes unitários para verificar o correto funcionamento dos métodos da classe `Pessoa`. Os testes incluem:

- **`testInsertPessoaNoBancoSuccess`**: Verifica se a inserção de uma nova pessoa retorna a mensagem de sucesso.
- **`testFindPessoabyIdSuccess`**: Verifica se a busca por uma pessoa pelo ID retorna os dados corretos.
- **`testFindPessoabyIdNotFound`**: Verifica se a busca por uma pessoa inexistente retorna a mensagem de erro adequada.
- **`testFindAllPessoasSuccess`**: Verifica se a recuperação de todas as pessoas retorna os dados corretos.
- **`testUpdatePessoaSuccess`**: Verifica se a atualização dos dados de uma pessoa retorna a mensagem de sucesso.
- **`testDeletePessoaSuccess`**: Verifica se a remoção de uma pessoa retorna a mensagem de sucesso.
- **`testDeletePessoaFailure`**: Verifica se a remoção de uma pessoa que não existe retorna a mensagem de erro adequada.

## 3. Execução dos Testes
Os testes foram executados com sucesso utilizando o comando:

```bash
php vendor/bin/phpunit tests/PessoaTest.php
