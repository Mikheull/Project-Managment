<?php
    require_once ('controller/project.php') ;
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/calendar/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="link dark-link"> Calendrier </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar/settings" class="link dark-link active"> Réglages </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container calendar_wrapper margin-top-lg">
        <div class="row">
            <div class="col">
                <form method="POST">
                    <div class="input_group">
                        <div class="input-field">
                            <label for="task_color">Couleur de tâche</label>
                            <input type="text" class="colorpicker" name="task_color" placeholder="#9775fa" value="<?= $utils -> getSetting('task-color', 'set_calendar', $router -> getRouteParam("2")) ?>">
                        </div>
                    </div>

                    <div class="input_group">
                        <div class="input-field">
                            <label for="event_color">Couleur d'évènement</label>
                            <input type="text" class="colorpicker" name="event_color" placeholder="#74b816" value="<?= $utils -> getSetting('event-color', 'set_calendar', $router -> getRouteParam("2")) ?>">
                        </div>
                    </div>

                    <button class="btn primary-btn" name="save_settings">Sauvegarder</button>
                </form>
            </div>
        </div>
    </div>

</div>


<script>
$(document).ready( function() {

    $('.colorpicker').each( function() {
        $(this).minicolors( );

    });

});
</script>
