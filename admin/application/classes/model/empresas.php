<?php

defined("SYSPATH") OR die("No Direct Script Access");

Class Model_Empresas extends ORM {

    protected $_table_name = "EMPRESAS";
    protected $_primary_key = "EMP_ID";
        protected $_sorting = array("EMP_ID" => "asc");
    
    //RELATIONSHIP
    protected $_belongs_to = array(
        "cidades" => array(
            "model"       => "cidades",
            "foreign_key" => "CID_ID",
        ),
    );
    protected $_has_many = array(
        "estabelecimentos" => array(
            "model"       => "estabelecimentos",
            "foreign_key" => "EMP_ID",
        ),
    );
                
    //REGRAS DE VALIDAÇÃO
    //Define all validations our model must pass before being saved
    //Notice how the errors defined here correspond to the errors defined in our Messages file
    public function rules() {
        return array(
            "EMP_RAZAO_SOCIAL" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 200)),
            ),
            "EMP_NOME_FANTASIA" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 200)),
            ),
            "EMP_CNPJ" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 50)),
            ),
            "EMP_CEP" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 20)),
            ),
            "EMP_ENDERECO" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 100)),
            ),
            "EMP_NUMERO" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 50)),
            ),
            "EMP_COMPLEMENTO" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 100)),
            ),
            "EMP_BAIRRO" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 100)),
            ),
            "EMP_EMAIL" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 100)),
            ),
            "EMP_TELEFONE" => array(
                array("not_empty"),
                array("min_length", array(":value", 3)),
                array("max_length", array(":value", 20)),
            ),
            "CID_ID" => array(
                array("not_empty"),
                array(array($this, "existsCid")),
            ),
        );
    }
    
    //FILTROS
    public function filters(){
        return array(
        );
    }

    public function __construct($id = NULL) {
        //GERA A TABELA
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS EMPRESAS (
            EMP_ID INT (11) unsigned NOT NULL auto_increment,
            EMP_RAZAO_SOCIAL VARCHAR (200) NOT NULL ,
            EMP_NOME_FANTASIA VARCHAR (200) NOT NULL ,
            EMP_CNPJ VARCHAR (50) NOT NULL ,
            EMP_INSCRICAO_ESTADUAL VARCHAR (100) NULL ,
            EMP_INSCRICAO_MUNICIPAL VARCHAR (100) NULL ,
            EMP_CNAE VARCHAR (100) NULL ,
            EMP_ESPECIALIZACAO VARCHAR (200) NULL ,
            EMP_CEP VARCHAR (20) NOT NULL ,
            EMP_ENDERECO VARCHAR (100) NOT NULL ,
            EMP_NUMERO VARCHAR (50) NOT NULL ,
            EMP_COMPLEMENTO VARCHAR (100) NOT NULL ,
            EMP_BAIRRO VARCHAR (100) NOT NULL ,
            EMP_EMAIL VARCHAR (100) NOT NULL ,
            EMP_TELEFONE VARCHAR (20) NOT NULL ,
            CID_ID INT (11) unsigned NOT NULL ,
            PRIMARY KEY  (EMP_ID),
            FOREIGN KEY (CID_ID) REFERENCES CIDADES(CID_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
        )ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
        
        parent::__construct($id);
    }
                        
    //CHECA SE A CIDADES EXISTE
    public static function existsCid($id) {
        $results = DB::select("*")->from("CIDADES")->where("CID_ID", "=", $id)->execute()->as_array();
        if(count($results) == 0)
            return false;
        else
            return true;
    }
}
