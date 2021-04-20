<div class="container bootdey">
        <section class="panel">
            <div class="panel-body">
                <div class="col-md-6 product-intern">
                    <div class="pro-img-details">
                        <?php $img = glob('admin/upload/produtos/'.$produto->PRO_ID.'.*');
                        if ($img){ ?>
                            <img src="<?php echo url::base().$img[0]; ?>" alt="<?php echo $produto->PRO_NOME; ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 product-intern">
                    <h4 class="pro-d-title">
                        <?php echo $produto->PRO_NOME; ?>
                    </h4>
                    <?php echo $produto->PRO_DESCRICAO; ?>
                    <div class="product_meta">
                        <span class="posted_in"><strong>Categoria:</strong> <?php echo $produto->categoria->CAT_NOME; ?></span>
                        <span class="tagged_as"><strong>Marca:</strong> <?php echo $produto->marca->MAR_NOME; ?></span>
                    </div>
                    <form id="form_cupom_produto" name="form_cupom">
                        <div class="input-group mb-3">
                            <input type="text" required="" class="form-control" name="inpt_cupom" placeholder="Insira seu cupom de desconto" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <input type="hidden" name="produto" value="<?php echo $produto->PRO_ID; ?>"/>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary">OK</button>
                            </div>
                        </div>
                    </form>
                    <small class="msg-cupom-produto"></small>
                    <div class="m-bot15"> <strong>Preço : </strong><span class="pro-price">R$ <?php echo number_format($produto->PRO_PRECO,2,',','.'); ?></span></div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" value="1" class="form-control quantity">
                    </div>
                    <div class="alert-add-carrinho">
                        
                    </div>
                    
                    <p>
                        <button onclick="carAdd('<?php echo $produto->PRO_ID; ?>');" class="btn btn-round btn-danger btn-car-add" type="button"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                    </p>
                </div>
            </div>
        </section>
  </div>
  <div class="load-page"><img src="<?php echo url::base(); ?>images/loading.svg"></div>