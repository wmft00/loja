<section id="lista">
    <h1>Empresas</h1>
    
    <!--MENSAGEM DE INCLUSAO, ALTERACAO OU EXCLUSAO-->
    <?php if($mensagem != ""){ ?>
        <?php echo $mensagem ?>
    <?php } ?>
    
    <!--INCLUIR E PESQUISA-->
    <div class="operacoes"><a href="<?php echo url::base() ?>empresas/edit" class="btn btn-default">Inserir</a><form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>empresas/pesquisa" class="pesquisa">
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
<!--                            <th style="width: 70px">#
                              <span><a href="#" onclick="ordenar('EMP_ID', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('EMP_ID', 'desc')" class="seta-abaixo"></a></span>
                          </th>-->
                          <th>Razão Social
                              <span><a href="#" onclick="ordenar('EMP_RAZAO_SOCIAL', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('EMP_RAZAO_SOCIAL', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Nome Fantasia
                              <span><a href="#" onclick="ordenar('EMP_NOME_FANTASIA', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('EMP_NOME_FANTASIA', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>CNPJ
                              <span><a href="#" onclick="ordenar('EMP_CNPJ', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('EMP_CNPJ', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Telefone
                              <span><a href="#" onclick="ordenar('EMP_TELEFONE', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('EMP_TELEFONE', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Cidade
                              <span><a href="#" onclick="ordenar('CID_NOME', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CID_NOME', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th style="width: 100px"></th>
                      </tr>

                      <?php
                      //SE TEM CADASTRADO, MOSTRA. SENÃO, MOSTRA O AVISO
                      if (count($empresas) > 0) {
                          foreach($empresas as $emp){
                              ?>
                              <tr>
                                  <!--<td><?php echo $emp->EMP_ID; ?></td>-->
                                  <td><?php echo $emp->EMP_RAZAO_SOCIAL; ?></td>
                                  <td><?php echo $emp->EMP_NOME_FANTASIA; ?></td>
                                  <td><?php echo $emp->EMP_CNPJ; ?></td>
                                  <td><?php echo $emp->EMP_TELEFONE; ?></td>
                                  <td><?php echo $emp->cidades->CID_NOME."/".$emp->cidades->estados->EST_SIGLA; ?></td>
                                  <td>
                                      <a href="<?php echo url::base() ?>empresas/edit/<?php echo $emp->EMP_ID; ?>" 
                                          class="btn-app-list fa fa-edit"></a>
                                          <a onclick="if (window.confirm('Deseja realmente excluir o registro?')) {
                                              location.href = '<?php echo url::base() ?>empresas/excluir/<?php echo 
                                                  $emp->EMP_ID; ?>';
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
                              <td colspan="6" class="naoEncontrado">Nenhuma Empresa encontrada</td>
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
