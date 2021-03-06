<?php require_once(dirname(__FILE__) . "/../bootstrap.php"); ?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Douglas Alves">
        <link rel="icon" href="http://getbootstrap.com/favicon.ico">

        <title>BackFront</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo ASSETS_URL ?>/libs/semantic_ui/semantic.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_URL ?>/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_URL ?>/libs/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_URL ?>/libs/prism/prism.css" rel="stylesheet">
        <link href="<?php echo ASSETS_URL ?>/css/main.css" rel="stylesheet">
        <link href="<?php echo ASSETS_URL ?>/jumbotron.css" rel="stylesheet">

        <script src="<?php echo ASSETS_URL ?>/libs/jquery.min.js"></script>
        <script src="<?php echo ASSETS_URL ?>/libs/semantic_ui/semantic.min.js"></script>
        <script src="<?php echo ASSETS_URL ?>/libs/bootstrap-fileinput/js/fileinput.min.js"></script>
        <script src="<?php echo ASSETS_URL ?>/libs/prism/prism.js"></script>
        <script src="<?php echo ASSETS_URL ?>/js/mainscript.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        <main class="container bfe top-20">
            <div class="row">
                <div class="col-md-12">

