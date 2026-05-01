/* SCRIPTS EM GERAL */
function mensagem(mensagem, status) {
    let divMensagem = $("<div>").addClass("mensagemAviso " + status).text(mensagem);
    
    $("body").append(divMensagem);
    
    divMensagem.show("drop", { direction: "right" });
    
    setTimeout(function() {
        divMensagem.hide("drop", { direction: "right" });
    }, 2500);

    // Remover a mensagem após a animação de ocultar
    setTimeout(function() {
        divMensagem.remove();
    }, 3000);
}
/* SCRIPTS EM GERAL */

/* LOGIN */
function validaLogin() {
    const login = $('#login');
    const senha = $('#senha');

    // Validamos os campos
    if (login.val() === '') {
        mensagem('O campo de login é obrigatório.', 'erro');
        login.addClass('bordaErro').focus();
        return;
    }

    if (senha.val() === '') {
        mensagem('O campo de senha é obrigatório.', 'erro');
        senha.addClass('bordaErro').focus();
        return;
    }

    // Envia os dados para o servidor usando AJAX
    $.ajax({
        url: 'login_valida',
        type: 'POST',
        data: {
            login: login.val(),
            senha: senha.val()
        },
        success: function(response) {

            // Verifica se retornou um JSON válido. Se não, exibe uma mensagem de erro genérica.
            if (!response || typeof response !== 'string') {
                mensagem('Resposta inesperada do servidor. Tente novamente.', 'erro');
                return;
            }

            dados = JSON.parse(response);

            if (dados.status === 'sucesso') {
                window.location.href = 'clientes';
            } else {
                mensagem(dados.mensagem, 'erro');
            }
        },
        error: function() {
            mensagem('Ocorreu um erro ao processar o login. Tente novamente.', 'erro');
        }
    })
}
/*LOGIN*/