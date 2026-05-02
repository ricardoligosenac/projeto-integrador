/* SCRIPTS EM GERAL */
function mensagem(mensagem, status) {
    let divMensagem = $("<div>").addClass("mensagemAviso " + status).text(mensagem);

    $("body").append(divMensagem);

    divMensagem.show("drop", { direction: "right" });

    setTimeout(function () {
        divMensagem.hide("drop", { direction: "right" });
    }, 2500);

    // Remover a mensagem após a animação de ocultar
    setTimeout(function () {
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
        url: 'login-valida',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login.val(),
            senha: senha.val()
        },
        success: function (response) {

            // Verifica se retornou um JSON válido. Se não, exibe uma mensagem de erro genérica.
            if (!response.status) {
                mensagem('Resposta inesperada do servidor. Tente novamente.', 'erro');
                return;
            }

            if (response.status === 'sucesso') {
                window.location.href = 'clientes';
            } else {
                mensagem(response.mensagem, 'erro');
            }
        },
        error: function () {
            mensagem('Ocorreu um erro ao processar o login. Tente novamente.', 'erro');
        }
    })
}
/*LOGIN*/

/*CLIENTE*/
function salvarCliente() {

    // Desabilitamos o botão para evitar múltiplos cliques e mudamos o texto para indicar que está salvando
    $('#botaoSalvar').prop('disabled', true).val('Salvando...');

    // Antes de prosseguir, validamos. Se um dos campos estiver vazio, mostramos mensagem de erro e habilitamos o botão
    const campos = ['#nome', '#email', '#telefone', '#dataNascimento'];
    for (const campo of campos) {
        if ($(campo).val().trim() === '') {
            mensagem('Por favor, preencha todos os campos.', 'erro');
            $(campo).focus();
            $('#botaoSalvar').prop('disabled', false).val('Salvar');
            return;
        }
    }

    // Validamos o e-mail com um regex simples. Se for inválido, mostramos mensagem de erro e habilitamos o botão
    const email = $('#email').val().trim();
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        mensagem('Por favor, digite um e-mail válido.', 'erro');
        $('#email').focus();
        $('#botaoSalvar').prop('disabled', false).val('Salvar');
        return;
    }


    // Se chegou até aqui, os dados estão validados. Prosseguimos com a requisição AJAX para salvar o cliente
    const form = $('#formClienteAdicionar');
    const formData = form.serialize();

    $.ajax({
        url: 'cliente-salvar',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {

            if (!response.status) {
                mensagem('Resposta inesperada do servidor. Tente novamente.', 'erro');
                return;
            }

            if (response.status === 'sucesso') {
                alert('Cliente salvo com sucesso!');
                window.location.href = 'clientes';
            } else {
                mensagem(response.mensagem, 'erro');
            }
        },
        error: function () {
            mensagem('Ocorreu um erro ao salvar o cliente. Por favor, tente novamente mais tarde.', 'erro');
        }
    }).done(function () {
        // Habilitamos o botão novamente e restauramos o texto, independentemente do resultado da requisição
        $('#botaoSalvar').prop('disabled', false).val('Salvar');
    });
}
/*CLIENTE*/