$(document).ready(function(){

	  $("input#show").click(function(){
	  	$('div#loadingImge').css('display','block');
            $.ajax({
                url : 'index.php/PgcdailyReport/email',
                success:function(){
                $('div#loadingImge').css('display','none');
                	alert("Mail Successfully Sent");
                },
            });

})
      
});