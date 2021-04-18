<div class="row"><section id="formulario">
    <div class="infos">
        <h1>Cupons</h1>
    </div>
    
    <div class="col-md-12">
        <div class="box box-info">
            <form action="<?php echo url::base() ?>cupons/save" class="form-horizontal" id="formEdit" name="formEdit" method="post">
                
            <div class="box-body">
	
        <!--SE NECESSÁRIO, EXPLICAÇÃO-->
        <!--<p></p>-->
        <!--FORMULARIO COM INFORMACOES-->
                <input type="hidden" id="CUP_ID" readonly name="CUP_ID" value="<?php echo $cupons["CUP_ID"] ?>">
    
        <div class="form-group">
            <label for="CUP_CODIGO" class="col-sm-2 control-label">Código *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Código" value="<?php if($cupons) echo $cupons["CUP_CODIGO"] ?>" id="CUP_CODIGO" name="CUP_CODIGO" >
            </div>
        </div>
                            
        <div class="form-group multiplo" label="Tipo">
            <label for="CUP_TIPO" class="col-sm-2 control-label">Tipo *</label>
            <div class="col-sm-10">
            <input type="radio" name="CUP_TIPO" <?php if ($cupons["CUP_TIPO"] == "V") echo "checked"; ?> id="TIPOValor" value="V" validar="radio"> Valor &nbsp;&nbsp;&nbsp;
            <!--<label for="TIPOValor" class="col-sm-2 control-label">Valor</label>-->
            <input type="radio" name="CUP_TIPO" <?php if ($cupons["CUP_TIPO"] == "P") echo "checked"; ?> id="TIPOPorcentagem" value="P" validar="radio">  Porcentagem &nbsp;&nbsp;&nbsp;
            <!--<label for="TIPO Porcentagem" class="col-sm-2 control-label"> Porcentagem</label>-->
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="CUP_VALOR" class="col-sm-2 control-label">Valor *</label>
            <div class="col-sm-10">
                <input type="text" validar="texto"  class="form-control valor pequeno" placeholder="Valor" value="<?php if($cupons) echo number_format($cupons["CUP_VALOR"], 2, ",", ".") ?>" id="CUP_VALOR" name="CUP_VALOR">
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="MAR_ID" class="col-sm-2 control-label">Marca</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="MAR_ID" name="MAR_ID">
                    <option value="">Selecione</option>
                    <?php foreach($marca as $mar){ ?>
                    <option value="<?php echo $mar->MAR_ID ?>" <?php if($mar->MAR_ID == (int)$cupons["MAR_ID"]) echo "selected"; ?>>
                        <?php echo $mar->MAR_NOME?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="CAT_ID" class="col-sm-2 control-label">Categoria</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="CAT_ID" name="CAT_ID"  >
                    <option value="">Selecione</option>
                    <?php foreach($categoria as $cat){ ?>
                    <option value="<?php echo $cat->CAT_ID ?>" <?php if($cat->CAT_ID == (int)$cupons["CAT_ID"]) echo "selected"; ?>>
                        <?php echo $cat->CAT_NOME ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
                                        
                </div>

                <div class="box-footer">
                    <p class="legenda"><em>*</em> Campos obrigatórios.</p>
                    <button type="submit" class="btn pull-right btn-success" id="salvar">Salvar</button>
                    <button type="reset" class="btn btn-danger" onClick="history.go(-1)" id="limpa" >Cancelar</button>
                </div></form>
        </div>
    </div>
</section></div>