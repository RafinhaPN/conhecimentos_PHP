<?php
class Pessoa
{
    public $response; 
    private $id;
    private $nome;
    public function setId(int $id)
    {
        $this->id = $id;
    }


    public function getId(): int
    {
        return  $this->id;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return  $this->nome;
    }
    // funcao que retorna a conexao com banco de dados
    private function Connection(): \PDO
    {

        return new \PDO("mysql:host=localhost;dbname=poo_crud", "root", "");
    }

    public function create(): array
    {
        $conn = $this->Connection();
        $stmt = $conn->prepare("INSERT INTO pessoa (nome) VALUES (:nome)");
        $stmt->bindValue(":nome", $this->getNome());
        if ($stmt->execute()) {
          $response=[
            "error" => false,
            "mensagem"=>" Pessoa Cadastrada com Sucesso!",
            "Listar" => $this->read()
          ];
          return $response;
        }

        return [];
    }
    public function read(): array
    {
        $conn = $this->Connection();
        $stmt = $conn->prepare("SELECT * FROM pessoa");
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $response=[
                "error" => false,
                "mensagem"=>" Listar!"
               ];
              return $response;
        }

        return [];
    }
    public function read_id(): array
    {
        $conn = $this->Connection();
        $stmt = $conn->prepare("SELECT * FROM pessoa WHERE id = :id");
        $stmt->bindValue(":id", $this->getId());
        if ($stmt->execute()) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
            $response=[
                "error" => false,
                "mensagem"=>" Listar!",
             //   "Listar" => $this->read_id()
               ];
              return $response;
        }

        return [];
    }

    public function update(): array
    {
        $conn = $this->Connection();
        $stmt = $conn->prepare("UPDATE pessoa SET nome = :nome WHERE id = :id ");
        $stmt->bindValue(":id", $this->getId());
        $stmt->bindValue(":nome", $this->getNome());
        if ($stmt->execute()) {
           // echo "Pessoa Atualizada com sucesso!";
           // return $this->read();
            $response=[
                "error" => false,
                "mensagem"=>" Pessoa Atualizada com Sucesso!",
                "Listar" => $this->read()
              ];
              return $response;
        }

        return [];
    }
    public function delete(): array
    {
        $pessoa = $this->read();
        $conn = $this->Connection();
        $stmt = $conn->prepare("DELETE FROM pessoa  WHERE id = :id ");
        $stmt->bindValue(":id", $this->getId());
        if ($stmt->execute()) {
           // echo "Pessoa Apagada com sucesso!";
           // return $pessoa;
            $response=[
                "error" => false,
                "mensagem"=>" Pessoa Apagada com Sucesso!",
             ];
              return $response;
        }

        return [];
    }
}
