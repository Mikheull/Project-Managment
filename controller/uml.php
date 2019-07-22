<?php


/**
 * Script des méthodes de uml
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$uml = new uml($db);



if(isset($_POST['import_uml'])){
    if(isset($_POST['diagram_name']) AND !empty($_POST['diagram_name']) AND isset($_POST['diagram_type']) AND !empty($_POST['diagram_type']) AND isset($_POST['diagram_content']) AND !empty($_POST['diagram_content'])){

        $name = cleanVar($_POST['diagram_name']);
        $type = cleanVar($_POST['diagram_type']);
        $content = cleanVar($_POST['diagram_content']);
        $project_token = $router -> getRouteParam('2');

        $errors = $uml -> importDiagram($name, $type, $content, $project_token);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}


if(isset($_POST['create_uml'])){
    if(isset($_POST['diagram_name']) AND !empty($_POST['diagram_name']) AND isset($_POST['diagram_type']) AND !empty($_POST['diagram_type']) AND isset($_POST['diagram_content']) AND !empty($_POST['diagram_content'])){

        $name = cleanVar($_POST['diagram_name']);
        $type = cleanVar($_POST['diagram_type']);
        $content = cleanVar($_POST['diagram_content']);
        $project_token = $router -> getRouteParam('2');

        $errors = $uml -> importDiagram($name, $type, $content, $project_token);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}


if(isset($_POST['edit_uml'])){
    if(isset($_POST['diagram_name']) AND !empty($_POST['diagram_name']) AND isset($_POST['diagram_type']) AND !empty($_POST['diagram_type']) AND isset($_POST['diagram_content']) AND !empty($_POST['diagram_content'])){

        $name = cleanVar($_POST['diagram_name']);
        $type = cleanVar($_POST['diagram_type']);
        $content = cleanVar($_POST['diagram_content']);
        $uml_token = $router -> getRouteParam('5');

        $errors = $uml -> editDiagram($name, $type, $content, $uml_token);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}


if(isset($_POST['delete_uml'])){
    $uml_token = $router -> getRouteParam('5');

    $errors = $uml -> deleteDiagram($uml_token);

}
// End of file
/******************************************************************************/
