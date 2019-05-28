<li class="result_item">
    <a href="member/<?= $item['username'] ?>" title="Accéder au compte de <?= $item['first_name']?> <?= $item['last_name']?>">
        <div class="container">

            <div class="row">
                <div class="col-2">
                    <div class="profil_pic"> 
                        <img src="<?= $config -> rootUrl() ;?>dist/<?= $item['profil_image'] == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $item['public_token'].'/profil_pic/'.$item['profil_image'] ;?>" alt="Image de profil" width="70%"> 
                    </div> 
                </div>

                <div class="col-10 align-self-center">
                    <span class="username"><?= $item['username']?></span>
                    <span class="name"><?= $item['first_name']?> <?= $item['last_name']?></span>
                </div>
            </div>

        </div>
    </a>
</li>