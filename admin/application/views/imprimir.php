<!DOCTYPE html>
<html lang="pt">
    <head>
        <title><?php echo $titulo; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="Paulo Knob, Afonso Alban - DEZ/2012 - Conferido por Natyeli Silveira" />
        <meta name="copyright" content="copyright (c) ows" />

        <link href="<?php echo url::base(); ?>css/restrito.css" type="text/css" rel="stylesheet" />

        <script type="text/javascript">
            var URLBASE = "<?php echo url::base() ?>";
        </script>

        <!--JQUERY-->
        <script src="http://static.ows.com.br/libs/jquery/1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
        <!--FIM JQUERY-->

        <script src="http://static.ows.com.br/libs/maskedmoney/1.3.min.js" type="text/javascript"></script>
        <script src="http://static.ows.com.br/libs/maskedinput/1.3.min.js" type="text/javascript"></script>

        <!--FANCYBOX-->
        <script src="http://static.ows.com.br/libs/fancybox/1.3.1/jquery.fancybox-1.3.1.js" type="text/javascript"></script>
        <link rel="stylesheet" href="http://static.ows.com.br/libs/fancybox/1.3.1/jquery.fancybox-1.3.1.min.css" type="text/css" media="" />
        <!--FIM FANCYBOX-->

        <!--VALIDADOR-->
        <script src="http://static.ows.com.br/libs/validar/1.3.4/1.3.4.js" type="text/javascript"></script>
        <!--FIM VALIDADOR-->
        <script src="<?php echo url::base(); ?>js/forms_etc.js"></script>

        <script type="text/javascript" src="<?php echo url::base(); ?>js/jscolor/jscolor.js"></script>
    </head>
    <body>
        <section id="formulario">

            <!--SE NECESSÁRIO, EXPLICAÇÃO-->
            <!--<p></p>-->
            <!--FORMULARIO COM INFORMACOES-->
            <form class="padrao" id="formEdit" name="formEdit" method="post" action="<?php echo url::base() ?>pedidos/save">

                <input type="hidden" id="PED_ID" readonly name="PED_ID" value="<?php echo $pedido["PED_ID"] ?>">

                <div class="item-form">
                    <label>Código do Pedido</label>
                    <p><?php echo $pedido["PED_ID"]; ?></p>
                </div>

                <fieldset>
                    <legend>Dados do Cliente</legend>

                    <div class="item-form">
                        <label>Nome</label>
                        <p><?php echo $pedido["CLI_NOME"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>E-mail</label>
                        <p><?php echo $pedido["CLI_EMAIL"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Endereço</label>
                        <p><?php echo $pedido["CLI_ENDERECO"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Bairro</label>
                        <p><?php echo $pedido["CLI_BAIRRO"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>CEP</label>
                        <p><?php echo $pedido["CLI_CEP"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Cidade/UF</label>
                        <p><?php echo $pedido["CID_NOME"], " / ", $pedido["EST_SIGLA"]; ?></p>
                    </div>

                    <?php if ($pedido["TIPO_PESSOA"] == "F") { ?>
                        <div class="item-form">
                            <label>Tipo</label>
                            <p>Pessoa Física</p>
                        </div>

                        <div class="item-form">
                            <label>CPF</label>
                            <p><?php echo $pedido["CLI_CPF"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>RG</label>
                            <p><?php echo $pedido["CLI_RG"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>Data de Nascimento</label>
                            <p><?php echo $pedido["CLI_DATA_NASCIMENTO"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>Telefone</label>
                            <p><?php echo $pedido["CLI_TELEFONE"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>Celular</label>
                            <p><?php echo $pedido["CLI_CELULAR"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>Sexo</label>
                            <p><?php echo $pedido["CLI_SEXO"]; ?></p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="item-form">
                            <label>Tipo</label>
                            <p>Pessoa Jurídica</p>
                        </div>

                        <div class="item-form">
                            <label>CNPJ</label>
                            <p><?php echo $pedido["CLI_CNPJ"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>IE</label>
                            <p><?php echo $pedido["CLI_IE"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>Telefone</label>
                            <p><?php echo $pedido["CLI_TELEFONE"]; ?></p>
                        </div>

                        <div class="item-form">
                            <label>Contato</label>
                            <p><?php echo $pedido["CLI_CONTATO"]; ?></p>
                        </div>
                    <?php } ?>
                </fieldset>

                <!--<div class="item-form">
                    <label for="USU_EMAIL">E-mail</label>
                    <input type="text" id="USU_EMAIL" name="USU_EMAIL" validar="email" value="<php echo $pedido["USU_EMAIL"] ?>"> 
                </div>-->

                <fieldset>
                    <legend>Dados do Pedido</legend>

                    <div class="item-form">
                        <label>Data/Hora</label>
                        <p><?php echo $pedido["PED_DATA"], " - ", $pedido["PED_HORA"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Pagamento</label>
                        <p><?php echo $pedido["FOP_NOME"], " - ", $pedido["COP_NOME"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Total Produtos</label>
                        <p>R$ <?php echo number_format($pedido["PED_TOTAL_PEDIDO"] - $pedido["PED_VALOR_FRETE"], 2, ",", "."); ?></p>
                    </div>

                    <div class="item-form">
                        <label>Total Frete</label>
                        <p>R$ <?php echo $pedido["PED_VALOR_FRETE"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Total Pedido</label>
                        <p>R$ <?php echo $pedido["PED_TOTAL_PEDIDO"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label for="PES_ID">Status</label>
                        <select id="PES_ID" name="PES_ID" disabled="">
                            <?php foreach ($status as $sta) { ?>
                                <option value="<?php echo $sta->PES_ID ?>" <?php if ($sta->PES_ID == $pedido["PES_ID"]) echo "selected"; ?>>
                                    <?php echo $sta->PES_TITULO ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="item-form">
                        <label>Observação</label>
                        <p><?php echo $pedido["PED_OBS"]; ?></p>
                    </div>

                    <div class="item-form">
                        <label>Código de Rastreamento</label>
                        <p><?php echo $pedido["PED_RASTREAMENTO"]; ?></p>
                    </div>

                    <?php
                    if ($pedido["FOP_ID"] != 3) { //SE NAO FOR BOLETO, FAZ CONSULTA DO CARTÃO    
                        /* VER "/LAJEANDENSE", NÃO FIZ AQUI POR NAO TER CIELO.
                          ?>
                          <div class="item-form">
                          <label>Informação Pagamento</label>
                          <?php

                          require_once '../cielo/errorHandling.php';
                          require_once '../cielo/logger.php';
                          require_once '../cielo/pedido.php';
                          require_once "../cielo/includeCielo.php";

                          $PedidoCielo = new Pedido();

                          $_POST["formaPagamentoProduto"] = 2;

                          if ($pedido["FOP_ID"] == 1) {
                          $_POST["codigoBandeira"] = "visa";
                          if ($pedido["COP_ID"] == 1) {
                          $_POST["formaPagamentoProduto"] = 1;
                          }
                          } else if ($pedido["FOP_ID"] == 2) {
                          $_POST["codigoBandeira"] = "mastercard";
                          if ($pedido["COP_ID"] == 2) {
                          $_POST["formaPagamentoProduto"] = 1;
                          }
                          }

                          $PedidoCielo->dadosEcNumero = CIELO;
                          $PedidoCielo->dadosEcChave = CIELO_CHAVE;

                          switch($_POST["codigoBandeira"]){
                          case "visa":

                          $infos = DB::select("*")->from("PEDIDOS_CARTAO_VISA")->where("PED_ID", "=", $pedido["PED_ID"])->execute();
                          $info = $infos[0];
                          $tid = $info["TID"];
                          $status = $info["ARS"];
                          $banco = "PEDIDOS_CARTAO_VISA";
                          break;
                          case "mastercard":
                          $infos = DB::select("*")->from("PEDIDOS_CARTAO_REDECARD")->where("PED_ID", "=", $pedido["PED_ID"])->execute();
                          $info = $infos[0];
                          $tid = $info["TID"];
                          $status = $info["ARS"];
                          $banco = "PEDIDOS_CARTAO_REDECARD";
                          break;
                          default:
                          $infos = DB::select("*")->from("PEDIDOS_CARTAO_VISA")->where("PED_ID", "=", $pedido["PED_ID"])->execute();
                          $info = $infos[0];
                          $tid = $info["TID"];
                          $status = $info["ARS"];
                          $banco = "PEDIDOS_CARTAO_VISA";
                          break;
                          }

                          $PedidoCielo->tid = $tid;

                          $objResposta = $PedidoCielo->RequisicaoConsulta();
                          if($objResposta->autorizacao->mensagem != ""){
                          echo utf8_decode($objResposta->autorizacao->mensagem);
                          }else{
                          echo utf8_decode($objResposta->cancelamento->mensagem);
                          }

                          $statusAtual = $objResposta->status;

                          if($status != $statusAtual){
                          DB::update($banco)->set(array("ARS" => $statusAtual))->where("PED_ID", "=", $pedido["PED_ID"])->execute();
                          }

                          ?>
                          </div>
                          <?php */
                    }
                    ?>
                </fieldset>

                <fieldset>
                    <legend>Produto</legend>

                    <?php if ($produtos) { ?>
                        <table class="padrao">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col>
                            </colgroup>

                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor Unitário</th>
                                    <th>Valor Total</th>
                                </tr>
                            </thead>
                            <?php foreach ($produtos as $pro) { ?>
                                <tr>
                                    <td><?php echo $pro->produtos->PRO_TITULO ?></td>
                                    <td><?php echo $pro->PRO_QUANTIDADE ?></td>
                                    <td>R$ <?php echo number_format($pro->PRO_PRECO, 2, ",", ".") ?></td>
                                    <td>R$ <?php echo number_format($pro->PRO_PRECO*$pro->PRO_QUANTIDADE, 2, ",", ".") ?></td>
                                </tr>

                                    <?php
                            }
                            ?>
                        </table>
                    <?php } ?>
                </fieldset>
            </form>
        </section>
    </body>
</html>

<script>window.print();</script>