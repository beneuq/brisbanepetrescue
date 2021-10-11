$('#check1').on('click' , function() {
    $('#check2').each(function(){
       $(this).removeAttr('checked');
    })
});
   
$('#check2').on('click', function(){
    $('#check1').removeAttr('checked');
});