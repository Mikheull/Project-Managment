<div class="col-md-4 col-12">
    <div class="card-item light-border mr-bot" style="background: #242e5a">
        <div class="mr-bot-lg mr-top-lg text-align-center">
            <div class="profil_picture-md">
                <div class="img light-border center" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $item) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $item.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $item) ;?>');"></div>
            </div>
            <div class="name title-sm bold"> <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $item) ;?>" class="link light-link"> <?= $utils -> getData('imp_user', 'username', 'public_token', $item) ;?> </a> </div>
        </div>
    </div>
</div>