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
            <div class="formDiv">
                <div class="labelInput">
                    <label for="cep">Digite o CEP</label>
                    <input type="text" class="campoTexto" name="cep" id="cep" placeholder="CEP" value="">
                </div>
                <div class="labelInput">
                    <label for="uf">Selecione a UF</label>
                    <!-- <input type="text" class="campoTexto" name="uf" id="uf" placeholder="UF" value="">
                      -->
                    <select name="uf" id="uf" class="campoTexto">
                        <option value="">Selecione a UF</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="cidade">Digite a cidade</label>
                    <input type="text" class="campoTexto" name="cidade" id="cidade" placeholder="Cidade" value="">
                </div>
                <div class="labelInput">
                    <label for="bairro">Digite o bairro</label>
                    <input type="text" class="campoTexto" name="bairro" id="bairro" placeholder="Bairro" value="">
                </div>
            </div>
            <div class="formDiv">
                <div class="labelInput">
                    <label for="logradouro">Digite o logradouro</label>
                    <input type="text" class="campoTexto" name="logradouro" id="logradouro" placeholder="Logradouro" value="">
                </div>
                <div class="labelInput">
                    <label for="logradouro">Digite o número</label>
                    <input type="text" class="campoTexto" name="logradouro" id="logradouro" placeholder="Número" value="">
                </div>
            </div>
            <div class="formDiv alinharDireita">
                <input type="submit" class="botao" id="botaoSalvar" value="Salvar">
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
                    alert('CEP não encontrado');
                }
            });
        }
    });
</script>

<?php require_once "rodape.php"; ?>