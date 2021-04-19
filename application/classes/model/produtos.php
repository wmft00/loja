<?php

defined("SYSPATH") OR die("No Direct Script Access");

Class Model_Produtos extends ORM {

    protected $_table_name = "PRODUTOS";
    protected $_primary_key = "PRO_ID";
        protected $_sorting = array("PRO_ID" => "asc");
    
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
            "PRO_NOME" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 250)),
            ),
            "MAR_ID" => array(
                array("not_empty"),
                array(array($this, "existsMar")),
            ),
            "CAT_ID" => array(
                array("not_empty"),
                array(array($this, "existsCat")),
            ),
            "PRO_PRECO" => array(
                array("not_empty"),
            ),
            "PRO_ATIVO" => array(
                array("not_empty"),
                array(array($this, "valorSN")),
            ),
        );
    }
    
    //FILTROS
    public function filters(){
        return array(
            "PRO_PRECO" => array(
                array(array($this, "arrumaValor")),
            ),
        );
    }

    public function __construct($id = NULL) {
        //GERA A TABELA
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS PRODUTOS (
            PRO_ID INT (11) unsigned NOT NULL auto_increment,
            PRO_NOME VARCHAR (250) NOT NULL ,
            MAR_ID INT (11) unsigned NOT NULL ,
            CAT_ID INT (11) unsigned NOT NULL ,
            PRO_PRECO DECIMAL (10,2) NOT NULL  default '0',
            PRO_DESCRICAO TEXT ,
            PRO_ATIVO SET ('S','N') NOT NULL  default 'S',
            PRIMARY KEY  (PRO_ID),
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
}
