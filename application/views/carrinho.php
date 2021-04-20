<div class="container">
    <h1 class="jumbotron-heading">E-COMMERCE CART</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php echo $mensagem; ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <?php if (count($carrinho) > 0){ ?>
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Produto</th>
                            <th scope="col" class="text-center">Quantidade</th>
                            <th scope="col" class="text-right">Preço Un.</th>
                            <th scope="col" class="text-right">Total</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $noImgProduto = glob('images/no-image.png');
                        $total = 0;
                        $p = 0;
                        foreach ($carrinho as $car){ ?>
                        <tr>
                            <?php $img = glob('admin/upload/produtos/'.$car->produtos->PRO_ID.'.*');?>
                            <td>
                                <?php if ($img){ ?> 
                                    <img class="img-cart" src="<?php echo url::base().$img[0]; ?>"/> 
                                <?php } else { ?>
                                    <img class="img-cart" src="<?php echo url::base().$noImgProduto[0]; ?>"/> 
                                <?php } ?>
                            </td>
                            <td><?php echo $car->produtos->PRO_NOME; ?></td>
                            <td><input class="form-control" type="number" value="<?php echo $car->CAR_QUANTIDADE; ?>"  onchange="positivo(<?php echo $p; ?>,'<?php echo $car->PRO_ID; ?>');" name="quantidade_<?php echo $p ?>" id="quantidade_<?php echo $p ?>" /></td>
                            <td class="text-right">R$ <?php echo number_format($car->CAR_VALOR_ITEM,2,',','.'); ?></td>
                            <td class="text-right">R$ <?php echo number_format($car->CAR_VALOR_ITEM*$car->CAR_QUANTIDADE,2,',','.'); ?></td>
                            <td class="text-right"><button class="btn btn-sm btn-danger" onclick="location.href = '<?php echo url::base(); ?>carrinho/remover/<?php echo $car->PRO_ID; ?>';"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                        <?php 
                            $total += $car->CAR_VALOR_ITEM*$car->CAR_QUANTIDADE;
                            $p++;
                        } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">Total de Produtos</td>
                            <td class="text-right"><b>R$ <?php echo number_format($total,2,',','.'); ?></b></td>
                            <td class="text-right"></td>
                        </tr>
                    </tbody>
                    <?php } else { ?>
                        <thead>
                        <tr>
                            <th scope="col">nenhum item no carrinho</th>
                        </tr>
                    </thead>
                    <?php } ?>
                    
                </table>
            </div>
        </div>
    </div>
</div>
