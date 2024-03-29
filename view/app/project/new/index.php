<?php
    require_once ('controller/project.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper new_team">
    <div class="creator_head container">
        <div class="row text-align-center">
            <div class="col-12"><h3 class="title-sm color-dark mr-bot-lg mr-top">Créer un projet</h3></div>

            <div class="col step-btn active" id="btn-first-step" data-step="first-step"> <a> <span style="padding: 10px 20px" class="mr-right">1</span> Description</a> </div>
            <div class="col step-btn" id="btn-second-step" data-step="second-step"> <a> <span style="padding: 10px 17px" class="mr-right">2</span> Paramètres</a> </div>
            <div class="col step-btn" id="btn-third-step" data-step="third-step"> <a> <span style="padding: 10px 17px" class="mr-right">3</span> Invitations</a> </div>
        </div>
    </div>

    <div class="creator_container container mr-top-lg light-border">
        <div class="row">

            <form action="" method="post">
                <div class="step-content text-align-center mr-top" id="first-step">
                    <div class="illustration"> <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/project_create.svg" alt="" width="30%"> </div>
                    <div class="input_group">
                        <div class="input-field input-half">
                            <label for="name">Nom du projet</label>
                            <input type="text" name="name" id="name" placeholder="WebSite" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                        </div>

                        <br>

                        <div class="input-field input-half">
                            <label for="desc">Description</label>
                            <textarea name="desc" id="desc" placeholder="Description du projet"><?= isset($_POST['desc']) ? $_POST['desc'] : '' ?></textarea>
                        </div>
                    </div>
                    <br>

                    <div class="bot-btn text-align-center">
                        <a class="btn primary-btn step-btn" data-step="second-step">Continuer</a>
                    </div>
                </div>


                <div class="step-content text-align-left mr-top mr-left mr-right" id="second-step">
                    <div class="head">
                        <h3 class="title-xs color-dark mr-bot mr-top">Accès au projet</h3>
                        <p class="color-gray">Rendre votre projet publique, autorisera n’importe qui ayant le lien d’invitation, à le rejoindre. Si vous voulez autorisez uniquement certaines personnes, cochez la case privée. </p>
                    </div>

                    <div class="input_group status_team">
                        <div class="input-field mr-top-lg mr-bot">
                            <input type="radio" name="status" id="private" value="private" checked>
                            <label class="mr-left" for="private">Privée</label>
                        </div>
                        <div class="input-field">
                            <input type="radio" name="status" id="public" value="public">
                            <label class="mr-left" for="public">Publique</label>
                        </div>
                    </div>

                    <br>

                    <div class="bot-btn text-align-center">
                        <a class="btn primary-btn step-btn" data-step="first-step">Précédent</a>
                        <a class="btn primary-btn step-btn" data-step="third-step">Continuer</a>
                    </div>
                </div>

                <div class="step-content" id="third-step">
                    <div class="head text-align-center mr-bot-lg">
                        <h3 class="title-xs color-dark mr-bot mr-top">Inviter un membre</h3>
                        <p class="color-gray">Entrez le mail de l'utilisateur. Attention il doit être inscrit sur la plateforme ! </p>
                    </div>

                    <div class="content">
                        <div class="search text-align-center">
                            <input type="text" name="mails_list[]" id="add_email" placeholder="Entrez un email">
                            <div class="mr-top">
                                <a href="javascript:void(0);" class="addField_button btn dark-btn" title="Add field"> Ajouter le mail </a>
                            </div>
                        </div>

                        <div class="output mr-top">
                            <ul id="mails_list"></ul>
                        </div>
                    </div>

                    <div class="bot-btn text-align-center">
                        <a class="btn primary-btn step-btn" data-step="second-step">Précédent</a>
                        <button class="btn primary-btn" name="create_project">Créer</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    
</div>


<script>
    $('.step-content').hide();
    $('#first-step').show();

    $( '.step-btn' ).click(function() {
        var step = this.dataset.step;
        $('.step-btn').removeClass( 'active' );
        $('#btn-'+step).toggleClass('active');
        
        $('.step-content').hide();
        $('#'+step).show();
    })

    $(document).ready(function(){
        var maxField = 15; //Input fields increment limitation
        var addButton = $('.addField_button'); //Add button selector
        var wrapper = $('#mails_list'); //Input field wrapper
        var x = 1; //Initial field counter is 1
        
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter

                let val = $( '#add_email' ).val();
                var fieldHTML = '<div> <input type="text" name="mails_list[]" value="'+val+'"/> <a href="javascript:void(0);" class="removeField_button"> <i class="fas fa-minus-circle"></i> </a></div>'; //New input field html 
                $(wrapper).append(fieldHTML); //Add field html
                $( '#add_email' ).val('');
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.removeField_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });

    });
</script>
