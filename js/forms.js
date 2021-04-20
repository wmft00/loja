$(document).ready(function() {
  $('#form_cupom').submit(function(event){
    event.preventDefault();
    $('.alert-return-ajax').html('');
    $(".load-page").show();
    var form =  new FormData(form_cupom);
    $.ajax({
      url: URLBASE + 'ajax/cupons', 
      type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: form,
        success: function(data) {
          if (data.ok == true){
            $('.load-page').hide();
            $('.alert-return-ajax').html(data.msg);
            return false;
          } else {
            $(".load-page").hide();
            $('.alert-return-ajax').html(data.msg);
            return false;
          }
        },
    });
  });

  $('#form_cupom_produto').submit(function(event){
    event.preventDefault();
    $('.msg-cupom-produto').html('');
    $(".load-page").show();
    var form =  new FormData(form_cupom);
    $.ajax({
      url: URLBASE + 'ajax/cuponsproduto', 
      type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: form,
        success: function(data) {
          if (data.ok == true){
            $(".load-page").hide();
            $('.msg-cupom-produto').html(data.msg);
            setTimeout(function(){
              $('.msg-cupom-produto').html('');
            },4000);
            $(".pro-price").html(data.str);
            return false;
          } else {
            $(".load-page").hide();
            $('.msg-cupom-produto').html(data.msg);
            setTimeout(function(){
              $('.msg-cupom-produto').html('');
            },3000);
            return false;
          }
        },
    });
  });
});
function carAdd(id){
  var qtda = $('.quantity').val();
  $(".load-page").show();
  if(qtda !== '' && qtda > 0){
    $.ajax({
        type:'POST',
        url: URLBASE + 'ajax/carrinho',
        cache: false,
        dataType: 'JSON',
        data: {                        
            qtda: qtda,
            id: id,
        },
        success: function(data) {
          if (data.ok == true){
            $('#qtda-itens').html(data.qtda+' itens');
            $('.load-page').hide();
            $('.alert-add-carrinho').html(data.msg);
            setTimeout(function(){
              $('.alert-success').remove();
            },3000);
          } else {
            $('.load-page').hide();
            $('.alert-add-carrinho').html('<div class="alert alert-warning fade in alert-dismissible mostra-msg">'+
                '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
                'Verifique a quantidade!<br>');
              setTimeout(function(){
                $('.alert-warning').remove();
              },3000);
            return false;
          }
        },
    });
  } else {
    $('.load-page').hide();
    $('.alert-add-carrinho').html('<div class="alert alert-warning fade in alert-dismissible mostra-msg">'+
        '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
        'Verifique a quantidade!<br>');
      setTimeout(function(){
        $('.alert-warning').remove();
      },3000);
    return false;
  }
}
function positivo(valor,id) {
  var aju = $("#quantidade_" + valor).val();
  if (aju < 1) {
      alert("Digite uma quantidade valida!");
      $("#quantidade_" + valor).val(1);
  } else {
    window.location.href = URLBASE+'carrinho/atualiza/'+id+'/'+aju;
  }
}