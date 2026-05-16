<?php

class Cliente
{
    private ?int $id;
    private string $nome;
    private string $email;
    private string $telefone;
    private string $dataNascimento;
    private string $cep;
    private string $uf;
    private string $cidade;
    private string $bairro;
    private string $logradouro;
    private string $numero;

    public function setDados(?int $id, string $nome, string $email, string $telefone, string $dataNascimento, string $cep, string $uf, string $cidade, string $bairro, string $logradouro, string $numero): void
    {

        // Verificamos se os campos estão preenchidos
        if (empty($nome) || empty($email) || empty($telefone) || empty($dataNascimento) || empty($cep)) {
            throw new InvalidArgumentException("Por favor preencher todos os campos obrigatórios.");
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

        $this->id = $id;
        $this->nome = trim($nome);
        $this->email = trim($email);
        $this->telefone = trim($telefone);
        $this->dataNascimento = $dataNascimento;
        $this->cep = trim($cep);
        $this->uf = trim($uf);
        $this->cidade = trim($cidade);
        $this->bairro = trim($bairro);
        $this->logradouro = trim($logradouro);
        $this->numero = trim($numero);
    }

    public function salvar(PDO $pdo)
    {

        try {

            if (!empty($this->id)) {

                // Se o ID estiver presente, significa que estamos editando um cliente existente
                $sql = "UPDATE clientes SET nome = :nome, email = :email, telefone = :telefone, data_nascimento = :dataNascimento, cep = :cep, uf = :uf, cidade = :cidade, bairro = :bairro, logradouro = :logradouro, numero = :numero WHERE id = :id";

                $update = $pdo->prepare($sql);

                $update->execute([
                    ':nome' => $this->nome,
                    ':email' => $this->email,
                    ':telefone' => $this->telefone,
                    ':dataNascimento' => $this->dataNascimento,
                    ':cep' => $this->cep,
                    ':uf' => $this->uf,
                    ':cidade' => $this->cidade,
                    ':bairro' => $this->bairro,
                    ':logradouro' => $this->logradouro,
                    ':numero' => $this->numero,
                    ':id' => $this->id
                ]);
            } else {

                // Se o ID não estiver presente, significa que estamos adicionando um novo cliente
                $sql = "INSERT INTO clientes (nome, email, telefone, data_nascimento, cep, uf, cidade, bairro, logradouro, numero)
                    VALUES (:nome, :email, :telefone, :dataNascimento, :cep, :uf, :cidade, :bairro, :logradouro, :numero)";

                $insert = $pdo->prepare($sql);

                $insert->execute([
                    ':nome' => $this->nome,
                    ':email' => $this->email,
                    ':telefone' => $this->telefone,
                    ':dataNascimento' => $this->dataNascimento,
                    ':cep' => $this->cep,
                    ':uf' => $this->uf,
                    ':cidade' => $this->cidade,
                    ':bairro' => $this->bairro,
                    ':logradouro' => $this->logradouro,
                    ':numero' => $this->numero
                ]);
            }
        } catch (PDOException $e) {

            if ($e->errorInfo[1] === 1062) { // Código de erro para duplicidade de chave
                throw new RuntimeException("O e-mail já está cadastrado. Por favor, use outro e-mail.");
            }

            // Log do erro para análise posterior
            error_log("Erro ao salvar cliente: " . $e->getMessage());
            throw new RuntimeException($e->getMessage());
        }
    }
    public function listar(PDO $pdo, $filtroNome = null)
    {
        try {

            $filtros = "";

            if (!empty($filtroNome)) {
                $filtros .= " WHERE nome LIKE :filtroNome";
            }

            $query_clientes = $pdo->prepare("SELECT id, nome, email, telefone FROM clientes $filtros ORDER BY nome ASC");
            if (!empty($filtroNome)) {
                $query_clientes->bindValue(':filtroNome', '%' . $filtroNome . '%');
            }
            $query_clientes->execute();

            $resultados = $query_clientes->fetchAll(PDO::FETCH_NUM);

            return $resultados;
        } catch (PDOException $e) {
            // Log do erro para análise posterior
            error_log("Erro ao listar clientes: " . $e->getMessage());
            throw new RuntimeException("Erro ao listar os clientes: " . $e->getMessage());
        }
    }

    public function detalhes(PDO $pdo, int $id)
    {
        try {
            $query_cliente = $pdo->prepare("SELECT id, nome, email, telefone, data_nascimento, cep, uf, cidade, bairro, logradouro, numero FROM clientes WHERE id = :id");
            $query_cliente->execute([':id' => $id]);

            return $query_cliente->fetch(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            error_log("Erro ao obter detalhes do cliente: " . $e->getMessage());
            throw new RuntimeException("Erro ao obter detalhes do cliente: " . $e->getMessage());
        }
    }
}
