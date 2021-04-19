<section id="lista">
    <h1>Produtos</h1>
    
    <!--MENSAGEM DE INCLUSAO, ALTERACAO OU EXCLUSAO-->
    <?php if($mensagem != ""){ ?>
        <?php echo $mensagem ?>
    <?php } ?>
    
    <!--INCLUIR E PESQUISA-->
    <div class="operacoes"><a href="<?php echo url::base() ?>produtos/edit" class="btn btn-default">Inserir</a><form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>produtos/pesquisa" class="pesquisa">
            <label for="chave">Pesquise um registro:</label>
            <input type="search" id="chave" name="chave" placeholder="Busca" />
            
            <!--ORDENACAO-->
            <input type="hidden" id="ordem" name="ordem" value="<?php echo $ordem; ?>">
            <input type="hidden" id="sentido" name="sentido" value="<?php echo $sentido; ?>">

            <button class="btn btn-default" type="submit">Buscar</button>
        </form>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">

                      <tr>
                            <th style="width: 70px">#
                              <span><a href="#" onclick="ordenar('PRO_ID', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('PRO_ID', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Nome
                              <span><a href="#" onclick="ordenar('PRO_NOME', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('PRO_NOME', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Marca
                              <span><a href="#" onclick="ordenar('CAT_0', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CAT_0', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Categoria
                              <span><a href="#" onclick="ordenar('CAT_0', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CAT_0', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Preço
                              <span><a href="#" onclick="ordenar('PRO_PRECO', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('PRO_PRECO', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th style="width: 100px"></th>
                      </tr>

                      <?php
                      //SE TEM CADASTRADO, MOSTRA. SENÃO, MOSTRA O AVISO
                      if (count($produtos) > 0) {
                          foreach($produtos as $pro){
                              ?>
                              <tr><td><?php echo $pro->PRO_ID; ?></td>
                                  <td><?php echo $pro->PRO_NOME; ?></td>
                                  <td><?php echo $pro->marca->MAR_NOME; ?></td>
                                  <td><?php echo $pro->categoria->CAT_NOME; ?></td>
                                  <td><?php echo number_format($pro->PRO_PRECO,2,',','.'); ?></td>
                                  <td>
                                      <a href="<?php echo url::base() ?>produtos/edit/<?php echo $pro->PRO_ID; ?>" 
                                          class="btn-app-list fa fa-edit"></a>
                                          <a onclick="if (window.confirm('Deseja realmente excluir o registro?')) {
                                              location.href = '<?php echo url::base() ?>produtos/excluir/<?php echo 
                                                  $pro->PRO_ID; ?>';
                                          }    
                                         " class="btn-app-list fa fa-trash"></a>
                                  </td>
                              </tr>
                              <?php
                          }
                      }
                      else {
                          ?>
                          <tr>
                              <td colspan="6" class="naoEncontrado">Nenhum Produtos encontrado</td>
                          </tr>
                          <?php
                      }
                      ?>

                  </table>
              </div>
    
                <!--EXCLUI TODOS MARCADOS--><!--PAGINACAO-->
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>
</section>

<!--ONDE MONTA O FORMULARIO PARA EXCLUIR OS MARCADOS-->
<div id="formExc"></div>
