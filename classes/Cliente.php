<?php
class Cliente
{
    private string $nome;
    private string $email;
    private string $telefone;
    private string $dataNascimento;

    public function setDados(string $nome, string $email, string $telefone, string $dataNascimento): void
    {

        // Verificamos se os campos estão preenchidos
        if (empty($nome) || empty($email) || empty($telefone) || empty($dataNascimento)) {
            throw new InvalidArgumentException("Todos os campos são obrigatórios.");
        }

        // Validando se o e-mail é válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("E-mail inválido.");
        }

        // Validando se a data de nascimento é uma data válida e não é uma data futura
        $dataNascimentoObj = DateTime::createFromFormat('Y-m-d', $dataNascimento);
        if (!$dataNascimentoObj || $dataNascimentoObj > new DateTime()) {
            throw new InvalidArgumentException("Data de nascimento inválida.");
        }

        $this->nome = trim($nome);
        $this->email = trim($email);
        $this->telefone = trim($telefone);
        $this->dataNascimento = $dataNascimento;
    }

    public function salvar(PDO $pdo)
    {

        try {
            $sql = "INSERT INTO clientes (nome, email, telefone, data_nascimento)
                    VALUES (:nome, :email, :telefone, :dataNascimento)";

            $insert = $pdo->prepare($sql);

            $insert->execute([
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':telefone' => $this->telefone,
                ':dataNascimento' => $this->dataNascimento
            ]);
        } catch (PDOException $e) {

            if ($e->errorInfo[1] === 1062) { // Código de erro para duplicidade de chave
                throw new RuntimeException("O e-mail já está cadastrado. Por favor, use outro e-mail.");
            }

            // Log do erro para análise posterior
            error_log("Erro ao salvar cliente: " . $e->getMessage());
            throw new RuntimeException("Ocorreu um erro ao salvar o cliente. Por favor, tente novamente mais tarde.");
        }
    }
}
?>