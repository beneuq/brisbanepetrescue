$('#menuToggle').on('click' , function() {
    $('#menuToggle-2').each(function(){
       $(this).removeAttr('checked');
    })
});
   
$('#menuToggle-2').on('click', function(){
    $('#menuToggle').removeAttr('checked');
});