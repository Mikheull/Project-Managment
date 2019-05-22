<?php $exec_router = $router -> getRouteFilePath($_GET['query']); ?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes"/>
    
    <meta name="robots" content="nosnippet"/>
    <meta name="language" content="fr"/>
    <meta name="author" content="Mikhaël Bailly"/>
    <meta name="category" content="gestion, app, website"/>
    <meta name="theme-color" content="#1971c2"/>

    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://www.improove.io/<?= $_GET['query'] ;?>"/>
    <meta property="twitter:url" content="https://www.improove.io/<?= $_GET['query'] ;?>"/>
    <?php $config -> getPageConfig($exec_router['config_path'], 'meta') ;?>


    <link rel="stylesheet" type="text/css" media="screen" href="<?= $config -> rootUrl() . $config -> includeCss('reset.min.css', $config -> getTheme('front'), 'front');?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $config -> rootUrl() . $config -> includeCss('main.min.css', $config -> getTheme('front'), 'front');?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $config -> rootUrl() . $config -> includeCss('bootstrap-grid.min.css', $config -> getTheme('front'), 'front');?>">
    <?php $config -> getPageConfig($exec_router['config_path'], 'css') ;?>
    
    <link rel="shortcut icon" href="<?= $config -> rootUrl() ;?>dist/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Poppins:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@latest/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
</head>
<body>

    <?php 
        // La variable viens du fichier router
        require ($require_url);
    ?>



    <script> <?php if(isset($errors)){ ?> $( document ).ready(function() { popMessage('<?= $errors['error'] ;?>', 'light', 2000) }); <?php } ?> </script>
    <script src="<?= $config -> rootUrl() ;?>dist/js/main.js"></script>
    
    <?php $config -> getPageConfig($exec_router['config_path'], 'js') ;?>

</body>
</html>