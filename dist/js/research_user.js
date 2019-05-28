
$('#reseach_result').hide();

$(document).on('keyup', '#user_research', function() {
	var min_length = 3;
    var keyword = $('#user_research').val();
    
    if (keyword.length >= min_length) {
			$.ajax({
				url: './controller/ajax/research_user.php',
				type: 'POST',
				data: {keyword:keyword},
				success:function(data){
					$('#reseach_result').show();
					$('#reseach_result .ouput').html(data);
				}
			});
	}else{
		$('#reseach_result').hide();
	}
});