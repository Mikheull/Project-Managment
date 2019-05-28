<?php
    require_once ('controller/team.php') ;
?>



<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="container-fluid main_wrapper new_team">
    <div class="page_head container">
        <div class="row">
            <div class="col-12"><h2>Créer une équipe</h2></div>

            <div class="col step-btn active" id="btn-first-step" data-step="first-step"> <a> <span style="padding: 10px 20px">1</span> Description</a> </div>
            <div class="col step-btn" id="btn-second-step" data-step="second-step"> <a> <span style="padding: 10px 17px">2</span> Paramètres</a> </div>
            <div class="col step-btn" id="btn-third-step" data-step="third-step"> <a> <span style="padding: 10px 17px">3</span> Invitations</a> </div>
        </div>
    </div>

    <div class="page_content container">
        <div class="row">
            <form action="" method="post">
                <div class="step-content" id="first-step">
                    <div class="illustration"> <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/team_create.svg" alt=""> </div>
                    <div class="input_group">
                        <div class="input-field input-half">
                            <label for="name">Nom de l'équipe</label>
                            <input type="text" name="name" id="name" placeholder="Improove Team" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                        </div>

                        <br>

                        <div class="input-field input-half">
                            <label for="desc">Description</label>
                            <textarea name="desc" id="desc" placeholder="Description de l'équipe"><?= isset($_POST['desc']) ? $_POST['desc'] : '' ?></textarea>
                        </div>
                    </div>
                    <br>

                    <a class="btn primary-btn step-btn" data-step="second-step">Continuer</a>
                </div>


                <div class="step-content" id="second-step">
                    <div class="head">
                        <h3>Accès a l’équipe</h3>
                        <p>Rendre votre équipe publique, autorisera n’importe qui ayant le lien d’invitation, à la rejoindre. Si vous voulez autorisez uniquement certaines personnes, cochez la case privée. </p>
                    </div>

                    <div class="input_group">
                        <div class="input-field input-half">
                            <input type="radio" name="status" id="private" value="private" checked>
                            <label for="private">Privée</label>

                            <input type="radio" name="status" id="public" value="public">
                            <label for="public">Publique</label>
                        </div>
                    </div>
                    <br>

                    <a class="btn primary-btn step-btn" data-step="first-step">Précédent</a>
                    <a class="btn primary-btn step-btn" data-step="third-step">Continuer</a>
                </div>


                <div class="step-content" id="third-step">
                    <div class="head">
                        <h3>Inviter un membre</h3>
                        <p>Entrez un nom ou son mail</p>
                    </div>

                    <input type="email" name="add_email" id="add_email" placeholder="Entrez un email">
                    <button name="add_email_button">Ajouter ce mail</button>

                    <div id="ouput-emails"></div>
                    <br><br><br>

                    <a class="btn primary-btn step-btn" data-step="second-step">Précédent</a>
                    <button class="btn primary-btn" name="create_team">Créer</button>
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

    $(document).on('click', 'button[name="add_email_button"]', function() {
        event.preventDefault();
        var email = $('#add_email').val();

        if (email.length !== 0) {
            popMessage('Mail ajouté dans la liste', 'dark', 2000)

            var fieldHTML = '<input="text" name="">'+ email +'</input>'; 
            $( '#ouput-emails' ).append(fieldHTML);
            $("#add_email").val('');

        }else{
            popMessage('Vous devez entrer un email valide', 'dark', 2000)
        }
        
    });
</script>
