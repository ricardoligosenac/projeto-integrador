<?php
class Cliente {
    private string $nome;
    private string $email;
    private string $telefone;
    private string $dataNascimento;

    public function setDados(string $nome, string $email, string $telefone, string $dataNascimento): void {
        $this->nome = trim($nome);
        $this->email = trim($email);
        $this->telefone = trim($telefone);
        $this->dataNascimento = $dataNascimento;
    }

    public function salvar(PDO $pdo): bool {
        $sql = "INSERT INTO clientes (nome, email, telefone, data_nascimento)
                VALUES (:nome, :email, :telefone, :dataNascimento)";

        $insert = $pdo->prepare($sql);

        return $insert->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':telefone' => $this->telefone,
            ':dataNascimento' => $this->dataNascimento
        ]);
    }
}
?>