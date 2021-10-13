$('#check1').on('change', function() {
    $('#check2').not(this).prop('checked', false);  
});

$('#check2').on('change', function() {
    $('#check1').not(this).prop('checked', false);  
});