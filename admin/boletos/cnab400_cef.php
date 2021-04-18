<?php

/**
 * @ Autor: Whilton Reis
 * @ Data : 14/06/2016
 * @ Remessa Sicredi Cnab400
 */
Class Remessa {

    // 14 carácter / Cnpj do Cedente
    private $cnpjCedente = '24957620000181';
    // 04 carácter / Agência do Cedente
    private $agCedente = '0259';
    // 05 carácter / Codigo do Cedente
    private $codCedente = '83146';
	
	private $nomeEmpresa = 'Pertusoftware                ';
	
    // 02 carácter / Posto do Cedente
    private $postoCedente = '61';
    // 01 carácter / Byte de Identificação do cedente 1 - Cooperativa; 2 a 9 - Cedente
    private $byteidt = '2';
    // Fixado numero 2 Inicio da Sequëncia dos titulos (1 Reservado Para o Header)
    private $setSequencia = '2';
    // 01 carácter - Postagem do título / “S”- Para postar o título / “N” - Não postar e remeter para o Cedente
    private $postarTitulo = 'N';

    public function __construct($SetSacados) {
        ## REGISTRO HEADER
        // 01 carácter - Identificação do registro Header
        $this->titulo = '0';
        // 01 carácter - Identificação do arquivo remessa
        $this->titulo.= '1';
        // 07 carácter - Literal remessa
        $this->titulo.= 'REM.TST';
        // 02 carácter - Código do serviço de cobrança
        $this->titulo.= '01';
        // 15 carácter  - 'COBRANCA'= 08 e Brancos = 07
        $this->titulo.= 'COBRANCA' . self::PreencherCaracteres('7', 'vazio');
        // 05 carácter / Codigo do Cedente
        $this->titulo.= $this->agCedente;
        // 14 carácter - CNPJ do cedente
        $this->titulo.= $this->codCedente;
        // 10 carácter - em Branco
        $this->titulo.= self::PreencherCaracteres('10', 'vazio');
        // 03 carácter - Número do C ECON FEDERA 
		
		$this->titulo.= $this->nomeEmpresa;
		
        $this->titulo.= '104';
        // 15 carácter - 'C ECON FEDERA'= 07 e Brancos = 08
        $this->titulo.= 'C ECON FEDERAL' . self::PreencherCaracteres('8', 'vazio');
        // 08 carácter - Data de gravação do arquivo 'AAAAMMDD'
        $this->titulo.= date('Ymd');
        // 08 carácter - em Branco
        $this->titulo.= self::PreencherCaracteres('288', 'vazio');
        // 07 carácter - Número da remessa
        $this->titulo.= self::NumeroDaRemessa();
        // 273 carácter - em Branco
        //$this->titulo.= self::PreencherCaracteres('273', 'vazio');
        // 04 carácter - Versão do sistema (o ponto deve ser colocado) 
       // $this->titulo.= '2.00';
        // 06 carácter - Número seqüencial do registro
        $this->titulo.= self::SequencialRemessa('1');
        //Quebra de linha 
        $this->titulo.= chr(13) . chr(10);
        ## REGISTRO DETALHE (OBRIGATORIO)
        foreach ($SetSacados as $this->sacado) {
            // 01 carácter - Identificação do registro
            $this->titulo.= '1';
            // 01 carácter - Tipo de cobrança  “A” - C ECON FEDERA Com Registro 
			if (strlen($this->sacado[3]) == 14) {
				$this->titulo.= '02';
			} else {
				$this->titulo.= '01';
			}
            // 01 carácter - Tipo de carteira  “A” - Simples
            $this->titulo.= $this->cnpjCedente;
            // 01 carácter - Tipo de Impressão “A” - Normal / “B” – Carnê  
            $this->titulo.= $this->agCedente;
            // 12 carácter - em Branco
            //$this->titulo.= self::PreencherCaracteres('12', 'vazio');
            // 01 carácter - Tipo de moeda  “A” – Real
            $this->titulo.= $this->codCedente;
            // 01 carácter - Tipo de desconto “A” – Valor / “B” – Percentual
            $this->titulo.= '2';
            // 01 carácter - Tipo de juros “A” – Valor / “B” – Percentual
            $this->titulo.= '0';
            // 28 carácter - em Branco
            $this->titulo.= '00';
			
			$this->titulo.= $this->sacado[0].self::PreencherCaracteres(24 - strlen($this->sacado[0]), 'vazio');
            // 09 carácter - Nosso número
			
			$this->titulo.= '24';
			
            $this->titulo.= self::GerarNossoNumero($this->sacado[0]);
            // 06 carácter - em Branco
            $this->titulo.= self::PreencherCaracteres('3', 'vazio');
            // 06 carácter - Data da Instrução   "AAAAMMDD"
            //$this->titulo.= date('Ymd');
            // 01 carácter - Cadastro de titulo Campo deve estar vazio (sem preenchimento)
            $this->titulo.= self::PreencherCaracteres('29', 'vazio');
            // 01 carácter - Postagem do título / “S”- Para postar o título / “N” - Não postar e remeter para o Cedente
            $this->titulo.= '02';
            // 01 carácter - em Branco
            $this->titulo.= '01';
            // 01 carácter - Emissão do bloqueto - “A” – Impressão pelo SICREDI / “B” – Impressão pelo Cedente 
            $this->titulo.= $this->sacado[0].self::PreencherCaracteres(9 - strlen($this->sacado[0]), 'vazio');;
            // 06 carácter - Data de vencimento "DDMMYY"
            $this->titulo.= self::VerificaDataLimite($this->sacado[1]);
            // 13 carácter - Valor principal do título 
            $this->titulo.= str_pad(self::FormatarValor($this->sacado[2]), 13, "0", STR_PAD_LEFT);
            // 09 carácter - em Branco
            $this->titulo.= '104'.self::PreencherCaracteres('5', 'vazio');
            // 01 carácter - Espécie de documento / "01" DMI
            $this->titulo.= '01';
            // 01 carácter - Aceite do título  "S" Sim / "N" Não
            $this->titulo.= 'N';
            // 06 carácter - Data de emissão
            $this->titulo.= date('dma');
            // 02 carácter - Instrução de protesto automático - “02” -Não protestar automaticamente / “01” - Protestar automaticamente
            $this->titulo.= '02';
			//Segunda Instrução de Cobrança
			$this->titulo.= '00';
            // 13 carácter - Valor/% de juros por dia de atraso 
            $this->titulo.= '0000000000000';
            // 06 carácter - Data limite p/concessão de desconto  "DDMMAA"
            $this->titulo.= date('dmy');
            // 13 carácter - Valor/% do desconto 
            $this->titulo.= '0000000000000';
            // 13 carácter - Zeros
            $this->titulo.= self::PreencherCaracteres('13', 'zeros');
			// Valor do IOF a ser recolhido
			$this->titulo.= '0000000000000';
            // 13 carácter - Valor do abatimento
            $this->titulo.= '0000000000000';
            // 01 carácter - Tipo de pessoa do sacado: PF ou PJ - “1” - Pessoa Física / “2” - Pessoa Jurídica
            $this->titulo.= self::SelecionaTipoPessoa($this->sacado[3]);
            // 01 carácter - Zeros
            $this->titulo.= self::PreencherCaracteres('1', 'zeros');
            // 14 carácter - CPF/CNPJ do sacado 
            $this->titulo.= str_pad($this->sacado[3], 14, "0", STR_PAD_LEFT);
            // 40 carácter - Nome do sacado 
            $this->titulo.= self::FiltrarNome($this->sacado[4]);
            // 40 carácter - Endereço do sacado 
            $this->titulo.= self::FiltrarEndereco($this->sacado[5]);
			// CEP do Pagador
			//$this->titulo.= $this->sacado[6];
            $this->titulo.= self::VerificaDataLimite($this->sacado[1]);
            // 01 carácter - em branco 
            $this->titulo.= '0000000000';
			// Terceira Instrução de Cobrança
			$this->titulo.= '00';
			// Número de dias para início do protesto/ devolução
			$this->titulo.= '03';
			// Código da Moeda
			$this->titulo.= '1';
            // 06 carácter - Número seqüencial do registro   
            $this->titulo.= self::SequencialRemessa($this->setSequencia++);
            //Quebra de linha 		
            $this->titulo.= chr(13) . chr(10);
        }
        ## REGISTRO TRILER
        // 01 carácter - Identificação do registro titulo
        $this->titulo.= '9';
				
        $this->titulo.= self::PreencherCaracteres('393', 'vazio');
        // 06 carácter - Número seqüencial do registro 
        $this->titulo.= self::SequencialRemessa($this->setSequencia);
        //Quebra de linha 
        $this->titulo.= chr(13) . chr(10);
        //Gerar Arquivo
        self::GerarArquivo($this->titulo);
    }

    ## FUNÇÕES NÃO ALTERAR

    private function VerificaDataLimite($SetVencimento) {
        $this->criacao = date('d/m/Y');
        $this->criacao = self::GeraTimestamp($this->criacao);
        $this->vencimento = self::GeraTimestamp($SetVencimento);
        $this->diferenca = $this->vencimento - $this->criacao;
        $this->dias = (int) floor($this->diferenca / (60 * 60 * 24));
        if ($this->dias <= 7) {
            print('Minimo para vencimento é de 7 dias -> ' . $SetVencimento);
            exit;
        } else {
            $this->partes = explode('/', $SetVencimento);
            $this->vencimento = $this->partes[2] . '-' . $this->partes[1] . '-' . $this->partes[0];
            $this->vencimento = date('dmy', strtotime($this->vencimento));
            return $this->vencimento;
        }
    }

    private function GeraTimestamp($SetData) {
        $this->partes = explode('/', $SetData);
        return mktime(0, 0, 0, $this->partes[1], $this->partes[0], $this->partes[2]);
    }

    private function FormatarValor($SetValor) {
        $this->valor = str_replace(".", "", $SetValor);
        $this->valor = str_replace(",", "", $SetValor);
        return $this->valor;
    }

    private function SelecionaTipoPessoa($SetPessoa) {
        if (strlen($SetPessoa) == '11') {
            //Pessoa Física
            $this->tipoPessoa = '1';
        } elseif (strlen($SetPessoa) == '14') {
            //Pessoa Jurídica
            $this->tipoPessoa = '2';
        } else {
            print('Digite um Cpf com 11 Digitos ou Cnpj com 14 Digitos');
            exit;
        }
        return $this->tipoPessoa;
    }

    private function GerarNossoNumero($SetNossoNumero) {
        $this->NossoNumero = date('y') . $this->byteidt . str_pad($SetNossoNumero, 5, "0", STR_PAD_LEFT) .
                self::DigitoNossoNumero(
                        $this->agCedente .
                        $this->postoCedente .
                        $this->codCedente .
                        date('y') . $this->byteidt . str_pad($this->sacado[0], 5, "0", STR_PAD_LEFT)
        );
        return $this->NossoNumero;
    }

    private function DigitoNossoNumero($SetNumero) {
        $this->resto = self::ModuloOnze($SetNumero, 9, 1);
        $this->digito = 11 - $this->resto;
        if ($this->digito > 9) {
            $this->dv = 0;
        } else {
            $this->dv = $this->digito;
        }
        return $this->dv;
    }

    private function ModuloOnze($SetNum, $SetBase = 9, $SetR = 0) {
        $this->soma = 0;
        $this->fator = 2;
        for ($i = strlen($SetNum); $i > 0; $i--) {
            $this->numeros[$i] = substr($SetNum, $i - 1, 1);
            $this->parcial[$i] = $this->numeros[$i] * $this->fator;
            $this->soma += $this->parcial[$i];
            if ($this->fator == $SetBase) {
                $this->fator = 1;
            }
            $this->fator++;
        }
        if ($SetR == 0) {
            $this->soma *= 10;
            $this->digito = $this->soma % 11;
            return $this->digito;
        } elseif ($SetR == 1) {
            $this->r_div = (int) ($this->soma / 11);
            $this->digito = ($this->soma - ($this->r_div * 11));
            return $this->digito;
        }
    }

    private function NumeroDaRemessa() {
        // permissão 777 na pasta onde vai gerar o arquivo
        $this->sequencia = 'NumRemessaCef';
        $this->abrir = fopen($this->sequencia, "a+");
        $this->identificador = fread($this->abrir, filesize($this->sequencia));
        $this->gravar = fopen($this->sequencia, "w");
        if ($this->identificador == '9999999') {
            $this->identificador = 1;
        }
        $this->grava = fwrite($this->gravar, $this->identificador + 1);
        return str_pad($this->identificador, 7, "0", STR_PAD_LEFT);
    }

    private function PreencherCaracteres($SetInt, $SetTipo) {
        if ($SetTipo == 'zeros') {
            $this->caracter = '';
            for ($i = 1; $i <= $SetInt; $i++) {
                $this->caracter .= '0';
            }
        } elseif ($SetTipo == 'vazio') {
            $this->caracter = '';
            for ($i = 1; $i <= $SetInt; $i++) {
                $this->caracter .= ' ';
            }
        }
        return $this->caracter;
    }

    private function SequencialRemessa($i) {
        if ($i < 10) {
            return self::Zeros('0', '5') . $i;
        } elseif ($i >= 10 && $i < 100) {
            return self::Zeros('0', '4') . $i;
        } elseif ($i >= 100 && $i < 1000) {
            return self::Zeros('0', '3') . $i;
        } elseif ($i >= 1000 && $i < 10000) {
            return self::Zeros('0', '2') . $i;
        } elseif ($i >= 10000 && $i < 100000) {
            return self::Zeros('0', '1') . $i;
        }
    }

    private function Zeros($SetMin, $SetMax) {
        $this->conta = ($SetMax - strlen($SetMin));
        $this->zeros = '';
        for ($i = 0; $i < $this->conta; $i++) {
            $this->zeros .= '0';
        }
        return $this->zeros . $SetMin;
    }

    private function LimitCaracteres($SetPalavra, $SetLimite) {
        if (strlen($SetPalavra) >= $SetLimite) {
            $this->var = substr($SetPalavra, 0, $SetLimite);
        } else {
            $max = (int) ($SetLimite - strlen($SetPalavra));
            $this->var = $SetPalavra . self::PreencherCaracteres($max, 'vazio');
        }
        return $this->var;
    }

    private function FiltrarNome($SetPalavra) {
        $this->string = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($SetPalavra)));
        return self::LimitCaracteres(strtoupper($this->string), '40');
    }
	
	private function FiltrarEndereco($SetPalavra) {
        $this->string = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($SetPalavra)));
        return self::LimitCaracteres(strtoupper($this->string), '75');
    }

    private function GerarArquivo($SetConteudo) {
        if (date('m') == '10') {
            $this->codMes = 'O' . date('d');
        } elseif (date('m') == '11') {
            $this->codMes = 'N' . date('d');
        } elseif (date('m') == '12') {
            $this->codMes = 'D' . date('d');
        } else {
            $this->codMes = substr(date('md'), 1);
        }
        // permissão 777 na pasta onde vai gerar o arquivo
        $this->NomeArquivo = $this->codCedente . $this->codMes . '.CRM';
        $this->fp = fopen($this->NomeArquivo, "w+");
        $this->fp = fwrite($this->fp, $SetConteudo);
        if ($this->fp) {
            print('Arquivo <a href=' . $this->NomeArquivo . '>' . $this->NomeArquivo . '</a> gerado com sucesso!');
        }
    }

}

## EXEMPLO DE USO
## LEGENDA
//0 - Nosso Numero / Max 05 carácter
//1 - Data Vencimento / Formato DD/MM/YYYY
//2 - Valor do Titulo / ex. 2,00
//3 - Cpf ou Cnpj
//4 - Nome do Sacado
//5 - Endereço do Sacado
//6 - Cep do Sacado
### DADOS DOS CLIENTES PARA TESTE

$GetTitulo[] = array('267', '09/01/2017', '2,00', '03829504969', 'JOAO NINGUEM DA SILVA', 'R. JORGIOR DE ARMANI, 172', '86083310');
$GetTitulo[] = array('268', '09/01/2017', '3,00', '03829504969', 'MARIA DA SILVA NASCIM', 'R. JORGIOR DE ARMANI, 145', '86083310');
$GetTitulo[] = array('269', '09/01/2017', '4,00', '20105220000197', 'ABREU DA SILVA JUNIOR', 'R. JORGIOR DE ARMANI, 167', '86083310');
new Remessa($GetTitulo);