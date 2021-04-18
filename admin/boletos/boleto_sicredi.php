<?php
error_reporting(0);

// Dados do banco de dados
$localizacao = "localhost";
$bancoDeDados = "zadmin_movelsat";
$usuarioBanco = "movelsat";
$senha = "y7arury7u";

// Conex�o com o banco de dados
mysql_connect($localizacao, $usuarioBanco, $senha) or die("Não foi possível conectar com o banco de dados<br />Entre em contato com seu administrador ou, se você é o administrador, confira os dados de configuração");
mysql_select_db($bancoDeDados) or die("Não foi possível selecionar o banco de dados<br />Entre em contato com seu administrador ou, se você é o administrador, confira os dados de configuração");

// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do    |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa                |
// |                                                                       |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+
// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenv Boleto SICREDI: Rafael Azenha Aquini <rafael@tchesoft.com>    |
// |                        Marco Antonio Righi <marcorighi@tchesoft.com> |
// | Homologa��o e ajuste de algumas rotinas.                               |
// |                        Marcelo Belinato  <mbelinato@gmail.com>       |
// +----------------------------------------------------------------------+
// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)  //
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


$contabancaria = mysql_query("select * 
    from CONTA_BANCARIA as c where c.COB_ID = ".$parcela["COB_ID"]);
$conta = mysql_fetch_assoc($contabancaria);
  
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
$dadosboleto["nosso_numero"] = $parcela["PAR_SEQUENCIAL"];     // Nosso numero (m�x. 5 digitos) - Numero sequencial de controle.
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
$dadosboleto["aceite"] = "NÃO";     // N - remeter cobran�a sem aceite do sacado  (cobran�as n�o-registradas)
// S - remeter cobran�a apos aceite do sacado (cobran�as registradas)
$dadosboleto["especie"] = "REAL";
$dadosboleto["especie_doc"] = "DI"; // OS - Outros segundo manual para cedentes de cobran�a SICREDI


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
// DADOS DA SUA CONTA - SICREDI
$dadosboleto["agencia"] = $conta["COB_AGENCIA"];//"0259";  // Num da agencia (4 digitos), sem Digito Verificador
$dadosboleto["conta"] = $conta["COB_NUMERO"];//"41557";  // Num da conta (5 digitos), sem Digito Verificador
$dadosboleto["conta_dv"] = $conta["COB_DIGITO"];//"0";  // Digito Verificador do Num da conta
// DADOS PERSONALIZADOS - SICREDI
$dadosboleto["posto"] = $conta["COB_POSTO"];//"06";      // C�digo do posto da cooperativa de cr�dito
$dadosboleto["byte_idt"] = "2";   // Byte de identifica��o do cedente do bloqueto utilizado para compor o nosso n�mero.
// 1 - Idtf emitente: Cooperativa | 2 a 9 - Idtf emitente: Cedente
$dadosboleto["carteira"] = "A";   // C�digo da Carteira: A (Simples) 
// SEUS DADOS
$dadosboleto["identificacao"] = "Movelsat";
$dadosboleto["cpf_cnpj"] = "73.757.502/0001-35";
$dadosboleto["endereco"] = "Av. dos Imograntes, 158, Sala 1, Centro";
$dadosboleto["cidade_uf"] = "São Jorge / RS";
$dadosboleto["cedente"] = "Movelsat Equipamento para  Comunicação LTDA ";

ob_start();
  
// N�O ALTERAR!
include("include/funcoes_sicredi.php");
include("include/layout_sicredi.php");
  
$content = ob_get_clean();
  
require_once(dirname(__FILE__).'/html2pdf/vendor/autoload.php');
//require_once('html2pdf/html2pdf.class.php');
try
{
  $html2pdf = new HTML2PDF('P','A4','fr', array(0, 0, 0, 0));
  /* Abre a tela de impressão */
  //$html2pdf->pdf->IncludeJS("print(true);");
  $html2pdf->pdf->SetDisplayMode('real');
  /* Parametro vuehtml = true desabilita o pdf para desenvolvimento do layout */
  $html2pdf->writeHTML($content);
  /* Abrir no navegador */
  $html2pdf->Output('boleto-'.$parcela["PAR_SEQUENCIAL"].'.pdf');
  
  /* Salva o PDF no servidor para enviar por email */
  //$html2pdf->Output('caminho/boleto.pdf', 'F');
  
  /* Força o download no browser */
  //$html2pdf->Output('boleto.pdf', 'D');
}
catch(HTML2PDF_exception $e) {
  echo $e;
  exit;
}
?>