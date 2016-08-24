$(document).ready(function(){
    jQuery.support.cors = true;
    var path = '/json/pcjournalsandbooks/';
    $.ajax(
    {
        type: "GET",
        url: path+'rmq-pcjournals.json',
        data: "{}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        success: function (data) {
            
        var trHTML = '';
                
        $.each(data.data, function (i, item) {
            
            trHTML += '<tr><td>' + item.name + '</td><td>' + item.ready + '</td><td>' + item.unacked + '</td><td>' + item.total + '</td></tr>';
        });
        
        $('#rmqpcjournalstable').append(trHTML);
        
        },
        
        error: function (msg) {
            alert(msg.responseText);
        }
    });

    $.ajax(
    {
        type: "GET",
        url: path+'pcjournalsandbooksworker1.json',
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
        	$("#list-pcjournals").addClass('success');
            switch (item.status) {
            	case 'RUNNING':
        			var tdClass = 'success';
        			break;
        		case 'STARTING':
        			var tdClass = 'start-info';
        			break;
        		default:
        			var tdClass = 'error';
        			$("#list-pcjournals").removeClass('success');
        			$("#list-pcjournals").addClass(tdClass);
        		}

            trHTML += '<tr class='+tdClass+'><td>' + item.worker + '</td><td>' + item.status + '</td></tr>';
        });

        $('#pcjournalsworker1table').append(trHTML);
        },
        error: function (msg) {
            alert(msg.responseText);
        }
    });

    $.ajax(
    {
        type: "GET",
        url: path+'pcjournalsandbooksworker2.json',
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

            $("#list-pcjournals").addClass('success');
            switch (item.status) {
            	case 'RUNNING':
        			var tdClass = 'success';
        			break;
        		case 'STARTING':
        			var tdClass = 'start-info';
        			break;
        		default:
        			var tdClass = 'error';
        			$("#list-pcjournals").removeClass('success');
        			$("#list-pcjournals").addClass(tdClass);           
        		}
            
            trHTML += '<tr class='+tdClass+'>><td>' + item.worker + '</td><td>' + item.status + '</td></tr>';
        });
        
        $('#pcjournalsworker2table').append(trHTML);
        
        },
        
        error: function (msg) {
            
            alert(msg.responseText);
        }
    });
});
