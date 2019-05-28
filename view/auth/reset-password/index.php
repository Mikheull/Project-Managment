<div class="bg-2"></div>
<div class="illustration-mail"> <img src="dist/images/illustrations/mail.svg" alt="illustration mail" width="100%"> </div>

<section class="content reset">
    <div class="container">
        <div class="row align-items-center justify-content-center c-content">
            <div class="col-md-6 col-12">
                <div class="title">
                    <h2>Vous avez perdu votre mot de passe ?</h2>
                    <h3>Indiquez votre mail d’inscription et suivez les étapes.</h3>
                </div>

                <div class="form">
                    <form method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 col-12 input">
                                    <div class="input-field">
                                        <label for="email">Mail de récupération</label>
                                        <input type="email" placeholder="john-doe@domain.com" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                    </div>
                                </div>

                                <div class="spacer-sm"></div>

                                <div class="col-12 input">
                                    <button class="btn primary-btn" name="reset-password_btn">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

