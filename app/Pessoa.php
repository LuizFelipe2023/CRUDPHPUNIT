<?php

namespace app;

require_once 'db.php';

class Pessoa {

        public $nome;
        public $idade;
        private $pdo; 

        public function __construct($nome, $idade, \PDO $pdo) 
        {
                $this->nome = $nome;
                $this->idade = $idade;
                $this->pdo = $pdo;
        }

        public function insertPessoaNoBanco()
        {
                $stmt = $this->pdo->prepare('INSERT INTO pessoas (nome, idade) VALUES (?, ?)');
                
                if ($stmt->execute([$this->nome, $this->idade])) {
                return "Pessoa inserida com sucesso!";
                } else {
                return "Erro ao inserir pessoa.";
                }
        }

        public function findPessoabyId($id)
        {
                $stmt = $this->pdo->prepare('SELECT * FROM pessoas WHERE id = :id');
                $stmt->bindParam(':id', $id, \PDO::PARAM_INT); 

                $pessoa = $stmt->fetch(\PDO::FETCH_ASSOC);

                if (!$pessoa) { 
                return "Não foi possível encontrar este usuário"; 
                }

                return $pessoa;
        }

        public function getAllPessoas()
        {
                $stmt = $this->pdo->prepare('SELECT * FROM pessoas');
                $stmt->execute();
                $pessoas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                if(!$pessoas){
                return "Houve um erro ao retornar a lista de pessoas";
                }

                return $pessoas;
        }

        public function updatePessoa($id, $nome, $idade)
        {
                $stmt = $this->pdo->prepare('UPDATE pessoas SET nome = ?, idade = ? WHERE id = ?');
                
                if ($stmt->execute([$nome, $idade, $id])) {
                        return "Pessoa atualizada com sucesso!";
                } else {
                        return "Erro ao atualizar pessoa.";
                }
        }

                public function deletePessoa($id)
        {
                $stmt = $this->pdo->prepare('DELETE FROM pessoas WHERE id = ?');
                $stmt->bindParam(1, $id, \PDO::PARAM_INT);
                
                if ($stmt->execute()) {
                        return "Pessoa apagada com sucesso!";
                } else {
                        return "Houve um erro ao apagar a pessoa selecionada.";
                }
        }


}
