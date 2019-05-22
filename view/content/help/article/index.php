<?php require ('view/components/navbar-header-light.php') ;?>


Article

<a href="<?= $config -> rootUrl() ;?>help">Retour</a>

<?php

print_r( $router -> getRouteParam() );

?>