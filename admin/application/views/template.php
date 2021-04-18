<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="copyright" content="copyright (c) OWS" />
        <title><?php echo $titulo; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link type="image/vnd.microsoft.icon" rel="shortcut icon" href="<?php echo url::base(); ?>images/favicon.png">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo url::base(); ?>bootstrap/css/bootstrap.min.css">
        <!--icones-->
        <link rel="stylesheet" href="<?php echo url::base(); ?>css/sprite-icones.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo url::base(); ?>plugins/select2/select2.min.css">
        <!--fonts-icons-->
        <link rel="stylesheet" href="<?php echo url::base(); ?>dist/css/fonts.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo url::base(); ?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="<?php echo url::base(); ?>dist/css/skins/skin-blue.min.css">
        
        <script type="text/javascript">
            var URLBASE = "<?php echo url::base() ?>";
        </script>

        <!-- jQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo url::base() ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="<?php echo url::base(); ?>plugins/select2/select2.full.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo url::base() ?>dist/js/app.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo url::base() ?>plugins/iCheck/icheck.min.js"></script>
        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo url::base() ?>plugins/chartjs/Chart.min.js"></script>
        <!--MASCARAS-->
        <script src="<?php echo url::base(); ?>js/maskedmoney-1.3.min.js" type="text/javascript"></script>
        <script src="<?php echo url::base(); ?>js/maskedinput-1.4.min.js" type="text/javascript"></script>
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo url::base(); ?>plugins/datepicker/datepicker3.css">
        <script src="<?php echo url::base(); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo url::base(); ?>plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js"></script>
        <!--VALIDADOR-->
        <script src="<?php echo url::base(); ?>js/validar-1.3.5.js" type="text/javascript"></script>
        <!--forms-->
        <script src="<?php echo url::base(); ?>js/forms_etc.min.js?v=1"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="<?php echo url::base(); ?>index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="<?php echo url::base(); ?>images/logo.png" style="width: 25px;"/></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?php echo url::base(); ?>images/logo.png" style="width: 40px;"/></span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Navegação</span>
                    </a>
                    
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Notifications Menu -->
                                <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <?php
                                    $img = glob("upload/usuarios/thumb_".$idvivente.".*");
                                    if($img){
                                        $img = $img[0];
                                    }else{
                                        $img = "dist/img/pessoa.png";
                                    }
                                    ?>
                                    <img src="<?php echo url::base().$img; ?>" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo $vivente; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="<?php echo url::base().$img; ?>" class="img-circle" alt="User Image">

                                        <p><?php echo $vivente; ?></p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo url::base(); ?>usuarios/edit/<?php echo $idvivente; ?>" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo url::base(); ?>login/logout" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo url::base().$img; ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            Olá, <p><?php echo $vivente; ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                        <div class="pull-right image">
                            <!--<img alt="Work Image" class="img-circle" src="<?php echo url::base(); ?>images/empresa.png">-->
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <form class="sidebar-form" method="get" action="#">
                        <div class="input-group" style="padding-left: 0px; padding-right: 0px;">
                            <input type="text" placeholder="Buscar menu..." class="form-control" name="q" onkeyup="buscamenu($(this).val());" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-flat" id="search-btn" name="search" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    
                    <ul class="sidebar-menu">
                        <!-- Optionally, you can add icons to the links -->
                        <?php
                        foreach ($categoriamodulo as $cam) {
                            $modulos = ORM::factory("modulos")->with("modulospermissoes")
                                            ->where("PER_ID", "=", $permissao)->where("CAM_ID", "=", $cam->categoriamodulo->CAM_ID)
                                            ->order_by("MOD_NOME", "asc")->find_all();
                            
                            $classesubmenu = ""; ?>
                        
                            <li class="header">
                                <?php echo $cam->categoriamodulo->CAM_NOME ?>
                                
                                <!--CADASTROS SISTEMA-->
                                <?php if($cam->categoriamodulo->CAM_ID == "4"){ 
                                        $classesubmenu = " cadastrosistema"; ?>
                                        <i class="fa fa-plus-circle" style="cursor: pointer;" onclick="abrefechamenu('<?php echo trim($classesubmenu); ?>');"></i>
                                        <i class="fa fa-minus-circle" style="cursor: pointer; display: none;" onclick="abrefechamenu('<?php echo trim($classesubmenu); ?>');"></i>
                                <?php } ?>
                            </li>
                            <?php
                            foreach ($modulos as $mod) {
                                //VERIFICA SE É FAVORITO PARA COLOCAR A ESTRELINHA
                                ?>
                                <li class="<?php echo $active; ?>">
                                    <a href="<?php echo url::base(); ?><?php echo $mod->MOD_LINK ?>">
                                        <?php if($mod->MOD_ICONE == ""){ ?>
                                            <i class="material-icons">link</i> 
                                        <?php }else{?>
                                            <i class="material-icons"><?php echo $mod->MOD_ICONE; ?></i> 
                                        <?php } ?>
                                        <span><?php echo $mod->MOD_NOME; ?></span>
                                    </a>
                                </li>
                            <?php 
                            } ?>
                                
                        <?php
                        } ?>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">

                    <?php echo $conteudo ?>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    <!--qualquer coisa-->
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; <?php echo date("Y"); ?></strong>
            </footer>

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

    </body>
</html>