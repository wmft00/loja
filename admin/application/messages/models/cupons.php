<?php

//These corespond to the fields that we are invalidating in our model and the error message that will be displayed on our form
return array(
    "CUP_CODIGO" => array(
        "not_empty" => "Código não pode ser vazio.",
        "min_length" => "Código deve ter pelo menos 3 caracteres.",
        "max_length" => "Código deve ter no máximo 10 caracteres."
    ),
    "CUP_TIPO" => array(
        "not_empty" => "Tipo não pode ser vazio.",
        "valorV " => "Tipo: Valor inválido."
    ),
    "CUP_VALOR" => array(
        "not_empty" => "Valor não pode ser vazio.",
    ),
);
?>                
