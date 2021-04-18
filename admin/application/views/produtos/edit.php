<div class="row"><section id="formulario">
    <div class="infos">
        <h1>Produtos</h1>
    </div>
    
    <div class="col-md-12">
        <div class="box box-info">
            <form action="<?php echo url::base() ?>produtos/save" class="form-horizontal" id="formEdit" name="formEdit" method="post" enctype="multipart/form-data" >
                
            <div class="box-body">
	
        <!--SE NECESSÁRIO, EXPLICAÇÃO-->
        <!--<p></p>-->
        <!--FORMULARIO COM INFORMACOES-->
                <input type="hidden" id="PRO_ID" readonly name="PRO_ID" value="<?php echo $produtos["PRO_ID"] ?>">
    
        <div class="form-group">
            <label for="PRO_NOME" class="col-sm-2 control-label">Nome *</label>
            <div class="col-sm-10">
                
                <input type="text" validar="texto"  class="form-control  " placeholder="Nome" value="<?php if($produtos) echo $produtos["PRO_NOME"] ?>" id="PRO_NOME" name="PRO_NOME" >
            </div>
        </div>
                            
        <div class="form-group">
            <label for="MAR_ID" class="col-sm-2 control-label">Marca *</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="MAR_ID" name="MAR_ID" validar="int" >
                    <?php foreach($marca as $mar){ ?>
                    <option value="<?php echo $mar->MAR_ID ?>" <?php if($mar->MAR_ID == (int)$produtos["MAR_ID"]) echo "selected"; ?>>
                        <?php echo $mar->MAR_NOME ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="CAT_ID" class="col-sm-2 control-label">Categoria *</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="CAT_ID" name="CAT_ID" validar="int" >
                    <?php foreach($categoria as $cat){ ?>
                    <option value="<?php echo $cat->CAT_ID ?>" <?php if($cat->CAT_ID == (int)$produtos["CAT_ID"]) echo "selected"; ?>>
                        <?php echo $cat->CAT_ID ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="PRO_PRECO" class="col-sm-2 control-label">Preço *</label>
            <div class="col-sm-10">
                <input type="text" validar="texto"  class="form-control valor pequeno" placeholder="Preço" value="<?php if($produtos) echo number_format($produtos["PRO_PRECO"], 2, ",", ".") ?>" id="PRO_PRECO" name="PRO_PRECO">
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="PRO_DESCRICAO" class="col-sm-2 control-label">Descrição *</label>
            <div class="col-sm-10">
                <textarea  class="form-control ckeditor" placeholder="Descrição" id="PRO_DESCRICAO" name="PRO_DESCRICAO">
                    <?php if($produtos) echo $produtos["PRO_DESCRICAO"] ?>
                </textarea>
            </div>
        </div>
                                        
        <div class="form-group multiplo" label="Ativo">
            <label for="PRO_ATIVO" class="col-sm-2 control-label">Ativo *</label>
            <div class="col-sm-10">
            <input type="radio" name="PRO_ATIVO" <?php if ($produtos["PRO_ATIVO"] == "S") echo "checked"; ?> id="ATIVOSim" value="S" validar="radio"> Sim &nbsp;&nbsp;&nbsp;
            <!--<label for="ATIVOSim" class="col-sm-2 control-label">Sim</label>-->
            <input type="radio" name="PRO_ATIVO" <?php if ($produtos["PRO_ATIVO"] == "N") echo "checked"; ?> id="ATIVONão" value="N" validar="radio"> Não &nbsp;&nbsp;&nbsp;
            <!--<label for="ATIVONão" class="col-sm-2 control-label">Não</label>-->
            </div>
        </div>
                                        
        <div class="form-group">
            <label for="imagem" class="col-sm-2 control-label">Imagem</label>
            <div class="col-sm-10">
                <input type="file" id="imagem" name="imagem" onchange="return ShowImagePreview(this, 0, 'imagem');">
            </div>
        </div>
        
        <!--SE FOR PARA MOSTRAR PREVIEW, RETIRAR O DISPLAY NONE-->
        <div class="form-group" id="divimagemCanvas" >
            <!--<label class="col-sm-2 control-label">Preview</label>-->
            <!--PREVIEW DA IMAGEM-->
            <canvas id="imagemCanvas" class="previewcanvas" width="0" height="0"> ></canvas>
            <!--CAMPO HIDDEN PARA COLOCAR A IMAGEM JÁ REDIMENSIONADA-->
            <input type="hidden" id="imagemBlob" name="imagemBlob" />
            <input type="text" name="imagemx1" id="imagemx1" style="display: none;">
            <input type="text" name="imagemy1" id="imagemy1" style="display: none;">
            <input type="text" name="imagemw" id="imagemw" style="width: 50px; display: none;">
            <input type="text" name="imagemh" id="imagemh" style="width: 50px; display: none;">
        </div><?php if($imagem) echo $imagem; ?>
                                    
                </div>

                <div class="box-footer">
                    <p class="legenda"><em>*</em> Campos obrigatórios.</p>
                    <button type="submit" class="btn pull-right btn-success" id="salvar">Salvar</button>
                    <button type="reset" class="btn btn-danger" onClick="history.go(-1)" id="limpa" >Cancelar</button>
                </div></form>
        </div>
    </div>
</section></div>
                    
<script type="text/javascript" src="<?php echo url::base(); ?>js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo url::base(); ?>js/ckfinder/ckfinder.js"></script>

<script type="text/javascript">// <![CDATA[

// This is a check for the CKEditor class. If not defined, the paths must be checked.

if ( typeof CKEDITOR == "undefined" ){

    document.write(

        "<strong><span style='color: #ff0000'>Error</span>: CKEditor not found</strong>." +

        "This sample assumes that CKEditor (not included with CKFinder) is installed in" +

        "the '/ckeditor/' path. If you have it installed in a different place, just edit" +

        "this file, changing the wrong paths in the &lt;head&gt; (line 5) and the 'BasePath'" +

        "value (line 32)." ) ;

}else{

    var editorPRO_DESCRICAO = CKEDITOR.replace( "PRO_DESCRICAO" );
    CKFinder.setupCKEditor( editorPRO_DESCRICAO, "<?php echo url::base()?>js/ckfinder/" ) ;
}
// ]]>
</script>
                    
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
        
        if(id === "imagem"){
            var funcao = showCoordsimagem;
        }
        
        $(canvas).Jcrop({
            bgColor: "transparent",
            bgOpacity: 0.7,
            onSelect: funcao
        });
    }
    function showCoordsimagem(c) {
        // variables can be accessed here as
        // c.x, c.y, c.x2, c.y2, c.w, c.h
        $("#imagemx1").val(c.x);
        $("#imagemy1").val(c.y);
        $("#imagemw").val(c.w);
        $("#imagemh").val(c.h);
    }
</script>