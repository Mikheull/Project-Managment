<?php
    require ('controller/contact.php');
    require ('controller/newsletter.php');

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
            <div class="col-md-6 offset-md-3 col-12 offset-0 margin-bot-lg">
                
                <div class="margin-bot-lg margin-top-lg text-align-center">
                    <h2 class="title-lg bold color-dark margin-bot">Contactez nous</h2>
                    <h3 class="title-xs color-gray">Vous avez une question ? Remplissez notre formulaire pour prendre contact avec nous. Ou consultez la F.A.Q ci-dessous</h3>
                </div>

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
                
                    <div class="g-recaptcha margin-bot" data-sitekey="6Lf17aUUAAAAADTZBmHbHKb0b35bFVU6xFstRllP"></div>

                    <button class="btn primary-btn" name="send_contact_button">Envoyer</button>

                </form>
            </div>
        </div>

    </div>
    


    <div class="container margin-bot-lg margin-top-lg">
        <h2 class="title-lg bold color-dark margin-bot">Frequently Asked Questions</h2>

        <div class="accordion">
            <div class="accordion-item margin-bot">
                <a class="color-primary">Consectetur adipiscing elit ?</a>
                <div class="content">
                    <p class="color-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                </div>
            </div>
            <div class="accordion-item margin-bot">
                <a class="color-primary">Sed do eiusmod tempor incididunt ut labore et dolore ?</a>
                <div class="content">
                    <p class="color-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                </div>
            </div>
            <div class="accordion-item margin-bot">
                <a class="color-primary">Lorem ipsum dolor sit amet ?</a>
                <div class="content">
                    <p class="color-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                </div>
            </div>
            <div class="accordion-item margin-bot">
                <a class="color-primary">Tempor incididunt ut labore ?</a>
                <div class="content">
                    <p class="color-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
                </div>
            </div>
        </div>
    
    </div>

    <?php require ('view/components/newsletter.php') ;?>

<?php require ('view/components/footer.php') ;?>



<script>
const items = document.querySelectorAll(".accordion a");
function toggleAccordion(){
    this.classList.toggle('active');
    this.nextElementSibling.classList.toggle('active');
}
items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>