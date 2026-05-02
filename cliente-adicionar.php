<?php
require_once "topo.php";
$codigo = isset($_GET['codigo']) ? trim($_GET['codigo']) : '';
$tituloAcao = (!empty($codigo)) ? "Editar" : "Adicionar";

$nome = "";
$email = "";
$telefone = "";
$dataNascimento = "";

// Se está editando, carregamos os dados do cliente para preencher o formulário
// Aqui vc carrega uma função de dados() passando o código do cliente, e atualiza os valores nas variáveis pra já vir previamente preenchido
?>
<div class="pagina">
    <h1 class="tituloPagina"><?= $tituloAcao ?> cliente</h1>

    <div class="cabecalhoPagina">
        <input type="button" class="botao" value="Voltar" onclick="window.location.href='clientes'">
    </div>

    <form id="formClienteAdicionar" action="javascript:salvarCliente()">
        <div class="formulario">
            <input type="hidden" name="codigo" value="<?= $codigo ?>">
            <div class="formDiv">
                <div class="labelInput">
                    <label for="nome">Digite o nome do cliente</label>
                    <input type="text" class="campoTexto" name="nome" id="nome" placeholder="Nome completo" value="<?= $nome ?>">
                </div>
                <div class="labelInput">
                    <label for="email">Digite um e-mail válido</label>
                    <input type="text" class="campoTexto" name="email" id="email" placeholder="E-mail" value="<?= $email ?>">
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="telefone">Digite o telefone</label>
                    <input type="text" class="campoTexto" name="telefone" id="telefone" placeholder="Telefone" value="<?= $telefone ?>">
                </div>
                <div class="labelInput">
                    <label for="dataNascimento">Digite a data de nascimento</label>
                    <input type="date" class="campoTexto" name="dataNascimento" id="dataNascimento" placeholder="Data de nascimento" value="<?= $dataNascimento ?>">
                </div>
            </div>
            <div class="formDiv alinharDireita">
                <input type="submit" class="botao" id="botaoSalvar" value="Salvar">
            </div>
        </div>
    </form>
</div>
<?php require_once "rodape.php"; ?>

<script>
    // Máscara para telefone
    $('#telefone').on('input', function() {
        let valor = $(this).val().replace(/\D/g, '');
        if (valor.length > 11) {
            valor = valor.slice(0, 11);
        }
        let mascara = valor.length > 10 ? '(00) 0 0000-0000' : '(00) 0000-0000';
        let valorMascarado = '';
        let indiceMascara = 0;
        for (let i = 0; i < valor.length && indiceMascara < mascara.length; i++) {
            if (mascara[indiceMascara] === '0') {
                valorMascarado += valor[i];
                indiceMascara++;
            } else {
                valorMascarado += mascara[indiceMascara];
                indiceMascara++;
                i--;
            }
        }
        $(this).val(valorMascarado);
    });
</script>