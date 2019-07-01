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

    <?php 
        // Meta generated Begin 
        $config -> getConfigMeta($exec_router['config_path']);
        // Meta generated End 
    ?>


    <link rel="stylesheet" type="text/css" media="screen" href="<?= $config -> rootUrl() . $config -> includeCss('rcH84cbzfsjxE8db9Hjm.min.css', $config -> getTheme('front'), 'front');?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= $config -> rootUrl() . $config -> includeCss('bootstrap-grid.min.css', $config -> getTheme('front'), 'front');?>">
    
    <link rel="shortcut icon" href="<?= $config -> rootUrl() ;?>dist/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Poppins:300,400,500" rel="stylesheet">

    <?php if($config -> getConfigLib($exec_router['config_path'],'fontawesome') == true){?> <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'feather-icons') == true){?> <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'jquery') == true){?> <script src="https://cdn.jsdelivr.net/npm/jquery@latest/dist/jquery.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'popper') == true){?> <script src="https://unpkg.com/popper.js@1"></script> <?php } ;?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php if($config -> getConfigLib($exec_router['config_path'],'aos') == true){?> <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'bootbox') == true){?> <script src="https://cdn.jsdelivr.net/npm/bootbox@5.1.3/dist/bootbox.all.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'tippy') == true){?> <script src="https://unpkg.com/tippy.js@4"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'nice-select') == true){?> <script src="https://cdn.jsdelivr.net/npm/jquery-nice-select@1.1.0/js/jquery.nice-select.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'fakeLoader') == true){?> <script src="https://cdn.jsdelivr.net/npm/jq-fakeloader@2.0.1/js/fakeLoader.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'recaptcha') == true){?> <script src="https://www.google.com/recaptcha/api.js" async defer></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'dragscroll') == true){?> <script src="https://cdn.jsdelivr.net/npm/dragscroll@0.0.8/dragscroll.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'fullcalendar') == true){?> <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'colorpicker') == true){?> <script src="https://cdn.jsdelivr.net/npm/jquery-minicolors@2.1.10/jquery.minicolors.min.js"></script> <?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'mermaid') == true){?> <script src="https://cdn.jsdelivr.net/npm/mermaid@8.0.0/dist/mermaid.min.js"></script> <script src="https://cdn.rawgit.com/knsv/mermaid/0.5.8/dist/mermaidAPI.js"></script><?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'fullscreen') == true){?> <script src="https://cdn.jsdelivr.net/npm/screenfull@4.2.0/dist/screenfull.min.js"></script><?php } ;?>
    <?php if($config -> getConfigLib($exec_router['config_path'],'filepond') == true){?> <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script> <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script> <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script> <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js"></script> <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script><?php } ;?>
        
    <?php 
        // CSS generated Begin
        $config -> getConfigCss($exec_router['config_path']);
        // CSS generated End
    ?>
   
</head>



<body>

    <?php 
        // La variable viens du fichier router
        if($config -> renderMustBeConnected($exec_router['config_path']) == false OR $auth -> isConnected() == true){
            require ($require_url);
        }else{
            $return_url = '';
            foreach($router -> getRouteParam() as $p){ $return_url .= $p.'%2F';}
            header('location: '. $config -> rootUrl() .'login?return_url='. $return_url);
        }
    ?>








    <script src="<?= $config -> rootUrl() ;?>dist/js/notify.js"></script>
    <script src="<?= $config -> rootUrl() ;?>dist/js/main.js"></script>
    <script>
        <?php
            if(isset($errors)){
                ?>
                $( document ).ready(function() {
                    notify.new({
                        content : '<?= $errors['options']['content'] ;?>',
                        <?php if(isset($errors['options']['position'])){ echo 'position : \''.$errors['options']['position'].'\'' ;}?>
                        <?php if(isset($errors['options']['animation'])){ echo 'animation : \''.$errors['options']['animation'].'\'' ;}?>
                        <?php if(isset($errors['options']['clickToHide'])){ echo 'clickToHide : \''.$errors['options']['clickToHide'].'\'' ;}?>
                        <?php if(isset($errors['options']['autoHide'])){ echo 'autoHide : \''.$errors['options']['autoHide'].'\'' ;}?>
                        <?php if(isset($errors['options']['autoHideDelay'])){ echo 'autoHideDelay : \''.$errors['options']['autoHideDelay'].'\'' ;}?>
                        <?php if(isset($errors['options']['size'])){ echo 'size : \''.$errors['options']['size'].'\'' ;}?>
                        <?php if(isset($errors['options']['theme'])){ echo 'theme : \''.$errors['options']['theme'].'\'' ;}?>
                        <?php if(isset($errors['options']['showDuration'])){ echo 'showDuration : \''.$errors['options']['showDuration'].'\'' ;}?>
                        <?php if(isset($errors['options']['hideDuration'])){ echo 'hideDuration : \''.$errors['options']['hideDuration'].'\'' ;}?>
                    });
                });
                <?php
            }
        ?>
    </script>
    <?php 
        // Scripts generated Begin
        $config -> getConfigScript($exec_router['config_path']);
        // Scripts generated End
    ?>
</body>
</html>