
$(document).on('click', '.short-act-btn', function() {
	event.preventDefault();

    var project = this.dataset.project;
    var action = this.id;

    $.ajax({
        url: '../controller/ajax/team_short-actions.php',
        type: 'POST',
        data: {project: project, action: action},
        success:function(data){
            $('#team_output').html(data);
        }
    });
});