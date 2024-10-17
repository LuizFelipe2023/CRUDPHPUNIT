<?php

use PHPUnit\Framework\TestCase;
use app\Pessoa;

class PessoaTest extends TestCase
{
    protected $stmt;
    protected $pdo;

    protected function setUp(): void
    {
       
        $this->stmt = $this->createMock(PDOStatement::class);
        
        $this->pdo = $this->createMock(PDO::class);
        $this->pdo->method('prepare')->willReturn($this->stmt);
    }

    public function testInsertPessoaNoBancoSuccess()
    {
        $this->stmt->method('execute')->willReturn(true);

        $pessoa = new Pessoa("João", 30, $this->pdo);
        $result = $pessoa->insertPessoaNoBanco();
        $this->assertEquals("Pessoa inserida com sucesso!", $result);
    }

    public function testFindPessoabyIdSuccess()
    {
        $this->stmt->method('execute')->willReturn(true);
        $this->stmt->method('fetch')->willReturn(['id' => 1, 'nome' => 'João', 'idade' => 30]);

        $pessoa = new Pessoa("João", 30, $this->pdo);
        $result = $pessoa->findPessoabyId(1);
        $this->assertEquals(['id' => 1, 'nome' => 'João', 'idade' => 30], $result);
    }

    public function testFindPessoabyIdNotFound()
    {
        $this->stmt->method('execute')->willReturn(true);
        $this->stmt->method('fetch')->willReturn(false);

        $pessoa = new Pessoa("João", 30, $this->pdo);
        $result = $pessoa->findPessoabyId(999);
        $this->assertEquals("Não foi possível encontrar este usuário", $result);
    }

    public function testFindAllPessoasSuccess()
    {
        $pessoasRetornadas = [
            ['id' => 1, 'nome' => 'João', 'idade' => 30],
            ['id' => 2, 'nome' => 'Maria', 'idade' => 25]
        ];

        $this->stmt->method('fetchAll')->willReturn($pessoasRetornadas);

        $pessoa = new Pessoa("Teste", 0, $this->pdo);
        $result = $pessoa->getAllPessoas();
        $this->assertEquals($pessoasRetornadas, $result);
    }

    public function testUpdatePessoaSuccess()
    {
        $this->stmt->method('execute')->willReturn(true);

        $pessoa = new Pessoa("Teste", 0, $this->pdo);
        $result = $pessoa->updatePessoa(1, 'João', 30);
        $this->assertEquals("Pessoa atualizada com sucesso!", $result);
    }

    public function testDeletePessoaSuccess()
    {
        $this->stmt->method('execute')->willReturn(true);

        $pessoa = new Pessoa("Teste", 0, $this->pdo);
        $result = $pessoa->deletePessoa(1);
        $this->assertEquals("Pessoa apagada com sucesso!", $result);
    }

    public function testDeletePessoaFailure()
    {
        $this->stmt->method('execute')->willReturn(false);

        $pessoa = new Pessoa("Teste", 0, $this->pdo);
        $result = $pessoa->deletePessoa(1);
        $this->assertEquals("Houve um erro ao apagar a pessoa selecionada.", $result);
    }
}
