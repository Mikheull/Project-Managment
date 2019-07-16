<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;
    require_once ('controller/calendar.php') ;

    $tasks = $task -> getAllTasks( $router -> getRouteParam('2') );
    $events = $calendar -> getEvents( $router -> getRouteParam('2') );
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">
        <div class="container-fluid margin-top-lg">
            <div class="row">
                <div class="col">
                    <div id="calendar"></div>
                </div>
                <div id="calendar_details_output"></div>
            </div>
            

            <input type="hidden" name="ref" value="<?= $router -> getRouteParam('2') ?>">
            <div id="calendar_output"></div>
        </div>
    </div>

</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            businessHours: true,

            plugins: [ 'interaction', 'dayGrid'],
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
                                id: 'task|<?= $tsk['task_token'] ;?>',
                                className: 'cal-ttp link',
                                title: '<?= $tsk['name'] ;?>',
                                start: '<?= $tsk['deadline'] ;?>',
                                end: '<?= $tsk['deadline'] ;?>',
                                allDay: true,
                                startEditable: false,
                                durationEditable: false,
                                rendering: 'color',
                                color: '#f76707'
                            },
                        <?php
                    }

                    foreach($events as $e){
                        ?>
                            {
                                id: 'custom|<?= $e['event_token'] ;?>',
                                className: 'cal-ttp link',
                                title: '<?= $e['name'] ;?>',
                                start: '<?= $e['date_begin'] ;?>',
                                end: '<?= $e['date_end'] ;?>',
                                allDay: true,
                                rendering: 'color',
                                color: '#6741d9',
                                startEditable: true,
                                durationEditable: false,
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
                    let startdate = arg.start.getUTCFullYear()+'-'+ ( arg.start.getUTCMonth() + 1) +'-'+ ( arg.start.getUTCDate() + 1) +' 00:00:00';
                    let enddate = arg.end.getUTCFullYear()+'-'+ ( arg.end.getUTCMonth() + 1) +'-'+ ( arg.end.getUTCDate() + 1) +' 00:00:00';
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/calendar/add_event.php',
                        type: 'POST',
                        data: {project_token: ref, name: title, start: startdate, end: enddate, actions: 'add_event'},
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
                        color: '#f76707'
                    })
                }
                calendar.unselect()
            },

            eventClick: function(info) {
                $.ajax({
                    url:  rootUrl + 'controller/ajax/project/calendar/details_output.php',
                    type: 'POST',
                    data: {ref: info.event.id},
                    success:function(data){
                        $( '#calendar_details_output' ).addClass('col-3');
                        $( '#calendar_details_output' ).html(data);
                    }
                });
            },

            editable: true,
            eventDrop: function(info) {
                let date = info.event.start.getUTCFullYear()+'-'+ ( info.event.start.getUTCMonth() + 1) +'-'+ ( info.event.start.getUTCDate() + 1) +' 00:00:00';
                let ref = info.event.id;    

                $.ajax({
                    url:  rootUrl + 'controller/ajax/project/calendar/move_event.php',
                    type: 'POST',
                    data: {ref: ref, date: date},
                    success:function(data){
                        $('#calendar_output').html(data);
                    }
                });

                console.log('okasa')
                // $.ajax({
                //     url:  rootUrl + 'controller/ajax/project/calendar/add_event.php',
                //     type: 'POST',
                //     data: {ref: id, date: date, actions: 'move_event'},
                //     success:function(data){
                //         $('#calendar_output').html(data);
                //     }
                // });
            },

        });
        
        calendar.render();
    });



$(document).ready(function() {
    tippy('.cal-ttp', {
        content: "Cliquez pour voir les détails",
    })
    $(document).on("click", "#close", function(e) {
        $( '#calendar_details_output' ).empty();
        $( '#calendar_details_output' ).removeClass('col-3');
    });

});


// Actions avec le clavier
$(document).bind('keydown', function(e) {
    //console.log(e.which)
    
    // Bouton Echap pour quitter la création de fichiers / dossiers
    if(e.which == 27) {
        if ( $( "#calendar_details_output .details_container" ).length ) {
            e.preventDefault();
            $( '#calendar_details_output' ).empty();
            $( '#calendar_details_output' ).removeClass('col-3');
        }
        return false;
    }
});

    
</script>