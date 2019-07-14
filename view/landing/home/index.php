<?php require ('controller/newsletter.php'); ?>
<?php require_once ('view/components/navbar-header-light.php') ;?>

<section class="main_container">

    <div class="container home_pre">
        <div class="row">
            <div class="col-md-5 col-12 align-self-center left" data-aos="fade-up" data-aos-duration="600">
                <h2 class="title-lg bold color-dark margin-bot">Gérez vos projets et vos équipes</h2>
                <h3 class="title-xs color-gray">Gagnez du temps en restant organisé</h3>
                <div class="btns margin-top-lg margin-right"> <a href="<?= $config -> rootUrl() ;?>app" title="Débuter un projet" class="btn primary-btn">Lancez votre projet</a> </div>
                <div class="btns margin-top-lg"> <a href="" title="Regarder la vidéo" class="btn light-btn-bordered open_pres-video"><i data-feather="play-circle"></i> Regarder la vidéo</a> </div>
            </div>
            <div class="col-md-7 col-12 align-self-center right" data-aos="fade-left" data-aos-duration="500">
                <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/landing_home.svg" alt="" width="100%">
            </div>
        </div>
    </div>

    <div class="container home_partners text-align-center">
        <div class="row">
            <div class="col-10 offset-1 partners-content light-border">
                <div class="container">
                    <h3 class="title-sm bold color-dark margin-bot-lg margin-top-lg">Ils nous font confiance</h3>
                    <div class="row justify-content-around">
                        <div class="col"> <img src="dist/images/content/logos/netflix.svg" alt="" height="64px"> </div>
                        <div class="col"> <img src="dist/images/content/logos/tesla.svg" alt="" height="64px"> </div>
                        <div class="col"> <img src="dist/images/content/logos/facebook.svg" alt="" height="64px"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container_fluid home_head_presentation text-align-center">
        <h3 class="title-md bold color-light">Gagnez en productivité</h3>
        <p class="color-gray">Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
        <div class="illustration"> <img src="dist/images/illustrations/productivity.svg" alt="" width="50%"> </div>
    </div>


    <div class="container home_presentation">
        <div class="row pres-element" data-aos="fade-right" data-aos-duration="700">
            <div class="col-md-6 col-10 illustration text-align-left order-md-1 order-2"> <img src="dist/images/illustrations/team_managment.svg" alt="" width="80%"> </div>
            <div class="col-md-6 col-10 heading align-self-center order-md-2 order-1">
                <h2 class="title-sm bold color-dark margin-bot margin-left">Gérez votre équipe</h2>
                <p class="color-gray">Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
        </div>

        <div class="row pres-element" data-aos="fade-right" data-aos-duration="700">
            <div class="col-md-6 col-10 heading align-self-center">
                <h2 class="title-sm bold color-dark margin-bot margin-left">Maintenez votre projet</h2>
                <p class="color-gray">Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
            <div class="col-md-6 col-10 illustration text-align-right"> <img src="dist/images/illustrations/project_managment.svg" alt="" width="80%"> </div>
        </div>

        <div class="row pres-element" data-aos="fade-right" data-aos-duration="700">
            <div class="col-md-6 col-10 illustration text-align-left order-md-1 order-2"> <img src="dist/images/illustrations/share_experience.svg" alt="" width="80%"> </div>
            <div class="col-md-6 col-10 heading align-self-center order-md-2 order-1">
                <h2 class="title-sm bold color-dark margin-bot margin-left">Partagez votre expérience</h2>
                <p class="color-gray">Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
        </div>

        <div class="row pres-element" data-aos="fade-right" data-aos-duration="700">
            <div class="col-md-6 col-10 heading align-self-center">
                <h2 class="title-sm bold color-dark margin-bot margin-left">Agrandissez votre réseau</h2>
                <p class="color-gray">Nunc vero inanes flatus quorundam vile esse quicquid extra urbis pomerium nascitur aestimant praeter orbos et caelibes, nec credi potest qua obsequiorum diversitate coluntur homines sine liberis Romae.</p>
            </div>
            <div class="col-md-6 col-10 illustration text-align-right"> <img src="dist/images/illustrations/grow_social.svg" alt="" width="80%"> </div>
        </div>
    </div>

    <?php require ('view/components/newsletter.php') ;?>

</section>

<?php require ('view/components/footer.php') ;?>


<script> AOS.init(); </script>