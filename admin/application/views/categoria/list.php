<section id="lista">
    <h1>Categoria</h1>
    
    <!--MENSAGEM DE INCLUSAO, ALTERACAO OU EXCLUSAO-->
    <?php if($mensagem != ""){ ?>
        <?php echo $mensagem ?>
    <?php } ?>
    
    <!--INCLUIR E PESQUISA-->
    <div class="operacoes"><a href="<?php echo url::base() ?>categoria/edit" class="btn btn-default">Inserir</a><form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>categoria/pesquisa" class="pesquisa">
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
                              <span><a href="#" onclick="ordenar('CAT_ID', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CAT_ID', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>#
                              <span><a href="#" onclick="ordenar('CAT_NOME', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CAT_NOME', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th style="width: 100px"></th>
                      </tr>

                      <?php
                      //SE TEM CADASTRADO, MOSTRA. SENÃO, MOSTRA O AVISO
                      if (count($categoria) > 0) {
                          foreach($categoria as $cat){
                              ?>
                              <tr><td><?php echo $cat->CAT_ID; ?></td>
                                <td><?php echo $cat->CAT_NOME; ?></td>
                                  <td>
                                      <a href="<?php echo url::base() ?>categoria/edit/<?php echo $cat->CAT_ID; ?>" 
                                          class="btn-app-list fa fa-edit"></a>
                                          <a onclick="if (window.confirm('Deseja realmente excluir o registro?')) {
                                              location.href = '<?php echo url::base() ?>categoria/excluir/<?php echo 
                                                  $cat->CAT_ID; ?>';
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
                              <td colspan="2" class="naoEncontrado">Nenhuma Categoria encontrada</td>
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
