<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $titulo; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link type="image/vnd.microsoft.icon" rel="shortcut icon" href="<?php echo url::base(); ?>images/favicon.png">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo url::base() ?>bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo url::base(); ?>plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo url::base() ?>dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo url::base() ?>plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img  style="width:200px;" src="<?php echo url::base() ?>images/logo.png" alt="">
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <!--<p class="login-box-msg">Sign in to start your session</p>-->

                <form action="" method="post" id="formLogin">

                    <div id="msg-login" style="display: none;"></div>

                    <div class="form-group has-feedback">
                        <input type="user" class="form-control" placeholder="Usuário" label="Usuário" id="login" name="login" validar="texto">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Senha" label="Senha" id="senha" name="senha"  validar="texto">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <span id="loading-login" style="display: none;"><i class="fa fa-refresh fa-spin"></i> Aguarde...</span>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!--<a href="#">Esqueci minha senha</a><br>-->

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        
        <script type="text/javascript">
            var URLBASE = "<?php echo url::base() ?>";
        </script>

        <!-- jQuery-->
        <!--<script src="<?php echo url::base(); ?>js/jquery-1.9.1.min.js" type="text/javascript"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo url::base() ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="<?php echo url::base(); ?>plugins/select2/select2.full.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo url::base() ?>plugins/iCheck/icheck.min.js"></script>
        <!--MASCARAS-->
        <script src="<?php echo url::base(); ?>js/maskedmoney-1.3.min.js" type="text/javascript"></script>
        <script src="<?php echo url::base(); ?>js/maskedinput-1.4.min.js" type="text/javascript"></script>
        <!--JQUERY UI-->
        <script src="<?php echo url::base(); ?>js/jquery-ui.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo url::base(); ?>css/jquery-ui.css" type="text/css" media="" />
        <!--VALIDADOR-->
        <script src="<?php echo url::base(); ?>js/validar-1.3.5.js" type="text/javascript"></script>
        <!--forms-->
        <script src="<?php echo url::base(); ?>js/forms_etc.min.js?v=1"></script>
        
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
    <?php
    //DESCONECTA DO BANCO (POR GARANTIA)
    Database::instance()->disconnect();
    ?>
</html>