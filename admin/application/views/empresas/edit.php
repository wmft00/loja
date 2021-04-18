<section id="formulario">
    <div class="infos">
        <h1>Empresas</h1>
    </div>
    
    <div class="col-md-12">
        <div class="box box-info">
            <form action="<?php echo url::base() ?>empresas/save" class="form-horizontal" id="formEdit" name="formEdit" method="post" enctype="multipart/form-data" >
                
            <div class="box-body">
	
        <!--SE NECESSÁRIO, EXPLICAÇÃO-->
        <!--<p></p>-->
        <!--FORMULARIO COM INFORMACOES-->
                <input type="hidden" id="EMP_ID" readonly name="EMP_ID" value="<?php echo $empresas["EMP_ID"] ?>">
    
        <div class="form-group">
            <label for="EMP_RAZAO_SOCIAL" class="col-sm-2 control-label">Razão Social *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Razão Social" value="<?php if($empresas) echo $empresas["EMP_RAZAO_SOCIAL"] ?>" id="EMP_RAZAO_SOCIAL" name="EMP_RAZAO_SOCIAL" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_NOME_FANTASIA" class="col-sm-2 control-label">Nome Fantasia *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Nome Fantasia" value="<?php if($empresas) echo $empresas["EMP_NOME_FANTASIA"] ?>" id="EMP_NOME_FANTASIA" name="EMP_NOME_FANTASIA" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_CNPJ" class="col-sm-2 control-label">CNPJ *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  cnpj" placeholder="CNPJ" value="<?php if($empresas) echo $empresas["EMP_CNPJ"] ?>" id="EMP_CNPJ" name="EMP_CNPJ" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_INSCRICAO_ESTADUAL" class="col-sm-2 control-label">Inscrição Estadual</label>
            <div class="col-sm-10">
                
                <input type="text"   class="form-control  " placeholder="Inscrição Estadual" value="<?php if($empresas) echo $empresas["EMP_INSCRICAO_ESTADUAL"] ?>" id="EMP_INSCRICAO_ESTADUAL" name="EMP_INSCRICAO_ESTADUAL" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_INSCRICAO_MUNICIPAL" class="col-sm-2 control-label">Inscrição Municipal</label>
            <div class="col-sm-10">
                
                <input type="text"   class="form-control  " placeholder="Inscrição Munisipal" value="<?php if($empresas) echo $empresas["EMP_INSCRICAO_MUNICIPAL"] ?>" id="EMP_INSCRICAO_MUNICIPAL" name="EMP_INSCRICAO_MUNICIPAL" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_CNAE" class="col-sm-2 control-label">CNAE</label>
            <div class="col-sm-10">
                
                <input type="text"   class="form-control  " placeholder="CNAE" value="<?php if($empresas) echo $empresas["EMP_CNAE"] ?>" id="EMP_CNAE" name="EMP_CNAE" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_ESPECIALIZACAO" class="col-sm-2 control-label">Especialização</label>
            <div class="col-sm-10">
                
                <input type="text"   class="form-control  " placeholder="Especialização" value="<?php if($empresas) echo $empresas["EMP_ESPECIALIZACAO"] ?>" id="EMP_ESPECIALIZACAO" name="EMP_ESPECIALIZACAO" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_CEP" class="col-sm-2 control-label">CEP *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="cep form-control  " placeholder="CEP" value="<?php if($empresas) echo $empresas["EMP_CEP"] ?>" id="EMP_CEP" name="EMP_CEP" 
                       onchange="carregaDados(this, 'EMP')">
                <span id="cepLoading" class="loading" style="display: none;">
                    <img alt="Carregando" src="<?php echo url::base() ?>images/loading.gif">Verificando...
                </span>
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_ENDERECO" class="col-sm-2 control-label">Endereço *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Endereço" value="<?php if($empresas) echo $empresas["EMP_ENDERECO"] ?>" id="EMP_ENDERECO" name="EMP_ENDERECO" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_NUMERO" class="col-sm-2 control-label">Número *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Número" value="<?php if($empresas) echo $empresas["EMP_NUMERO"] ?>" id="EMP_NUMERO" name="EMP_NUMERO" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_COMPLEMENTO" class="col-sm-2 control-label">Complemento *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Complemento" value="<?php if($empresas) echo $empresas["EMP_COMPLEMENTO"] ?>" id="EMP_COMPLEMENTO" name="EMP_COMPLEMENTO" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_BAIRRO" class="col-sm-2 control-label">Bairro *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Bairro" value="<?php if($empresas) echo $empresas["EMP_BAIRRO"] ?>" id="EMP_BAIRRO" name="EMP_BAIRRO" >
            </div>
        </div>
                
        <div class="form-group">
            <label for="EST_ID" class="col-sm-2 control-label">Estado *</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="EST_ID" name="EST_ID" validar="texto" onchange="trocaEstado(this.value, 0)">
                    <option value="">Selecione...</option>
                    <?php foreach ($estados as $est) { ?>
                        <option value="<?php echo $est->EST_ID ?>" <?php if ($est->EST_ID == $empresas["EST_ID"]) echo "selected"; ?> >
                            <?php echo $est->EST_NOME." - ".$est->EST_SIGLA ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!--COLOCA AS CIDADES AQUI-->
        <div id="cidades"></div>
                            
        <div class="form-group">
            <label for="EMP_EMAIL" class="col-sm-2 control-label">E-mail *</label>
            <div class="input-group">
                <div class="input-group-addon">@</div>
                <input type="text" validar="email"  class="form-control  " placeholder="Email" value="<?php if($empresas) echo $empresas["EMP_EMAIL"] ?>" id="EMP_EMAIL" name="EMP_EMAIL" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="EMP_TELEFONE" class="col-sm-2 control-label">Telefone *</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                <input type="text" validar="texto"  class="form-control  fone" placeholder="Telefone" value="<?php if($empresas) echo $empresas["EMP_TELEFONE"] ?>" id="EMP_TELEFONE" name="EMP_TELEFONE" onblur="verificaTelefone(this)">
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="logo" class="col-sm-2 control-label">Logo</label>
            <div class="col-sm-10">
                <input type="file" id="logo" name="logo" onchange="return ShowImagePreview(this, 0, 'logo');">
            </div>
        </div>
        
        <!--SE FOR PARA MOSTRAR PREVIEW, RETIRAR O DISPLAY NONE-->
        <div class="form-group" id="divlogoCanvas" >
            <!--<label class="col-sm-2 control-label">Preview</label>-->
            <!--PREVIEW DA IMAGEM-->
            <canvas id="logoCanvas" class="previewcanvas" width="0" height="0"> ></canvas>
            <!--CAMPO HIDDEN PARA COLOCAR A IMAGEM JÁ REDIMENSIONADA-->
            <input type="hidden" id="logoBlob" name="logoBlob" />
            <input type="text" name="logox1" id="logox1" style="display: none;">
            <input type="text" name="logoy1" id="logoy1" style="display: none;">
            <input type="text" name="logow" id="logow" style="width: 50px; display: none;">
            <input type="text" name="logoh" id="logoh" style="width: 50px; display: none;">
        </div><?php if($logo) echo $logo; ?>
                                    
                </div>

                <div class="box-footer">
                    <p class="legenda"><em>*</em> Campos obrigatórios.</p>
                    <button type="submit" class="btn pull-right btn-success" id="salvar">Salvar</button>
                    <button type="reset" class="btn btn-danger" onClick="history.go(-1)" id="limpa" >Cancelar</button>
                </div></form>
        </div>
    </div>
</section>
                    
<!--REDIMENSIONAMENTO DA IMAGEM-->
<script src="<?php echo url::base() ?>js/jcrop/js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="<?php echo url::base() ?>js/jcrop/css/jquery.Jcrop.css" type="text/css" />
<script>
    var imageLoader = document.getElementById("imageLoader");
    function HandleFileEvent(event, selection, id)
    {
        var img = new Image;
        img.onload = function(event) {
            UpdatePreviewCanvas(event, img, selection, id);
        };
        img.src = event.target.result;
    }

    function ShowImagePreview(object, selection, id)
    {
        //DESTROI JCROP
        if ($("#"+id+"Blob").val() !== "") {
            $("#"+id+"Canvas").data("Jcrop").destroy();
            $("#div"+id+"Canvas").append("<canvas id='"+id+"Canvas' class='previewcanvas' ></canvas>");
        }
                    
        if (typeof object.files === "undefined")
            return;

        var files = object.files;

        if (!(window.File && window.FileReader && window.FileList && window.Blob))
        {
            alert("The File APIs are not fully supported in this browser.");
            return false;
        }

        if (typeof FileReader === "undefined")
        {
            alert("Filereader undefined!");
            return false;
        }

        var file = files[0];

        if (file !== undefined && file != null && !(/image/i).test(file.type))
        {
            alert("File is not an image.");
            return false;
        }

        reader = new FileReader();
        reader.onload = function(event) {
            HandleFileEvent(event, selection, id)
        }
        reader.readAsDataURL(file);
    }

    //FUNÇÃO QUE FAZ ALGUMA COISA QUE EU DESCONHEÇO, MAS POSSIVELMENTE UTIL
    function dataURItoBlob(dataURI) {
        // convert base64 to raw binary data held in a string
        // doesnt handle URLEncoded DataURIs
        var byteString;
        if (dataURI.split(",")[0].indexOf("base64") >= 0)
            byteString = atob(dataURI.split(",")[1]);
        else
            byteString = unescape(dataURI.split(",")[1]);
        // separate out the mime component
        var mimeString = dataURI.split(",")[0].split(":")[1].split(";")[0];

        // write the bytes of the string to an ArrayBuffer
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        // write the ArrayBuffer to a blob, and youre done
        return new Blob([ab], {type: mimeString});
    }

    function UpdatePreviewCanvas(event, img, selection, id)
    {
        var canvas = document.getElementById(id+"Canvas");
        var context = canvas.getContext("2d");
        var world = new Object();
//        world.width = canvas.offsetWidth;
//        world.height = canvas.offsetHeight;
        world.width = 1000;
        world.height = 1000;

        var WidthDif = img.width - world.width;
        var HeightDif = img.height - world.height;

        var Scale = 0.0;
        if (WidthDif > HeightDif)
        {
            Scale = world.width / img.width;
        }
        else
        {
            Scale = world.height / img.height;
        }
        if (Scale > 1)
            Scale = 1;

        var UseWidth = Math.floor(img.width * Scale);
        var UseHeight = Math.floor(img.height * Scale);
        
        canvas.width = UseWidth;
        canvas.height = UseHeight;

        var x = Math.floor((world.width - UseWidth) / 2);
        var y = Math.floor((world.height - UseHeight) / 2);

        context.drawImage(img, 0, 0, img.width, img.height, 0, 0, UseWidth, UseHeight);

        //COLOCAR DE VOLTA NO INPUT
        if($("#"+id).val().search(".jpg") > 0 || $("#"+id).val().search(".jpeg") > 0 ||
            $("#"+id).val().search(".JPG") > 0 || $("#"+id).val().search(".JPEG") > 0){
            //SEGUNDO PARAMETRO: QUALIDADE. PADRÃO DOS NAVEGADORES É 0.92
            var dataURL = canvas.toDataURL("image/jpeg", 0.92);
        }else if($("#"+id).val().search(".png") > 0 || $("#"+id).val().search(".PNG") > 0){
            var dataURL = canvas.toDataURL("image/png", 0.5);
        }else{
            alert("Formato não suportado!");
            $("#"+id).val("");
            return false;
        }

        var blob = dataURItoBlob(dataURL);

        $("#"+id+"Blob").val(dataURL);
        
        //BGCOLOR: BLACK - DEIXA FUNDO PRETO QUANDO EDITA
        //BGCOLOR: TRANSPARENT: PERMITE SALVAR PNG COM FUNDO TRANSPARENT
        
        if(id === "logo"){
            var funcao = showCoordslogo;
        }
        
        $(canvas).Jcrop({
            bgColor: "transparent",
            bgOpacity: 0.7,
            onSelect: funcao
        });
    }
    function showCoordslogo(c) {
        // variables can be accessed here as
        // c.x, c.y, c.x2, c.y2, c.w, c.h
        $("#logox1").val(c.x);
        $("#logoy1").val(c.y);
        $("#logow").val(c.w);
        $("#logoh").val(c.h);
    }
</script>

<?php
//SE FOR UPDATE, BUSCA O ESTADO E A CIDADE CADASTRADOS
if ($empresas["EMP_ID"] > 0 and $empresas["EMP_ID"] > 0) {
    ?>
    <script type="text/javascript">
        trocaEstado(<?php echo $empresas["EST_ID"]; ?>, <?php echo $empresas["CID_ID"]; ?>);
    </script>
    <?php
}
?>