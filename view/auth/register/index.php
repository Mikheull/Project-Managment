<div class="bg"></div>

<section class="content">

    <div class="container">
        <div class="row align-items-center c-content">
            <div class="col-md-5">
                <img src="dist/images/illustrations/register.svg" alt="Illustration d'inscription" class="illustration" width="90%">
            </div>

            <div class="col-md-7">
                <div class="title">
                    <h2>Rejoignez nous gratuitement dès maintenant.</h2>
                    <h3>Profitez de la totalité des fonctionnalités de la plateforme en vous inscrivant.</h3>
                </div>

                <div class="form">
                    <form method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="username">Pseudo</label>
                                        <input type="text" placeholder="JohnDoe" name="username" id="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-1"></div>
                                
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="email">Email</label>
                                        <input type="email" placeholder="john-doe@domain.com" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col-1"></div>
                                
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" name="password" id="password">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="confirm_password">Confirmer le mot de passe</label>
                                        <input type="password" name="confirm_password" id="confirm_password">
                                    </div>
                                </div>

                                <div class="spacer-xs"></div>

                                <div class="col-12 input">
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="accept_cgu" id="accept_cgu" <?= isset($_POST['accept_cgu']) ? 'checked' : '' ?> >
                                        <label for="accept_cgu">J’ai accepté les <a href="cgu" class="primary-link" title="Lire les conditions d'utilisation">conditions d’utilisations</a></label>
                                    </div>
                                </div>

                                <div class="spacer-sm"></div>

                                <div class="col-12 input">
                                    <button class="btn primary-btn" name="register_btn">Inscription</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="spacer-md"></div>

                    <div class="lk">
                        <p>Vous avez déjà un compte ? <a href="login" class="primary-link" title="Se connecter">Connectez vous</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

