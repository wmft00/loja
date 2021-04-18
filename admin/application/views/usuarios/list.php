<section id="lista">
    <h1>Usuários</h1>
    
    <!--MENSAGEM DE INCLUSAO, ALTERACAO OU EXCLUSAO-->
    <?php if ($mensagem != "") { ?>
        <?php echo $mensagem ?>
    <?php } ?>

    <!--INCLUIR E PESQUISA-->
    <div class="operacoes">
        <?php if($permissao == 1 or $permissao == 2){ ?>
                <a href="<?php echo url::base() ?>usuarios/edit" class="btn btn-default">Inserir</a>
        <?php } ?>
        
        <form id="formBusca" name="formBusca" method="get" action="<?php echo url::base() ?>usuarios/pesquisa" class="pesquisa">
            <label for="chave">Pesquise um registro:</label>
            <input type="search" id="chave" name="chave" placeholder="Busca" />
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
                    <th style="width: 50px">#</th>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Permissão</th>
                    <th style="width: 100px"></th>
                  </tr>

                <?php 
                //SE TEM CADASTRADO, MOSTRA. SENÃO, MOSTRA O AVISO
                if(count($usuarios) > 0){
                    foreach ($usuarios as $usu) { ?>
                    <tr>
                        <td><?php echo $usu->USU_ID; ?></td>
                        <td><?php echo $usu->USU_NOME; ?></td>
                        <td><?php echo $usu->USU_LOGIN; ?></td>
                        <td><?php echo $usu->permissoes->PER_NOME; ?></td>
                        <td>
                            <a href="<?php echo url::base() ?>usuarios/edit/<?php echo $usu->USU_ID; ?>" class="btn-app-list fa fa-edit"></a>
                            <?php if($permissao == 1){ ?>
                            <a onclick="
                                if (window.confirm('Deseja realmente excluir o registro?')) {
                                    location.href = '<?php echo url::base() ?>usuarios/excluir/<?php echo $usu->USU_ID; ?>';
                                }    
                                    " class="btn-app-list fa fa-trash">
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } 
                }else{
                ?>
                    <tr>
                        <td colspan="5" class="naoEncontrado">Nenhum Usuário encontrado!</td>
                    </tr>
                <?php
                }
                ?>
                
              </table>
            </div>
            
            <!--PAGINACAO-->
            <?php echo $pagination; ?>
            
          </div>
        </div>
    </div>
</section>

<!--ONDE MONTA O FORMULARIO PARA EXCLUIR OS MARCADOS-->
<div id="formExc"></div>