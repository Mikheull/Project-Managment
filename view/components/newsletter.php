<div class="newsletter">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="title-sm bold color-dark">Newsletter</h2>
                <p class="color-gray margin-top">Inscrivez vous a notre liste, et restez informé des nouveautées et informations.</p>
            </div>
            <div class="col-md-4 col-12 align-self-center">
                <form action="" method="post">
                    <div class="group light-border">
                        <div class="input margin-right"> <input type="email" name="email_newsletter" id="email_newsletter" placeholder="Adresse email" value="<?= $auth -> isConnected() ? $utils -> getData('imp_user', 'mail', 'public_token', $main -> getToken() ) : '' ?>"> </div>
                        <button class="btn dark-btn" name="subscribe_newsletter">Inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>