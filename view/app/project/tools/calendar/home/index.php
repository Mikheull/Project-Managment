<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;

    $tasks = $task -> getAllTasks( $router -> getRouteParam('2') );
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
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="link dark-link active"> Calendrier </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar/settings" class="link dark-link"> Réglages </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container calendar_wrapper margin-top-lg">
        <div id="calendar"></div>

        <input type="hidden" name="ref" value="<?= $router -> getRouteParam('2') ?>">
        <div id="calendar_output"></div>
    </div>

</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            businessHours: true,

            plugins: [ 'interaction', 'dayGrid', 'timeGrid'],
            defaultView: 'dayGridMonth',

            buttonText: {
                today: 'aujourd\'hui'
            },

            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },

            events: [
                <?php
                    foreach($tasks['content'] as $tsk){
                        ?>
                            {
                                title: 'Tâche : <?= $tsk['name'] ;?>',
                                start: '<?= $tsk['deadline'] ;?>',
                                end: '<?= $tsk['deadline'] ;?>',
                                allDay: true,
                                rendering: 'color',
                                color: '#6C63FF'
                            },
                        <?php
                    }
                ?>
            ],
            eventLimit: true,
            eventLimit: 3,
            eventLimitText: ' caché(s)',

            selectable: true,
            selectMirror: true,
            select: function(arg) {
                var title = prompt('Titre de l\'evenement :');
                if (title) {
                    let ref = $( 'input[name="ref"]' ).val();
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/calendar/add_event.php',
                        type: 'POST',
                        data: {project_token: ref, name: title, start: arg.start, end: arg.end},
                        success:function(data){
                            $('#calendar_output').html(data);
                        }
                    });

                    calendar.addEvent({
                        title: title,
                        start: arg.start,
                        end: arg.end,
                        allDay: arg.allDay,
                        rendering: 'color',
                        color: '#6C63FF'
                    })
                }
                calendar.unselect()
            }

        });
        
        calendar.render();
    });

</script>