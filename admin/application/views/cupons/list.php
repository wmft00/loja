<section id="lista">
    <h1>Cupons</h1>
    
    <!--MENSAGEM DE INCLUSAO, ALTERACAO OU EXCLUSAO-->
    <?php if($mensagem != ""){ ?>
        <?php echo $mensagem ?>
    <?php } ?>
    
    <!--INCLUIR E PESQUISA-->
    <div class="operacoes"><a href="<?php echo url::base() ?>cupons/edit" class="btn btn-default">Inserir</a><form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>cupons/pesquisa" class="pesquisa">
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
                              <span><a href="#" onclick="ordenar('CUP_ID', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CUP_ID', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Código
                              <span><a href="#" onclick="ordenar('CUP_CODIGO', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CUP_CODIGO', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Tipo
                              <span><a href="#" onclick="ordenar('CUP_TIPO', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CUP_TIPO', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Marca
                              <span><a href="#" onclick="ordenar('MAR_NOME', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('MAR_NOME', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th>Categoria
                              <span><a href="#" onclick="ordenar('CAT_NOME', 'asc')" class="seta-acima"></a>
                                  <a href="#" onclick="ordenar('CAT_NOME', 'desc')" class="seta-abaixo"></a></span>
                          </th>
                          <th style="width: 100px"></th>
                      </tr>

                      <?php
                      //SE TEM CADASTRADO, MOSTRA. SENÃO, MOSTRA O AVISO
                      if (count($cupons) > 0) {
                          foreach($cupons as $cup){
                              ?>
                              <tr><td><?php echo $cup->CUP_ID; ?></td>
                                  <td><?php echo $cup->CUP_CODIGO; ?></td>
                                  <td><?php echo $cup->CUP_TIPO == 'P' ? "Porcentagem" : "Valor Fixo"; ?></td>
                                  <td><?php echo $cup->marca->MAR_NOME == '' ? "Sem marca definida" : $cup->marca->MAR_NOME; ?></td>
                                  <td><?php echo $cup->categoria->CAT_NOME == '' ? "Sem marca categoria" : $cup->categoria->CAT_NOME; ?></td>
                                  <td>
                                      <a href="<?php echo url::base() ?>cupons/edit/<?php echo $cup->CUP_ID; ?>" 
                                          class="btn-app-list fa fa-edit"></a>
                                          <a onclick="if (window.confirm('Deseja realmente excluir o registro?')) {
                                              location.href = '<?php echo url::base() ?>cupons/excluir/<?php echo 
                                                  $cup->CUP_ID; ?>';
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
                              <td colspan="6" class="naoEncontrado">Nenhum Cupons encontrado</td>
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
