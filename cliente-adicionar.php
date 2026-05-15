<?php
require_once "topo.php";
$id = isset($_GET['id']) ? trim($_GET['id']) : '';
$tituloAcao = (!empty($id)) ? "Editar" : "Adicionar";

$nome = "";
$email = "";
$telefone = "";
$dataNascimento = "";
$cep = "";
$uf = "";
$cidade = "";
$bairro = "";
$logradouro = "";
$numero = "";

// Se está editando, carregamos os dados do cliente para preencher o formulário
if (!empty($id)) {
    $pdo = conectarPDO();
    $cliente = new Cliente();
    $res = $cliente->detalhes($pdo, $id);
    if ($res) {
        list($id, $nome, $email, $telefone, $dataNascimento, $cep, $uf, $cidade, $bairro, $logradouro, $numero) = $res;
    } else {
        // Cliente não encontrado, então redirecionamos de volta para a listagem de clientes
        header("Location: clientes");
    }
}
?>
<div class="pagina">
    <h1 class="tituloPagina"><?= $tituloAcao ?> cliente</h1>

    <div class="cabecalhoPagina">
        <input type="button" class="botao" value="Voltar" onclick="window.location.href='clientes'">
    </div>

    <form id="formClienteAdicionar" action="javascript:salvarCliente()">
        <div class="formulario">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="formDiv">
                <div class="labelInput">
                    <label for="nome">Digite o nome do cliente *</label>
                    <input type="text" class="campoTexto" name="nome" id="nome" placeholder="Nome completo" value="<?= $nome ?>">
                </div>
                <div class="labelInput">
                    <label for="email">Digite um e-mail válido *</label>
                    <input type="text" class="campoTexto" name="email" id="email" placeholder="E-mail" value="<?= $email ?>">
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="telefone">Digite o telefone *</label>
                    <input type="text" class="campoTexto" name="telefone" id="telefone" placeholder="Telefone" value="<?= $telefone ?>">
                </div>
                <div class="labelInput">
                    <label for="dataNascimento">Digite a data de nascimento *</label>
                    <input type="date" class="campoTexto" name="dataNascimento" id="dataNascimento" placeholder="Data de nascimento" value="<?= $dataNascimento ?>">
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="cep">Digite o CEP</label>
                    <input type="text" class="campoTexto" name="cep" id="cep" placeholder="CEP" value="<?= $cep ?>">
                </div>
                <div class="labelInput">
                    <label for="uf">Selecione a UF</label>
                    <select name="uf" id="uf" class="campoTexto">
                        <option value="">Selecione a UF</option>
                        <option value="AC" <?= ($uf == "AC" ? "selected" : "") ?>>Acre</option>
                        <option value="AL" <?= ($uf == "AL" ? "selected" : "") ?>>Alagoas</option>
                        <option value="AP" <?= ($uf == "AP" ? "selected" : "") ?>>Amapá</option>
                        <option value="AM" <?= ($uf == "AM" ? "selected" : "") ?>>Amazonas</option>
                        <option value="BA" <?= ($uf == "BA" ? "selected" : "") ?>>Bahia</option>
                        <option value="CE" <?= ($uf == "CE" ? "selected" : "") ?>>Ceará</option>
                        <option value="DF" <?= ($uf == "DF" ? "selected" : "") ?>>Distrito Federal</option>
                        <option value="ES" <?= ($uf == "ES" ? "selected" : "") ?>>Espírito Santo</option>
                        <option value="GO" <?= ($uf == "GO" ? "selected" : "") ?>>Goiás</option>
                        <option value="MA" <?= ($uf == "MA" ? "selected" : "") ?>>Maranhão</option>
                        <option value="MT" <?= ($uf == "MT" ? "selected" : "") ?>>Mato Grosso</option>
                        <option value="MS" <?= ($uf == "MS" ? "selected" : "") ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?= ($uf == "MG" ? "selected" : "") ?>>Minas Gerais</option>
                        <option value="PA" <?= ($uf == "PA" ? "selected" : "") ?>>Pará</option>
                        <option value="PB" <?= ($uf == "PB" ? "selected" : "") ?>>Paraíba</option>
                        <option value="PR" <?= ($uf == "PR" ? "selected" : "") ?>>Paraná</option>
                        <option value="PE" <?= ($uf == "PE" ? "selected" : "") ?>>Pernambuco</option>
                        <option value="PI" <?= ($uf == "PI" ? "selected" : "") ?>>Piauí</option>
                        <option value="RJ" <?= ($uf == "RJ" ? "selected" : "") ?>>Rio de Janeiro</option>
                        <option value="RN" <?= ($uf == "RN" ? "selected" : "") ?>>Rio Grande do Norte</option>
                        <option value="RS" <?= ($uf == "RS" ? "selected" : "") ?>>Rio Grande do Sul</option>
                        <option value="RO" <?= ($uf == "RO" ? "selected" : "") ?>>Rondônia</option>
                        <option value="RR" <?= ($uf == "RR" ? "selected" : "") ?>>Roraima</option>
                        <option value="SC" <?= ($uf == "SC" ? "selected" : "") ?>>Santa Catarina</option>
                        <option value="SP" <?= ($uf == "SP" ? "selected" : "") ?>>São Paulo</option>
                        <option value="SE" <?= ($uf == "SE" ? "selected" : "") ?>>Sergipe</option>
                        <option value="TO" <?= ($uf == "TO" ? "selected" : "") ?>>Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="cidade">Digite a cidade</label>
                    <input type="text" class="campoTexto" name="cidade" id="cidade" placeholder="Cidade" value="<?= $cidade ?>">
                </div>
                <div class="labelInput">
                    <label for="bairro">Digite o bairro</label>
                    <input type="text" class="campoTexto" name="bairro" id="bairro" placeholder="Bairro" value="<?= $bairro ?>">
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="logradouro">Digite o logradouro</label>
                    <input type="text" class="campoTexto" name="logradouro" id="logradouro" placeholder="Logradouro" value="<?= $logradouro ?>">
                </div>
                <div class="labelInput">
                    <label for="logradouro">Digite o número</label>
                    <input type="text" class="campoTexto" name="numero" id="numero" placeholder="Número" value="<?= $numero ?>">
                </div>
            </div>
            <div class="formDiv alinharDireita">
                <input type="submit" class="botao" style="background:var(--verde)" id="botaoSalvar" value="Salvar">
            </div>
        </div>
    </form>
</div>

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

    // Máscara para CEP
    $('#cep').on('input', function() {
        let valor = $(this).val().replace(/\D/g, '');
        if (valor.length > 8) {
            valor = valor.slice(0, 8);
        }
        let valorMascarado = '';
        for (let i = 0; i < valor.length; i++) {
            if (i === 5) {
                valorMascarado += '-';
            }
            valorMascarado += valor[i];
        }
        $(this).val(valorMascarado);
    });

    // No evento change do CEP, batemos no viacep para buscar os dados de endereço e preencher os campos automaticamente
    $('#cep').on('change', function() {
        let cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (!data.erro) {
                    $('#logradouro').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#uf').val(data.uf);
                } else {
                    mensagem('Aviso! CEP não encontrado.', 'erro');
                }
            });
        }
    });
</script>

<?php require_once "rodape.php"; ?>