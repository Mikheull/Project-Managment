<?php
    require ('controller/friend.php');

    if($auth -> isConnected() == true){
        $userToken = $_SESSION['user_token'];
?>

        <div id="account-bg">
            <?php require ('view/components/navbar-header-dark.php') ;?>
        </div>



        <div class="container account floating_container follow">
            <?php require ('view/content/account/components/heading_account.php') ;?>

            <ul class="fol_content">
                <?php
                    if(empty($friend -> getFollowings($userToken))){
                        ?>
                            <div class="row">
                                <div class="col-6 offset-6 empty-fol"> <h3>0 followings</h3> </div>
                            </div>
                        <?php
                    }else{
                        foreach($friend -> getFollowings($userToken) as $res){

                        ?>
                            <li class="result_item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-2">
                                            <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getDataFromUserToken( $res['following'], 'username') ?>" title="Accéder au compte de <?= $user -> getDataFromUserToken( $res['following'], 'first_name') ?> <?= $user -> getDataFromUserToken( $res['following'], 'last_name') ?>">
                                                <div class="profil_pic"> <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getDataFromUserToken( $res['following'], 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $res['following'].'/profil_pic/'.$user -> getDataFromUserToken( $res['following'], 'profil_image') ;?>" alt="Image de profil" width="70%"> </div> 
                                            </a>
                                        </div>
                                        <div class="col-8 align-self-center">
                                            <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getDataFromUserToken( $res['following'], 'username') ?>" title="Accéder au compte de <?= $user -> getDataFromUserToken( $res['following'], 'first_name') ?> <?= $user -> getDataFromUserToken( $res['following'], 'last_name') ?>">
                                                <span class="username"><?= $user -> getDataFromUserToken( $res['following'], 'username') ?></span>
                                                <span class="name"><?= $user -> getDataFromUserToken( $res['following'], 'first_name') ?> <?= $user -> getDataFromUserToken( $res['following'], 'last_name') ?></span>
                                            </a>
                                        </div>
                                        <div class="col-2 align-self-center">
                                            <form method="post">
                                                <button name="follow" class="btn dark-btn" title="Suivre">Ne plus Suivre</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                    <?php
                        }
                    }
                ?>
            </ul>

        </div>


        <?php require ('view/components/footer.php') ;?>
<?php
    }else{
        header('location: login?return_url=account%2Ffollowing');
    }
?>