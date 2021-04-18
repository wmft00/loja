<?php

Class Retorno {

    function formataValor13_2($valor) {
        $i = substr($valor, 0, 11);
        $d = substr($valor, 11, 2);
        return floatval($i . "." . $d);
    }

    function lerArquivos($nomearquivo) {
        
        //$files = glob("*.CRT");
        $files = glob("boletos/retorno/".$nomearquivo);
        $retorno = array();
        $boletos = array();
        foreach ($files as $f) {
            $header = array();
            $trailer = array();
            $ret = array();
            foreach (file($f) as $line) {
                if (substr($line, 0, 1) == 0) {
                    $header["codBeneficiario"] = substr($line, 26, 5);
                    $header["cnpjBeneficiario"] = substr($line, 31, 14);
                    $header["banco"] = substr($line, 76, 3);
                    $header["sequencial"] = substr($line, 394, 6);
                    $header["numeroRetorno"] = substr($line, 110, 7);
                }

                if (substr($line, 0, 1) == 1) {
                    $boleto = array();
                    $boleto["tpCobranca"] = substr($line, 13, 1);
                    $boleto["codPagador"] = substr($line, 19, 5);
                    $boleto["nossoNumero"] = substr($line, 47, 9);
                    //echo substr($line, 47, 9)."<br/>";
                    $boleto["ocorencia"] = substr($line, 108, 2);
                    $boleto["dataOcorencia"] = substr($line, 110, 6);
                    $boleto["numeroDoc"] = substr($line, 116, 10);
                    $boleto["valorTitulo"] = $this->formataValor13_2(substr($line, 152, 13));
                    $boleto["abatimento"] = $this->formataValor13_2(substr($line, 227, 13));
                    $boleto["desconto"] = $this->formataValor13_2(substr($line, 240, 13));
                    $boleto["valorPago"] = $this->formataValor13_2(substr($line, 253, 13));
                    $boleto["mora"] = $this->formataValor13_2(substr($line, 266, 13));
                    $boleto["multa"] = $this->formataValor13_2(substr($line, 279, 13));
                    $boleto["motOcorrencia"] = substr($line, 318, 2);
                    $boleto["dataLancamento"] = substr($line, 328, 8);
                    $boleto["sequencial"] = substr($line, 394, 6);
                    $boletos[] = $boleto;
                }

                if (substr($line, 0, 1) == 9) {
                    $trailer["codBeneficiario"] = substr($line, 5, 5);
                    $trailer["banco"] = substr($line, 2, 3);
                    $trailer["sequencial"] = substr($line, 394, 6);
                }
            }
            // $ret["header"] = $header;
            // $ret["boletos"] = $boletos;
            // $ret["trailer"] = $trailer;
            // $retorno[basename($f)] = $ret;
        }
        //echo json_encode($retorno);
        return $boletos;
//        foreach ($boletos as $k => $b) {
//            echo "Nosso Numero: ".$b["nossoNumero"]."<br/>";
//            echo "Data Ocorrencia: ".$b["dataOcorencia"]."<br/>";
//            echo "Numero Doc: ".$b["numeroDoc"]."<br/>";
//            echo "Valor Titulo: ".$b["valorTitulo"]."<br/>";
//            echo "Abatimento: ".$b["abatimento"]."<br/>";
//            echo "Desconto: ".$b["desconto"]."<br/>";
//            echo "Valor Pago: ".$b["valorPago"]."<br/>";
//            echo "Mora: ".$b["mora"]."<br/>";
//            echo "Multa: ".$b["multa"]."<br/>";
//            echo "Mot Ocorrencia: ".$b["motOcorrencia"]."<br/>";
//            echo "Ocorrencia: ".$b["ocorencia"]."<br/>";
//            echo "Data Lancamento: ".$b["dataLancamento"]."<br/>";
//            echo "<br/>";
//        }
    }

}

//$r = new Retorno();
//$r->lerArquivos();
?>