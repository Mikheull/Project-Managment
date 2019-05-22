<?php
    require ('controller/contact.php');

    if(strpos($_SERVER['REQUEST_URI'], '?') !== false) {
        $parameter = explode('?', $_SERVER['REQUEST_URI']);
        $param = $parameter[1];

        $resultParam = explode('for=', $param);
        $mail_objet = $resultParam[1];
        if($mail_objet == 'help'){$mail_objet = 'Demande d\'aide' ;}

    }

?>


<?php require ('view/components/navbar-header-light.php') ;?>

    <div class="container contact">
    
        <div class="row">
            <div class="col-6">
                <form action="" method="POST">
                    <div class="input_group">
                        <div class="input-field input-half">
                            <label for="first_name">Prénom</label>
                            <input type="text" name="first_name" id="first_name" placeholder="Prénom" value="<?= (isset($_POST['first_name']) ? $_POST['first_name'] : ($auth -> isConnected() == true ? $user -> getUserData( $main -> getToken(), 'first_name') : '') ) ?>">
                        </div>
                        <div class="input-field input-half">
                            <label for="last_name">Nom</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Nom" value="<?= (isset($_POST['last_name']) ? $_POST['last_name'] : ($auth -> isConnected() == true ? $user -> getUserData( $main -> getToken(), 'last_name') : '') ) ?>">
                        </div>

                        <div class="input-field input-half-al">
                            <label for="email">Mail</label>
                            <input type="email" name="email" id="email" placeholder="Email" value="<?= (isset($_POST['email']) ? $_POST['email'] : ($auth -> isConnected() == true ? $user -> getUserData( $main -> getToken(), 'mail') : '') ) ?>">
                        </div>
                    </div>   

                    <div class="input_group"> 
                        <div class="input-field">
                            <label for="objet">Objet</label>
                            <input type="text" name="objet" id="objet" placeholder="Objet" value="<?= (isset($_POST['objet']) ? $_POST['objet'] : (isset($mail_objet) ? $mail_objet : '') ) ?>">
                        </div>
                        <div class="input-field">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" placeholder="Entrez votre message ici"><?= (isset($_POST['message']) ? $_POST['message'] : '' ) ?></textarea>
                        </div>
                    </div>               
                

                    Captcha Google

                    <button class="primary-btn" name="send_contact_button">Envoyer</button>

                </form>
            </div>
        </div>

    </div>

<?php require ('view/components/footer.php') ;?>