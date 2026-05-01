<?php
class Login
{

    public string $login;
    public string $senha;
    
    public function validar(): string
    {
        if (empty($this->login) || empty($this->senha)) {
            return json_encode([
                'status' => 'erro',
                'mensagem' => 'Por favor, preencha todos os campos.'
            ]);
        }

        if ($this->login !== "admin" || $this->senha !== "projeto") {
            return json_encode([
                'status' => 'erro',
                'mensagem' => 'Login ou senha incorretos.'
            ]);
        }

        $_SESSION['login'] = $this->login;

        return json_encode(['status' => 'sucesso']);
    }

    public function setCredenciais(string $login, string $senha): void
    {
        $this->login = $login;
        $this->senha = $senha;
    }

    public function estaLogado(): bool
    {
        session_start();
        return isset($_SESSION['login']);
    }
}
