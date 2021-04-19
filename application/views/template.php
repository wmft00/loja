<!DOCTYPE html>
<html lang="pt">
    <head>
        <title><?php echo $titulo; ?></title>

        <meta charset="utf-8" />
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="robots" content="all" />
        <meta name="audience" content="all" />
        <meta name="rating" content="general" />
        <meta name="distribuition" content="global" />
        <meta name="revisit-after" content="7 days" />
        <meta name="language" content="pt-br" />
        <meta name="googlebot" content="index, follow" />
        <meta name="author" content="William Franceschetto" />
        <meta name="copyright" content="copyright (c) ows" />
        <!-- Mobile view -->
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--FAVICON-->
        <link rel="shortcut icon" href="<?php echo url::base(); ?>favicon.png?v=<?php echo $cacheController; ?>" type="image/png" />

        <script type="text/javascript">
            var URLBASE = "<?php echo url::base() ?>";
        </script>

        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Loja Troc</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="<?php echo url::base(); ?>carrinho">Carrinho</a>
    <a class="p-2 text-dark" href="<?php echo url::base(); ?>admin">Admin</a>
  </nav>
</div>

<?php echo $conteudo; ?>
<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">top</a>
    </p>
  </div>
</footer>
</div>
    </body>
</html>
<!--SCRIPTS-->
<!--CSS DA PÁGINA-->
<link href="<?php echo url::base(); ?>css/bootstrap.min.css?v=<?php echo $cacheController; ?>" rel="stylesheet" />
<link href="<?php echo url::base(); ?>css/custom.css?v=<?php echo $cacheController; ?>" rel="stylesheet" />
<!--FIM CSS-->