<?php

defined("SYSPATH") or die("No direct script access.");

class Controller_Ajax extends Controller_Index {

    public function before() {
        parent::before();
        $this->_name = $this->request->controller();

        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;
        }
    }


    public function action_buscamenu() {
        if ($this->request->is_ajax()) {
            $this->auto_render = FALSE;

            $post = $this->request->post();
            
            $digitado = $post["digitado"];
            
            $menu = "";

            //BUSCA AS CATEGORIAS DE MODULOS DOS MÓDULOS QUE O USUÁRIO TEM PERMISSÃO
            $categoriamodulo = ORM::factory("modulos")->with("categoriamodulo")->with("modulospermissoes")
                                    ->where("PER_ID", "=", $this->sessao->get("id_permissao" . $this->nomeSessao))
                                    ->group_by("CAM_ID")->order_by("CAM_ORDEM", "asc")->find_all();
            foreach ($categoriamodulo as $cam) {
                $modulos = ORM::factory("modulos")->with("modulospermissoes")
                                            ->where("PER_ID", "=", $this->sessao->get("id_permissao" . $this->nomeSessao))
                                            ->where("CAM_ID", "=", $cam->categoriamodulo->CAM_ID)
                                                ->where("MOD_NOME", "like", "%".$digitado."%")
                                            ->order_by("MOD_NOME", "asc")->find_all();
                if($modulos->count() > 0){
                    $menu .= '
                    <li class="header">'.$cam->categoriamodulo->CAM_NOME.'</li>';
                        foreach ($modulos as $mod) {
                            //VERIFICA SE É FAVORITO PARA COLOCAR A ESTRELINHA
                            //$favorito = ORM::factory("modulosfavoritos", array($mod->MOD_ID, $idvivente));
                            if(Request::current()->controller() == $mod->MOD_LINK){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            $menu .= '
                            <li class="'.$active.'">
                                <a href="'.url::base().$mod->MOD_LINK.'">';
                                    if($mod->MOD_ICONE == ""){ 
                                        $menu .= '<i class="fa fa-link"></i>';
                                    }else{
                                        $menu .= '<i class="'.$mod->MOD_ICONE.'"></i>';
                                    }
                                    $menu .= '
                                    <span>'.$mod->MOD_NOME.'</span>';
                                $menu .= '
                                </a>
                            </li>';

                        } 
                            
                }
            }
            
            echo json_encode(array("ok" => true, "menu" => $menu));
        }
    }

}

// End Ajax
