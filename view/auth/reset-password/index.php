<div class="bg-2" style="background-image: url('<?= $config -> rootUrl() ;?>dist/images/content/item_background.svg?>');background-size: 100% auto;background-position: -23vh top;background-repeat: no-repeat;"> </div>
<div class="illustration-mail"> <img src="dist/images/illustrations/mail.svg" alt="illustration mail" width="100%"> </div>

<section class="content reset">
    <div class="container">
        <div class="row align-items-center justify-content-center c-content text-align-center">
            <div class="col-md-8 col-12">
                <div class="title">
                    <h2 class="title-md bold color-light mr-bot">Vous avez perdu votre mot de passe ?</h2>
                    <h3 class="title-xs color-gray">Indiquez votre mail d’inscription et suivez les étapes.</h3>
                </div>

                <div class="form">
                    <form method="POST">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 offset-md-2 col-12 input mr-bot-lg mr-top-lg">
                                    <div class="input-field">
                                        <label for="email" class="color-gray">Mail de récupération</label>
                                        <input type="email" data-required="true" data-validate="email" placeholder="john-doe@domain.com" name="email" id="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                        <small class="error"></small>
                                    </div>
                                </div>


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

