<section id="lista">
    <h1>Marca</h1>
    
    <!--MENSAGEM DE INCLUSAO, ALTERACAO OU EXCLUSAO-->
    <?php if($mensagem != ""){ ?>
        <?php echo $mensagem ?>
    <?php } ?>
    
    <!--INCLUIR E PESQUISA-->
    <div class="operacoes"><a href="<?php echo url::base() ?>marca/edit" class="btn btn-default">Inserir</a><form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>marca/pesquisa" class="pesquisa">
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
                                <span><a href="#" onclick="ordenar('MAR_ID', 'asc')" class="seta-acima"></a>
                                <a href="#" onclick="ordenar('MAR_ID', 'desc')" class="seta-abaixo"></a></span>
                            </th>
                            <th>Nome
                                <span><a href="#" onclick="ordenar('MAR_NOME', 'asc')" class="seta-acima"></a>
                                <a href="#" onclick="ordenar('MAR_NOME', 'desc')" class="seta-abaixo"></a></span>
                            </th>
                          <th style="width: 100px"></th>
                      </tr>

                      <?php
                      //SE TEM CADASTRADO, MOSTRA. SENÃO, MOSTRA O AVISO
                      if (count($marca) > 0) {
                          foreach($marca as $mar){
                              ?>
                              <tr><td><?php echo $mar->MAR_ID; ?></td>
                                    <td><?php echo $mar->MAR_NOME; ?></td>
                                  <td>
                                      <a href="<?php echo url::base() ?>marca/edit/<?php echo $mar->MAR_ID; ?>" 
                                          class="btn-app-list fa fa-edit"></a>
                                          <a onclick="if (window.confirm('Deseja realmente excluir o registro?')) {
                                              location.href = '<?php echo url::base() ?>marca/excluir/<?php echo 
                                                  $mar->MAR_ID; ?>';
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
                              <td colspan="2" class="naoEncontrado">Nenhuma Marca encontrada</td>
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
