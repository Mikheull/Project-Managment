<div class="bg"></div>

<section class="content">

    <div class="container">
        <div class="row align-items-center c-content">
            <div class="col-md-5">
                <img src="dist/images/illustrations/login.svg" alt="Illustration de login" class="illustration" width="90%">
            </div>

            <div class="col-md-7">
                <div class="title">
                    <h2>Connectez vous.</h2>
                </div>

                <div class="form">
                    <form method="POST">
                        <div class="container">
                            <div class="row">
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
                                        <a href="reset-password" class="small" title="Redefinir son mot de passe">Mot de passe oublié ?</a>
                                    </div>
                                </div>

                                <div class="spacer-xs"></div>
                                
                                <div class="col-12 input">
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="keep_session" id="keep_session" <?= isset($_POST['keep_session']) ? 'checked' : '' ?> >
                                        <label for="keep_session">Restez connecté</label>
                                    </div>
                                </div>

                                <div class="spacer-sm"></div>

                                <div class="col-12 input">
                                    <button class="primary-btn" name="login_btn">Connexion</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="spacer-md"></div>

                    <div class="lk">
                        <p>Vous n’avez pas de compte ? <a href="register" class="primary-link" title="Se connecter">Inscrivez vous</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>

