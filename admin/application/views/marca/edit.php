<div class="row"><section id="formulario">
    <div class="infos">
        <h1>Marca</h1>
    </div>
    
    <div class="col-md-12">
        <div class="box box-info">
            <form action="<?php echo url::base() ?>marca/save" class="form-horizontal" id="formEdit" name="formEdit" method="post">
                
            <div class="box-body">
	
        <!--SE NECESSÁRIO, EXPLICAÇÃO-->
        <!--<p></p>-->
        <!--FORMULARIO COM INFORMACOES-->
                <input type="hidden" id="MAR_ID" readonly name="MAR_ID" value="<?php echo $marca["MAR_ID"] ?>">
    
        <div class="form-group">
            <label for="MAR_NOME" class="col-sm-2 control-label">Nome *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Nome" value="<?php if($marca) echo $marca["MAR_NOME"] ?>" id="MAR_NOME" name="MAR_NOME" >
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