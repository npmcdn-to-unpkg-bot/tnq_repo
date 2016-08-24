$(document).ready(function(){

	  $("input#show").click(function(){
    var report  = $("select[name='reporttype']").val(),
        startDate = $("input[name='startDate']").val(),
        endDate   = $("input[name='endDate']").val();
       if( report == "binaryreport" ) {
             if((startDate !== '') && (endDate !== '')) {
                getBinaryReport(startDate,endDate);
                // alert("test");
            } else {
                alert('Please select Report, startDate, endDate');
                return false;
            }
        }
  });

function getBinaryReport(startDate,endDate) {
$('div#loadingImge').css('display','block');
        $.ajax({
                url : 'index.php/BinaryReport/getreportdetails',
                type: 'POST',
                data: {startDate:startDate,endDate:endDate},
                success:function(result){
                    $('div#loadingImge').css('display','none');
                    var report = $.parseJSON(result);
                    $("div#tableforbinaryreport").html(report);
                    
                },
                error:function(){
                    alert("Page not found.");
                }
           });
}




	  function nonealltable(){
    $('div#loadingImge').css('display','block');
    $('div#title').css('display','none');
    $('div#legendarticle').css('display','none');
    $('div#legendarticletxt').css('display','none');
    $('div#article-level-trend').css('display','none');
    $('div#ProofCentral-level-trend').css('display','none');
    $('div#Performance-level-trend').css('display','none');
    $('div#Outxml-level-trend').css('display','none');
    $('div#Inxml-level-trend').css('display','none');
    $('div#DAOutxml-level-trend').css('display','none');
    $('div#Help-Page-Count').css('display','none');
    $('div#Outxml-level-trend').css('display','none');
    $('button#graphclick').css('display','none');
    $('div#divForGraph').css('display','none');
    $('div#graphHolder5divForGraph').css('display','none');
}

});