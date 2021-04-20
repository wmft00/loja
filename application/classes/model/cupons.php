<?php

defined("SYSPATH") OR die("No Direct Script Access");

Class Model_Cupons extends ORM {

    protected $_table_name = "CUPONS";
    protected $_primary_key = "CUP_ID";
        protected $_sorting = array("CUP_ID" => "asc");
    
    //RELATIONSHIP
    protected $_belongs_to = array(
        "marca" => array(
            "model"       => "marca",
            "foreign_key" => "MAR_ID",
        ),
        "categoria" => array(
            "model"       => "categoria",
            "foreign_key" => "CAT_ID",
        ),
    );
    protected $_has_many = array(
    );
                
    //REGRAS DE VALIDAÇÃO
    //Define all validations our model must pass before being saved
    //Notice how the errors defined here correspond to the errors defined in our Messages file
    public function rules() {
        return array(
            "CUP_CODIGO" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 10)),
            ),
            "CUP_TIPO" => array(
                array("not_empty"),
                array(array($this, "valorVP")),
            ),
            "CUP_VALOR" => array(
                array("not_empty"),
            ),
        );
    }
    
    //FILTROS
    public function filters(){
        return array(
            "CUP_VALOR" => array(
                array(array($this, "arrumaValor")),
            ),
        );
    }

    public function __construct($id = NULL) {
        //GERA A TABELA
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS CUPONS (
            CUP_ID INT (11) unsigned NOT NULL auto_increment,
            CUP_CODIGO VARCHAR (10) NOT NULL ,
            CUP_TIPO SET ('V','P') NOT NULL  default 'P',
            CUP_VALOR DECIMAL (10,2) NOT NULL  default '0',
            MAR_ID INT (11) unsigned NULL ,
            CAT_ID INT (11) unsigned NULL ,
            PRIMARY KEY  (CUP_ID),
            FOREIGN KEY (MAR_ID) REFERENCES MARCA(MAR_ID) ON DELETE RESTRICT ON UPDATE RESTRICT,
            FOREIGN KEY (CAT_ID) REFERENCES CATEGORIA(CAT_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
        
        parent::__construct($id);
    }
                        
    //CHECA SE A MARCA EXISTE
    public static function existsMar($id) {
        $results = DB::select("*")->from("MARCA")->where("MAR_ID", "=", $id)->execute()->as_array();
        if(count($results) == 0)
            return false;
        else
            return true;
    }
                        
    //CHECA SE A CATEGORIA EXISTE
    public static function existsCat($id) {
        $results = DB::select("*")->from("CATEGORIA")->where("CAT_ID", "=", $id)->execute()->as_array();
        if(count($results) == 0)
            return false;
        else
            return true;
    }
    
    //ACEITA APENAS OS VALORES "V" OU " " (PARA VALOR Valor OU  Porcentagem)
    public function valorVP($valor) {
        //VERIFICA SE VALOR É VALIDO
        if($valor != "V" and $valor != "P"){
            return false;
        }else return true;
    }
}
