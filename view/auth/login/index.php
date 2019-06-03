<div class="bg"></div>

<section class="content">

    <div class="container">
        <div class="row align-items-center c-content">
            <div class="col-md-5">
                <img src="dist/images/illustrations/login.svg" alt="Illustration de login" class="illustration" width="90%">
            </div>

            <div class="col-md-7">
                <div class="title">
                    <h2 class="title-lg bold color-light margin-bot">Connectez vous.</h2>
                </div>

                <div class="form margin-top-lg margin-bot-lg">
                    <form method="POST" class="margin-bot-lg">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-12 input">
                                    <div class="input-field">
                                        <label for="email" class="color-gray">Email</label>
                                        <input type="email" data-required="true" data-validate="email" placeholder="john-doe@domain.com" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                        <small></small>
                                    </div>
                                </div>

                                <div class="col-1"></div>
                                
                                <div class="col-md-6 col-12 input margin-bot">
                                    <div class="input-field">
                                        <label for="password" class="color-gray">Mot de passe</label>
                                        <input type="password" data-required="true" data-validate="password" name="password" id="password">
                                        <a href="reset-password" class="small" title="Redefinir son mot de passe">Mot de passe oublié ?</a>
                                    </div>
                                </div>

                                
                                <div class="col-12 input margin-bot-lg">
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="keep_session" id="keep_session" <?= isset($_POST['keep_session']) ? 'checked' : '' ?> >
                                        <label for="keep_session" class="color-gray">Restez connecté</label>
                                    </div>
                                </div>


                                <div class="col-12 input">
                                    <button class="btn primary-btn submit-valid" name="login_btn">Connexion</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="spacer-md"></div>

                    <p class="color-gray">Vous n’avez pas de compte ? <a href="register" class="primary-link" title="Se connecter">Inscrivez vous</a></p>
                </div>

            </div>
        </div>
    </div>

</section>

