<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Nossos Produtos</h1>
</div>

<div class="container">
<div class="bd-example">
    <div class="alert-return-ajax"></div>
    <form id="form_cupom" name="form_cupom">
        <div class="input-group mb-3">
            <input type="text" required class="form-control" name="inpt_cupom" placeholder="Insira seu cupom de desconto" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary" type="button">OK</button>
            </div>
        </div>
    </form>
    <div class="row">
    <?php 
    $noImgProduto = $imgProduto = glob('images/no-image.png');
    foreach ($produtos as $pro){
        $imgProduto = glob('admin/upload/produtos/thumb_'.$pro->PRO_ID.'.*'); ?>
        <div class="col-md-3">
            <div class="card shadow-sm sigle-product" id="product-id-<?php echo $pro->PRO_ID; ?>">
                <a href="<?php echo url::base(); ?>produtos/detalhes/<?php echo $pro->PRO_ID; ?>/<?php echo Controller_Index::arrumaUrl($pro->PRO_NOME); ?>">
                    <figure class="product-img">
                        <?php if ($imgProduto){ ?>
                            <img src="<?php echo url::base().$imgProduto[0]; ?>" litle="<?php echo $pro->PRO_NOME; ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo url::base().$noImgProduto[0]; ?>" litle="<?php echo $pro->PRO_NOME; ?>"/>
                        <?php } ?>
                    </figure>
                </a>

                    <div class="card-body product-content">
                        <a href="<?php echo url::base(); ?>produtos/detalhes/<?php echo $pro->PRO_ID; ?>/<?php echo Controller_Index::arrumaUrl($pro->PRO_NOME); ?>">
                            <p class="preco price-box" categoria="<?php echo $pro->CAT_ID; ?>" marca="<?php echo $pro->MAR_ID; ?>" preco="<?php echo $pro->PRO_PRECO; ?>">R$ <?php echo number_format($pro->PRO_PRECO,2,',','.'); ?></p>
                            <p class="card-text product-name"><?php echo $pro->PRO_NOME; ?></p>
                            <p class="card-text marca-name"><?php echo $pro->marca->MAR_NOME; ?> </p>
                            <p class="card-text marca-name"><?php echo $pro->categoria->CAT_NOME; ?> </p>
                            <div class="d-flex justify-content-between align-items-center cart-list">
                        </a>
                        <div class="btn-group btn-cart-in-product">
                            <button type="button" class="btn btn-sm btn-outline-secondary " onclick="location.href = '<?php echo url::base(); ?>carrinho/inserir/<?php echo $pro->PRO_ID; ?>';" title="Adicionar ao Carrinho"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
<div class="load-page"><img src="<?php echo url::base(); ?>images/loading.svg"></div>