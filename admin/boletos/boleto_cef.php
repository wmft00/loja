<?php
error_reporting(0);

// Dados do banco de dados
$localizacao = "localhost";
$bancoDeDados = "pertu036_gestor";
$usuarioBanco = "pertu036_gestor";
$senha = "2ic1cLmnvxS3";

// Conex�o com o banco de dados
mysql_connect($localizacao, $usuarioBanco, $senha) or die("N&atilde;o foi poss&iacute;vel conectar com o banco de dados<br />Entre em contato com seu administrador ou, se voc&ecirc; &eacute; o administrador, confira os dados de configura&ccedil;&atilde;o");
mysql_select_db($bancoDeDados) or die("N&atilde;o foi poss&iacute;vel selecionar o banco de dados<br />Entre em contato com seu administrador ou, se voc&ecirc; &eacute; o administrador, confira os dados de configura&ccedil;&atilde;o");

// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa                |
// |                                                                      |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto CEF: Elizeu Alcantara                         |
// +----------------------------------------------------------------------+
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//
// DADOS DO BOLETO PARA O SEU CLIENTE

$rainekin = mysql_query("select c.*, cid.CID_NOME, e.EST_SIGLA, cf.CLF_NOME, cf.CLF_CPF, cj.CLF_RAZAO_SOCIAL, cj.CLF_CNPJ 
    from CLIENTE_FORNECEDOR as c 
    inner join CIDADES as cid on cid.CID_ID = c.CID_ID
    inner join ESTADOS as e on e.EST_ID = cid.EST_ID
    left join CLIENTE_FORNECEDOR_PF as cf on cf.CLF_ID = c.CLF_ID
    left join CLIENTE_FORNECEDOR_PJ as cj on cj.CLF_ID = c.CLF_ID
    where c.CLF_ID = ".$_POST["CLF_ID"]);
$rain = mysql_fetch_assoc($rainekin);

$parcelasreceber = mysql_query("select * 
    from PARCELAS_RECEBER as p 
    inner join CONTAS_RECEBER as c on c.COR_ID = p.COR_ID
    where p.PAR_ID = ".$_POST["PAR_ID"]);
$parcela = mysql_fetch_assoc($parcelasreceber);

$valor_parcela = number_format($parcela["PAR_VALOR_PARCELA"], 2, "", "");

//$dias_de_prazo_para_pagamento = 3;
//$taxa_boleto = 2.95;
//DEIXAR SEM TAXA
$taxa_boleto = 0;
//$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$vencimento = explode("-", $parcela["PAR_DATA_VENCIMENTO"]);
$data_venc = $vencimento[2]."/".$vencimento[1]."/".$vencimento["0"];  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = number_format($valor_parcela/100, 2, ".", ""); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
//$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto = number_format($valor_cobrado + $taxa_boleto, 2, ',', '');

$dadosboleto["inicio_nosso_numero"] = date("y"); // Ano da gera��o do t�tulo ex: 07 para 2007 
$dadosboleto["nosso_numero"] = $_POST["PAR_ID"];     // Nosso numero (m�x. 5 digitos) - Numero sequencial de controle.
$dadosboleto["numero_documento"] = $_POST["PAR_ID"]; // Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$data_documento = explode("-", $parcela["COR_DATA_DOCUMENTO"]);
$dadosboleto["data_documento"] = $data_documento[2]."/".$data_documento[1]."/".$data_documento["0"]; // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto;  // Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

//ARRUMA O NOME, DEPENDENDO SE FOR FISICO OU JURIDICO
if($rain["CLF_PESSOA"] == "F"){
    $nome = $rain["CLF_NOME"];
    $cpfCnpj = $rain["CLF_CPF"];
}else{
    $nome = $rain["CLF_RAZAO_SOCIAL"];
    $cpfCnpj = $rain["CLF_CNPJ"];
}

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $nome. " - ".$cpfCnpj;
$dadosboleto["endereco1"] = utf8_encode($rain["CLF_ENDERECO"]).", ".$rain["CLF_NUMERO"]." - ".$rain["CLF_BAIRRO"];
$dadosboleto["endereco2"] = utf8_encode($rain["CID_NOME"])."/".$rain["EST_SIGLA"]." -  CEP: ".$rain["CLF_CEP"];

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de parcela referente ao documento Nº: ".$parcela["COR_NUMERO_DOCUMENTO"];
$dadosboleto["demonstrativo2"] = "Valor Total: ".number_format($parcela["COR_VALOR_DOCUMENTO"],2,',','.')." em ".$parcela["COR_QUANTIDADE_PARCELAS"]  ."x";
//$dadosboleto["demonstrativo3"] = "";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "APÓS O VENCIMENTO COBRAR:";
$dadosboleto["instrucoes2"] = "- JUROS DE 1% A.M";
$dadosboleto["instrucoes3"] = "- MULTA DE 2%";
//$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";


// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //
// DADOS DA SUA CONTA - CEF
$dadosboleto["agencia"] = "1565"; // Num da agencia, sem digito
$dadosboleto["conta"] = "13877"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "4"; 	// Digito do Num da conta
// DADOS PERSONALIZADOS - CEF
$dadosboleto["conta_cedente"] = "87000000414"; // ContaCedente do Cliente, sem digito (Somente Números)
$dadosboleto["conta_cedente_dv"] = "3"; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "CR";  // Código da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"] = "Gestor - Pertusoftware";
$dadosboleto["cpf_cnpj"] = "24.957.620/0001-81";
$dadosboleto["endereco"] = "Av. Cogeno Peres, 690, 503";
$dadosboleto["cidade_uf"] = "Nova Prata / RS";
$dadosboleto["cedente"] = "FERNANDO PERTUSSATTI - EPP";

// NÃO ALTERAR!
include("include/funcoes_cef.php"); 
include("include/layout_cef.php");
?>
