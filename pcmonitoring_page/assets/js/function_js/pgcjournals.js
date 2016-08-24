$(document).ready(function(){
	jQuery.support.cors = true;
	var path = 'json/pgcjournals/';
	$.ajax(
    {
        type: "GET",
        url: path+'rmq1-pgcjournalsconnection.json',
        data: "{}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        success: function (data) {

        var trHTML = '';

        $.each(data.data, function (i, item) {

            trHTML += '<tr><td>' + item.name + '</td><td>' + item.protocol + '</td><td>' + item.chennals + '</td><td>' + item.user + '</td><td>' + item.state + '</td></tr>';
        });

        $('#rmq1_pgcjournalsconnection').append(trHTML);

        },

        error: function (msg) {
            alert(msg.responseText);
        }
    });

	$.ajax(
    {
        type: "GET",
        url: path+'rmq2-pgcjournalsconnection.json',
        data: "{}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        success: function (data) {

        var trHTML = '';

        $.each(data.data, function (i, item) {

            trHTML += '<tr><td>' + item.name + '</td><td>' + item.protocol + '</td><td>' + item.chennals + '</td><td>' + item.user + '</td><td>' + item.state + '</td></tr>';
        });

        $('#rmq2_pgcjournalsconnection').append(trHTML);

        },

        error: function (msg) {
            alert(msg.responseText);
        }
    });

	$.ajax(
	{
		type: "GET",
		url: path+'rmq-pgcjournals.json',
		data: "{}",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		cache: false,
		success: function (data) {

		var trHTML = '';

		$.each(data.data, function (i, item) {

			trHTML += '<tr><td>' + item.name + '</td><td>' + item.ready + '</td><td>' + item.unacked + '</td><td>' + item.total + '</td></tr>';
		});

		$('#rmqpgcjournalstable').append(trHTML);

		},

		error: function (msg) {
			alert(msg.responseText);
		}
	});

	$.ajax(
	{
		type: "GET",
		url: path+'pgcjournalsworker1.json',
		data: "{}",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		cache: false,
		success: function (data) {

		var trHTML = '';

		$.each(data.data, function (i, item) {
			var worker = item.worker;

			if(worker.search('book') >= 0) {
				return ;
			}
			$("#list-pgcjournals").addClass('success');
			switch (item.status) {
				case 'RUNNING':
					var tdClass = 'success';
					break;
				case 'STARTING':
					var tdClass = 'start-info';
					break;
				default:
					var tdClass = 'error';
					$("#list-pgcjournals").removeClass('success');
					$("#list-pgcjournals").addClass(tdClass);
				}

			trHTML += '<tr class='+tdClass+'><td>' + item.worker + '</td><td>' + item.status + '</td></tr>';
		});

		$('#pgcjournalsworker1table').append(trHTML);
		},
		error: function (msg) {
			alert(msg.responseText);
		}
	});

	$.ajax(
	{
		type: "GET",
		url: path+'pgcjournalsworker2.json',
		data: "{}",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		cache: false,
		success: function (data) {

		var trHTML = '';

		$.each(data.data, function (i, item) {

			var worker = item.worker;

			if(worker.search('book') >= 0) {
				return ;
			}

			$("#list-pgcjournals").addClass('success');
			switch (item.status) {
				case 'RUNNING':
					var tdClass = 'success';
					break;
				case 'STARTING':
					var tdClass = 'start-info';
					break;
				default:
					var tdClass = 'error';
					$("#list-pgcjournals").removeClass('success');
					$("#list-pgcjournals").addClass(tdClass);
				}

			trHTML += '<tr class='+tdClass+'>><td>' + item.worker + '</td><td>' + item.status + '</td></tr>';
		});

		$('#pgcjournalsworker2table').append(trHTML);

		},

		error: function (msg) {

			alert(msg.responseText);
		}
	});
});
