<div class="bg-2"></div>

<section class="content reset">
    <div class="container">
        <div class="row align-items-center justify-content-center c-content">
            <?php

                if($auth -> passResetDemandeExist($router -> getRouteParam('1'), $router -> getRouteParam('2'))){
                    ?>
                    <div class="col-md-6 col-12">
                        <div class="title">
                            <h2>Votre nouveau mot de passe :</h2>
                        </div>

                        <div class="form">
                            <form method="POST">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2 col-12 input">
                                            <div class="input-field">
                                                <label for="password">Nouveau mot de passe</label>
                                                <input type="password" name="password" id="password" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="spacer-sm"></div>

                                        <div class="col-12 input">
                                            <button class="primary-btn" name="new-password_btn">Confirmer</button>
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
                        <div class="title">
                            <h2>Aucune demande n'a été trouvée !</h2>
                        </div>
                    </div>
                    <?php
                }

            ?>
        </div>
    </div>
</section>

