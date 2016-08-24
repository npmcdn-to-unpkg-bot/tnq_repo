$(document).ready(function(){
	jQuery.support.cors = true;
	var path = 'json/pcrsc/';
    
	$.ajax(
	{
		type: "GET",
		url: path+'rmq-pcrsc.json',
		data: "{}",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		cache: false,
		success: function (data) {

		var trHTML = '';

		$.each(data.data, function (i, item) {

			var rmq = item.name;

			if(rmq.search('elife') >= 0) {
				return ;
			}
			trHTML += '<tr><td>' + item.name + '</td><td>' + item.ready + '</td><td>' + item.unacked + '</td><td>' + item.total + '</td></tr>';
		});

		$('#rmqpcrsctable').append(trHTML);

		},

		error: function (msg) {
			alert(msg.responseText);
		}
	});

	$.ajax(
	{
		type: "GET",
		url: path+'pcrscworker.json',
		data: "{}",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		cache: false,
		success: function (data) {

		 var trHTML = '';

		$.each(data.data, function (i, item) {

			var worker = item.worker;

			if(worker.search('book') < 0) {
				return ;
			}

			$("#list-pcrsc").addClass('success');
			switch (item.status) {
				case 'RUNNING':
					var tdClass = 'success';
					break;
				case 'STARTING':
					var tdClass = 'start-info';
					break;
				default:
					var tdClass = 'error';
					$("#list-pcrsc").removeClass('success');
					$("#list-pcrsc").addClass(tdClass);
				}
			trHTML += '<tr class='+tdClass+'><td>' + item.worker + '</td><td>' + item.status + '</td></tr>';
		});

		$('#pcrscsworkertable').append(trHTML);
		},
		error: function (msg) {
			alert(msg.responseText);
		}
	});
});
