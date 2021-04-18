<?php if($permissao == "4"){ //CANDIDATO ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <?php
                $imgCapa = glob("upload/candidatos/foto_capa_".$candidato->CAN_ID.".*");
                if($imgCapa){
                    $imgCapa = $imgCapa[0];
                }else{
                    $imgCapa = "";
                } ?>
                <div class="widget-user-header bg-black" style="background: url('<?php echo $imgCapa; ?>') center center;"></div>
                <div class="widget-user-image">
                    <?php
                    $imgCandidato = glob("upload/candidatos/thumb_".$candidato->CAN_ID.".*");
                    if($imgCandidato){
                        $imgCandidato = $imgCandidato[0];
                    }else{
                        $imgCandidato = "dist/img/pessoa.png";
                    } ?>
                    <img class="img-circle" src="<?php echo url::base().$imgCandidato; ?>" alt="<?php echo $candidato->CAN_NOME; ?>">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-10">
                            <h3 class="widget-user-username"><?php echo $candidato->CAN_NOME." <i>".$candidato->CAN_NUMERO."</i>"; ?></h3>
                            <h5 class="widget-user-desc">
                                <?php 
                                if($candidato->CAN_SEXO == "M"){
                                    echo $candidato->cargos->CAR_NOME_M;
                                }else{
                                    echo $candidato->cargos->CAR_NOME_F;
                                } 
                                echo " - ".$candidato->partidos->PAR_SIGLA; ?>
                            </h5>
                        </div>
                        <div class="col-sm-2">
                            <?php
                            $imgPartido = glob("upload/partidos/thumb_".$candidato->PAR_ID.".*");
                            if($imgPartido){
                                $imgPartido = $imgPartido[0];
                            }else{
                                $imgPartido = "";
                            } ?>
                            <img class="img-circle img-sm" src="<?php echo url::base().$imgPartido; ?>" alt="<?php echo $candidato->partidos->PAR_NOME." - ".$candidato->partidos->PAR_SIGLA; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block" onclick="location.href='<?php echo url::base() ?>index?feed=1'">
                                <h5 class="description-header"><?php if($linhadotempo) echo $linhadotempo; else echo "0"; ?></h5>
                                <span class="description-text">Notícias</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block" onclick="location.href='<?php echo url::base() ?>index?feed=2'">
                                <h5 class="description-header"><?php if($projetos) echo $projetos; else echo "0"; ?></h5>
                                <span class="description-text">Projetos</span>
                            </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block" onclick="location.href='<?php echo url::base() ?>index?feed=3'">
                                <h5 class="description-header"><?php if($propostas) echo $propostas; else echo "0"; ?></h5>
                                <span class="description-text">Propostas</span>
                            </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.widget-user -->
            </div>
        </div>
        <div class="row">
            <?php foreach($feed as $fee){ ?>
                <div class="col-md-12">
                    <!-- Box Comment -->
                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="<?php echo url::base().$imgCandidato; ?>" alt="<?php echo $candidato->CAN_NOME; ?>">
                                <span class="username"><?php echo $fee->FEE_TITULO; ?></span>
                                <?php
                                $dataHoraFeed = explode(" ", $fee->FEE_DATA); 
                                $data = $dataHoraFeed[0];
                                $hora = substr($dataHoraFeed[1],0,5);?>
                                <span class="description"><?php echo Controller_Index::diaSemana($data).", ".Controller_Index::dd_mes_aaaa($data); ?><span class="text-muted pull-right"><?php echo $hora; ?></span></span>
                            </div>
                            <!-- /.user-block -->
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php
                            if($fee->FEE_VIDEO != ""){ ?>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo str_replace("https://www.youtube.com/watch?v=", "", $fee->FEE_VIDEO); ?>?rel=0&amp;showinfo=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>
                            <?php
                            }else{
                                $imgFeed = glob("upload/feed/".$fee->FEE_ID.".*");
                                if($imgFeed){
                                    $imgFeed = $imgFeed[0];
                                }else{
                                    $imgFeed = "";
                                } 
                                //busca total curtidas
                                $curtidas = ORM::factory("curtidas")->where("FEE_ID", "=", $fee->FEE_ID)->count_all();
                                //busca total compartilhamentos
                                $compartilhamentos = ORM::factory("compartilhamentos")->where("FEE_ID", "=", $fee->FEE_ID)->count_all();
                                ?>
                                <img class="img-responsive pad" src="<?php echo url::base().$imgFeed; ?>">
                            <?php
                            } ?>
                            <p><?php echo $fee->FEE_TEXTO; ?></p>
                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Compartilhar</button>
                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Curtir</button>
                            <!-- <span class="pull-right text-muted"><?php echo $curtidas; ?> curtiram - <?php echo $compartilhamentos; ?> compartilharam</span> -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            <?php } ?>
        </div>
    </section>

<?php }else{ // ADMIN // MASTER?>

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de Controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Início</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <section class="col-lg-6 connectedSortable ui-sortable">
            
            </section>

            <section class="col-lg-6 connectedSortable ui-sortable">
                <!-- Calendar -->
                <div class="box box-solid bg-blue-gradient">
                    <div class="box-header">
                        <i class="fa fa-calendar"></i>

                        <h3 class="box-title">Calendário</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
    <!--                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="#">Novo evento</a></li>
                                    <li><a href="#">Limpar Eventos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Ver calendário</a></li>
                                </ul>-->
                            </div>
                            <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <!--                        <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>-->
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                </div>

            </section>

        </div>

    </section>

    <script type="text/javascript">
        $(function () {
            $("#calendar").datepicker({
                language: 'pt-BR',
            });
        });
        
        $(document).ready(function(){
            $("tr .day").each(function(){ 
                var date = new Date();
                
                if(!$(this).hasClass("day old") && !$(this).hasClass("day new") ){
                    if($(this).html() == date.getDate()){
                        $(this).attr("class", "active");
                    }
                }
            });
        });
    </script>
<?php } ?>