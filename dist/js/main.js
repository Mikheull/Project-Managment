


if ($("#notifications_tmpl")[0]){
    const template = document.getElementById('notifications_tmpl')
    const container = document.createElement('div')
    container.appendChild(document.importNode(template.content, true))

    tippy('.notification', {
        content: container.innerHTML,
        animation: 'fade',
        arrow: true,
        arrowType: 'round',
        interactive: true,
        onShow(instance) {
            $.ajax({
                url: rootUrl + 'controller/ajax/read_notif.php',
				type: 'POST',
				data: {},
				success:function(data){
                    console.log('show');
				}
			});
        },

    });
    
};
