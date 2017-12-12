
$(function() {
	// radio button
    $('.radio-group label').on('click', function(){
        $(this).removeClass('not-active').siblings().addClass('not-active');
    });
    
    // select search
    $('.select2').select2();
    
    //Date picker
    $('#datepicker-1, #datepicker-2,#datepicker-3').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
});

