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

			$path = "dist/uploads/p/".$router -> getRouteParam("2")."/docs/index.php";
			$file = fopen($path,"w");
			fwrite($file,"");
			fclose($file);
		}

		for($i=0; $i<count($_FILES['import_files']['name']); $i++) {
			$tmpFilePath = $_FILES['import_files']['tmp_name'][$i];

			if($tmpFilePath != ""){
				$shortname = $_FILES['import_files']['name'][$i];
				$filePath = "dist/uploads/p/".$router -> getRouteParam("2")."/docs/".$_FILES['import_files']['name'][$i];

				if(move_uploaded_file($tmpFilePath, $filePath)) {
					$errors = ['success' => false, 'options' => ['content' => "Les fichiers ont été téléchargés !", 'theme' => 'success'] ];
				}else{
					$errors = ['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ];
				}
			}else{
				$errors = ['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ];
			}
		}

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Merci de télécharger un fichier !", 'theme' => 'error'] ];
    }
}




if(isset($_POST['create_doc'])){

	if(!is_dir('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/')){
		mkdir('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/', 0777, true);

		$path = "dist/uploads/p/".$router -> getRouteParam("2")."/docs/index.php";
		$file = fopen($path,"w");
		fwrite($file,"");
		fclose($file);
	}
		
	if(isset($_POST['doc_name']) AND !empty($_POST['doc_name']) AND isset($_POST['doc_content']) AND !empty($_POST['doc_content'])){

        $doc_name = cleanVar($_POST['doc_name']);
        $doc_content = $_POST['doc_content'];

		file_put_contents('dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$doc_name, $doc_content);
        $errors = ['success' => false, 'options' => ['content' => "Le fichier a été crée !", 'theme' => 'success'] ];

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}






if(isset($_POST['save_edit'])){
	
	if(isset($_POST['org_file_name']) AND !empty($_POST['org_file_name']) AND isset($_POST['doc_name']) AND !empty($_POST['doc_name']) AND isset($_POST['doc_content']) AND !empty($_POST['doc_content'])){

        $org_file_name = cleanVar($_POST['org_file_name']);
        $doc_name = cleanVar($_POST['doc_name']);
        $doc_content = $_POST['doc_content'];

		$file_path = 'dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$org_file_name;
		

		// Edit
		$file_handle = fopen($file_path, 'w'); 
		fwrite($file_handle, $doc_content);
		fclose($file_handle);


		// Rename
		rename ($file_path, 'dist/uploads/p/'.$router -> getRouteParam("2").'/docs/'.$doc_name);
		header('Location: '.$config -> rootUrl().'app/project/'.$router -> getRouteParam("2").'/t/documents/viewer?file_name='.$doc_name);
        $errors = ['success' => false, 'options' => ['content' => "Les modifications ont été sauvegardées !", 'theme' => 'success'] ];

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
	}
	
}



// End of file
/******************************************************************************/
