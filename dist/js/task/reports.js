// Add squares
let ref = $('#ref').attr('data-ref')

$.ajax({
    url:  rootUrl + 'controller/ajax/project/task/report_graph.php',
    type: 'POST',
    data: {ref, ref},
    success:function(data){
        $('.squares').html(data);
    }
});

