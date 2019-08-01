<div class="bg-2" style="background-image: url('<?= $config -> rootUrl() ;?>dist/images/content/item_background.svg?>');background-size: 100% auto;background-position: -23vh top;background-repeat: no-repeat;"> </div>

<section class="content reset">
    <div class="container">
        <div class="row align-items-center justify-content-center c-content text-align-center">
            <?php

                if($auth -> passResetDemandeExist($router -> getRouteParam('1'), $router -> getRouteParam('2'))){
                    ?>
                    <div class="col-md-8 col-12">
                        <div class="title">
                            <h2 class="title-md bold color-light mr-bot">Votre nouveau mot de passe :</h2>
                        </div>

                        <div class="form">
                            <form method="POST">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2 col-12 input mr-bot mr-top">
                                            <div class="input-field">
                                                <label for="password" class="color-gray">Nouveau mot de passe</label>
                                                <input type="password" data-required="true" data-validate="password" name="password" id="password">
                                                <small class="error"></small>
                                            </div>
                                        </div>

                                        <div class="col-12 input">
                                            <button class="btn primary-btn" name="new-password_btn">Confirmer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                    <?php
                }else{
                    ?>
                    <div class="col-12">
                        <div class="title color-gray">
                            <h2>Aucune demande n'a été trouvée !</h2>
                        </div>
                    </div>
                    <?php
                }

            ?>
        </div>
    </div>
</section>

