<div class="bg"></div>

<section class="content">

    <div class="container">
        <div class="row align-items-center c-content">
            <div class="col-md-5">
                <img src="dist/images/illustrations/register.svg" alt="Illustration d'inscription" class="illustration" width="90%">
            </div>

            <div class="col-md-7 col-12">
                <div class="title">
                    <h2 class="title-md bold color-light mr-bot">Rejoignez nous gratuitement dès maintenant.</h2>
                    <h3 class="title-xs color-gray">Profitez de la totalité des fonctionnalités de la plateforme en vous inscrivant.</h3>
                </div>

                <div class="form mr-top-lg mr-bot-lg">
                    <form method="POST" class="mr-bot-lg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="username" class="color-gray">Pseudo</label>
                                        <input type="text" placeholder="JohnDoe" name="username" id="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-1"></div>
                                
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="email" class="color-gray">Email</label>
                                        <input type="email" data-required="true" data-validate="email" placeholder="john-doe@domain.com" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                        <small class="error"></small>
                                    </div>
                                </div>

                                <div class="col-1"></div>
                                
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="password" class="color-gray">Mot de passe</label>
                                        <input type="password" data-required="true" data-validate="password" name="password" id="password">
                                        <small class="error"></small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12 input mr-bot">
                                    <div class="input-field">
                                        <label for="confirm_password" class="color-gray">Confirmer le mot de passe</label>
                                        <input type="password" data-required="true" data-validate="same-password" name="confirm_password" id="confirm_password">
                                        <small class="error"></small>
                                    </div>
                                </div>


                                <div class="col-12 input mr-bot-lg">
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="accept_cgu" id="accept_cgu" <?= isset($_POST['accept_cgu']) ? 'checked' : '' ?> >
                                        <label for="accept_cgu" class="color-gray">J’ai accepté les <a href="cgu" class="primary-link" title="Lire les conditions d'utilisation" target="blank">conditions d’utilisations</a></label>
                                    </div>
                                </div>


                                <div class="col-12 input">
                                    <button class="btn primary-btn" name="register_btn">Inscription</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <p class="color-gray">Vous avez déjà un compte ? <a href="login" class="primary-link" title="Se connecter">Connectez vous</a></p>
                </div>

            </div>
        </div>
    </div>

</section>

