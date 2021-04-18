$(document).ready(function() {
    //MENU CADASTROS SISTEMA
    $(".cadastrosistema").toggle(200);
    $(".fone").mask("(99)9999-9999?9");
    $(".uf").mask("aa");
    $(".cep").mask("99999-999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    //$(".ie").mask("999.999.999.999");
    //$(".rg").mask("9999999999");
    $(".data").mask("99/99/9999");
    $(".hora").mask("99:99");
    $(".datahora").mask("99/99/9999 99:99:99");
    $(".valor").maskMoney({
        decimal: ",",
        thousands: "."
    });
    $(".valorpeso").maskMoney({
        precision: 3,
        decimal: ",",
        thousands: "."
    });

    //Initialize Select2 Elements
    $(".select2").select2();

    //DATEPICKER
    $(".data").datepicker({
        format: 'dd/mm/yyyy',                
        language: 'pt-BR'
    });
    
    $('#lista-icones :checked').parent().addClass('checked');

    $('#lista-icones').delegate('span', 'click', function(){
      $('#lista-icones .checked').removeClass('checked');
      $(this).prev().click().parent().addClass('checked');
      $('#MOD_ICONE').val($(this).html());
    });

    /*LIMPAR CAMPOS EDIT*/
    $("#limpa").click(function(event) {
        event.preventDefault();
        document.formEdit.reset();
    });

    /*SALVAR CAMPOS*/
    $("#salvar").click(function(event) {
        event.preventDefault();
        $("#formEdit").submit();
    });

    $("#salvarGaleria").click(function(event) {
        event.preventDefault();
        $("#formFotos").submit();
    });

    $("#formEdit").validar({
        "marcar": false
    });

    $("#formLogin").validar({
        "after": function() {
            $('#msg-login').hide();
            $('#msg-login').html('');
            $('.form-group').removeClass('has-success');
            $('.form-group').removeClass('has-error');
            $('.form-group').removeClass('has-warning');
            $('#loading-login').show(500);
            $.post(URLBASE + 'login/login', this.serialize(), function(data) {
                if (data.ok) {

                    //classes de cor nos campos
                    $('.form-group').addClass(data.classe);

                    //mensagem referente ao login
                    $('#msg-login').show(500);
                    setTimeout(function(){
                        $('#msg-login').html(data.msg);
                    },500);

                    //direciona para o sistema
                    setTimeout(function(){
                        location.href = URLBASE + 'index';
                    },1500);

                } else {

                    //classes de cor nos campos
                    $('.form-group').addClass(data.classe);

                    //mensagem referente ao login
                    $('#msg-login').show(500);
                    setTimeout(function(){
                        $('#msg-login').html(data.msg);
                    },500);
                    $('#senha').val('');

                }
                $('#loading-login').hide(500);
            }, 'json');
            return false;
        },
        "marcar": false
    });

    /*LIMPAR CAMPOS LOGIN*/
    $("#limpaLog").click(function(event) {
        event.preventDefault();
        document.formLogin.reset();
    });

    /*ENTRAR LOGIN*/
    $("#entrar").click(function(event) {
        event.preventDefault();
        $("#formLogin").submit();
    });
    
});

//FUNÇÃO QUE SELECIONA OU DESMARCA TODOS ITENS DO LST
function selecionar(value) {
    if (value) {
        $(".seleciona").attr("checked", true);
    } else {
        $(".seleciona").attr("checked", false);
    }
}

//FUNCAO PARA EXCLUIR TODOS MARCADOS
function excluirTodos(modulo) {
    var form = '<form id="excluiMarcados" name="excluiMarcados" method="post" action="' + URLBASE + modulo + '/excluirTodos">';
    $(".seleciona").each(function() {
        if ($(this).attr("valor") > 0 && $(this).attr("checked")) {
            form += '<input type="hidden" name="item[]" value="' + $(this).attr("valor") + '">';
        }
    })
    form += '</form>';

    $("#formExc").html(form);

    $("#excluiMarcados").submit();
}


//TRAZ OS MENUS QUANDO DIGITA NA BUSCA
function buscamenu(digitado) {
    $.post(URLBASE + "ajax/buscamenu/", {digitado: digitado}, function(data) {
        if (data.ok) {
            $(".sidebar-menu").html(data.menu);
        }
    }, 'json');
}

//TRAZ AS CIDADES QUANDO TROCA O ESTADO
function trocaEstado(uf, cidade) {
    $.get(URLBASE + "ajax/trocaestado/" + uf + "/" + cidade, true, function(data) {
        if (data.ok) {
            $("#cidades").html(data.ok);
            //Initialize Select2 Elements
            $(".select2").select2();
        } else {
            alert("Houve um Problema!!");
        }
    }, 'json');
}
/*FIM FUNCOES DE CLIENTE*/

//VERIFICA O 9 DIGITO DO TELEFONE
function verificaTelefone(puti){
    valor = $(puti).val();
    valor = valor.replace('_', '');
    //console.log(valor);
    if(valor.length > 13){
        //console.log(14);
        $(puti).mask('(99)99999-9999');
    }else{
        //console.log(13);
        $(puti).mask('(99)9999-9999?9');
    }
}

function ordenar(valor, sentido){
    $("#ordem").val(valor);
    $("#sentido").val(sentido);
    $('#formBusca').submit();
}

//NUMBER FORMAT PARA JS
function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, prec = decimals;
    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep == "undefined") ? ',' : thousands_sep;
    var dec = (typeof dec_point == "undefined") ? '.' : dec_point;

    var s = (prec > 0) ? n.toFixed(prec) : Math.round(n).toFixed(prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

    var abs = Math.abs(n).toFixed(prec);
    var _, i;

    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;

        _[0] = s.slice(0,i + (n < 0)) +
              _[0].slice(i).replace(/(\d{3})/g, sep+'$1');

        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }

    return s;
}

function abrefechamenu(classe){
    $("."+classe).toggle(200);
    $(".fa-plus-circle").toggle(200);
    $(".fa-minus-circle").toggle(200);
}
