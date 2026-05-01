<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="js_css/bootstrap.min.css">
    <link rel="stylesheet" href="js_css/jquery-ui.min.css">
    <link rel="stylesheet" href="js_css/estilo.css">
    <script src="js_css/jquery-4.0.0.min.js"></script>
    <script src="js_css/jquery-ui.min.js"></script>
    <script src="js_css/scripts.js"></script>
</head>

<body id="bodyLogin">
    <div class="blocoLogin">
        <h1>Login</h1>
        <div class="logo">
            <img src="imagens/lua_cosmica.png">
        </div>
        <form action="javascript:validaLogin()" method="post">

            <div class="bloco">
                <label for="login">Digite o login:</label>
                <input type="text" class="campoTexto" id="login" name="login">
            </div>

            <div class="bloco">
                <label for="senha">Digite a senha:</label>
                <input type="password" class="campoTexto" id="senha" name="senha">
            </div>
            <div class="bloco alinharDireita">
                <a class="esqueciSenha" href="javascript:alert('Login: admin\nSenha: projeto')">Esqueci minha senha</a>
                <input type="submit" class="botao" value="Login">
            </div>
        </form>
    </div>
</body>

</html>

<script>
    // Script para limpar a borda de erro quando o usuário começar a digitar novamente
    $('input').on('input', function() {
        $(this).removeClass('bordaErro');
    });
</script>