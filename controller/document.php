<?php


/**
 * Script des méthodes de documents
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$document = new document($db);



if(isset($_POST['import_btn'])){
	if(count($_FILES['import_files']['name']) > 0){




		if(!is_dir('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/')){
			mkdir('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/', 0777, true);
		}

		for($i=0; $i<count($_FILES['import_files']['name']); $i++) {
			$tmpFilePath = $_FILES['import_files']['tmp_name'][$i];

			if($tmpFilePath != ""){
				$shortname = $_FILES['import_files']['name'][$i];
				$filePath = "dist/uploads/p/".$router -> getRouteParam("2")."/docs/".$_FILES['import_files']['name'][$i];

				if(move_uploaded_file($tmpFilePath, $filePath)) {
					$errors = ['success' => false, 'options' => ['content' => "Les fichiers ont été téléchargés !", 'theme' => 'success'] ];
				}
			}
		}

		

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Merci de télécharger un fichier !", 'theme' => 'error'] ];
    }
}


// End of file
/******************************************************************************/
