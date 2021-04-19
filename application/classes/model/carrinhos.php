<?php

defined('SYSPATH') OR die('No Direct Script Access');

Class Model_Carrinhos extends ORM {

    protected $_table_name = 'CARRINHOS';
    protected $_primary_key = array('CAR_SESSAO', "PRO_ID");
    protected $_sorting = array('CAR_DATA' => 'desc', 'CAR_TOTAL' => 'desc');
    
    //RELATIONSHIP
    protected $_belongs_to = array(
        'produtos' => array(
            'model'       => 'produtos',
            'foreign_key' => 'PRO_ID',
        ),
    );
    
    //REGRAS DE VALIDAÇÃO
    //Define all validations our model must pass before being saved
    //Notice how the errors defined here correspond to the errors defined in our Messages file
    public function rules() {
        return array(
            'CAR_QUANTIDADE' => array(
                array('not_empty')
            ), //Standard, build into Kohana validation library
            'CAR_VALOR_ITEM' => array(
                array('not_empty')
            ),
            'CAR_TOTAL' => array(
                array('not_empty')
            ),
            'CAR_DATA' => array(
                array('not_empty')
            ),
            'CAR_SESSAO' => array(
                array('not_empty'),
                array('min_length', array(':value', 32)),
                array('max_length', array(':value', 32))
            ),
            'PRO_ID' => array(
                array('not_empty'),
                array(array($this, 'exists'))
            )
        );
    }
    
    //FILTROS
    public function filters(){
        return array(
            'CAR_VALOR_ITEM' => array(
                array(array($this, 'arrumaValor')),
            ),
            'CAR_TOTAL' => array(
                array(array($this, 'arrumaValor'))
            ),
            'CAR_DATA' => array(
                array(array($this, 'arrumaData')),
            )
        );
    }

    public function __construct($id = NULL) {
        //GERA A TABELA
        Database::instance()->query(Database::INSERT, "CREATE TABLE IF NOT EXISTS CARRINHOS (
            CAR_SESSAO varchar(32) NOT NULL,
            PRO_ID int(11) unsigned NOT NULL,
            CAR_QUANTIDADE int(10) unsigned NOT NULL,
            CAR_VALOR_ITEM decimal(10,2) NOT NULL,
            CAR_TOTAL decimal(10,2) NOT NULL,
            CAR_DATA date NOT NULL,
            CAR_FRETE decimal(10,2) NOT NULL default '0.00',
            CAR_TIPOFRETE varchar(10) NOT NULL default 'PAC',
            CAR_AVISADO set('S','N') NOT NULL default 'N',
            CAR_CEP varchar(9) NOT NULL default '00000-000',
            FOP_ID int(11) unsigned NOT NULL default '2',
            COP_ID int(11) unsigned NOT NULL default '50',
            PRIMARY KEY  (CAR_SESSAO,PRO_ID),
            CONSTRAINT fk_carrinhospro FOREIGN KEY (PRO_ID) REFERENCES PRODUTOS(PRO_ID) ON DELETE RESTRICT ON UPDATE RESTRICT
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        
        parent::__construct($id);
    }
    
    //CHECA SE O PRODUTO EXISTE
    public static function exists($id) {
        $results = DB::select('*')->from("PRODUTOS")->where("PRO_ID", '=', $id)->execute()->as_array();
        if(count($results) == 0)
            return false;
        else
            return true;
    }
    
    //SELECT SUM
    public function selectSUM($id){
        return DB::select(array(DB::expr("SUM(CAR_TOTAL)"), "total"))->from($this->_table_name)
                ->where($this->_primary_key, "=", $id)
                ->execute();
    }
    
    //SELECT SUM QNT
    public function selectSUMqnt($id){
        return DB::select(array(DB::expr("SUM(CAR_QUANTIDADE)"), "qnt"))->from($this->_table_name)
                ->where($this->_primary_key, "=", $id)
                ->execute();
    }
}
