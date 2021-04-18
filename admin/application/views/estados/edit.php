<section id="formulario">
    <div class="infos">
        <h1>Estado</h1>
    </div>
    
    <div class="col-md-12">
        <div class="box box-info">
            <form action="<?php echo url::base() ?>estados/save" class="form-horizontal" id="formEdit" name="formEdit" method="post">
                
            <div class="box-body">
	
        <!--SE NECESSÁRIO, EXPLICAÇÃO-->
        <!--<p></p>-->
        <!--FORMULARIO COM INFORMACOES-->
                <input type="hidden" id="EST_ID" readonly name="EST_ID" value="<?php echo $estados["EST_ID"] ?>">
    
        <div class="form-group">
            <label for="EST_NOME" class="col-sm-2 control-label">Nome *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Nome" value="<?php if($estados) echo $estados["EST_NOME"] ?>" id="EST_NOME" name="EST_NOME" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EST_SIGLA" class="col-sm-2 control-label">Sigla *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Sigla" value="<?php if($estados) echo $estados["EST_SIGLA"] ?>" id="EST_SIGLA" name="EST_SIGLA" maxlength="2" style="text-transform: uppercase;">
            </div>
        </div>
                            
        <div class="form-group">
            <label for="PAI_ID" class="col-sm-2 control-label">País *</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="PAI_ID" name="PAI_ID" validar="int" >
                    <?php foreach($pais as $pai){ ?>
                    <option value="<?php echo $pai->PAI_ID ?>" <?php if($pai->PAI_ID == (int)$estados["PAI_ID"]) echo "selected"; ?>>
                        <?php echo $pai->PAI_NOME ?></option>
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
</section>