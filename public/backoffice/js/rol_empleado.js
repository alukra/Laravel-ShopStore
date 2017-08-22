jQuery(document).ready(function($) {
	
	$('#tblrol_empleado').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "language": datatableLang
  });

	$(document).on('click', ".btnSave", function(){
		id  = $(this).val();
		rol = $("select[name='"+id+"']").val();
		Pace.track(function(){
			$.ajax({
  			url: APP_URL + '/employe/save',
  			type: 'POST',
  			data: {
  				id: id,
  				rol: rol,
					'_token': $('meta[name="csrf-token"]').attr('content') 
  			},
  		})
  		.done(function(data) {
  			if (data) {
	  			$(".alert-success").show();
					$(".mensaje1").show();
  			}
  		});
		});
	});

	$(document).on('ifChecked', '#chkAll', function(){
		$('.chkSave').iCheck('check');
	});

	$(document).on('ifUnchecked', '#chkAll', function(){
		$('.chkSave').iCheck('uncheck');
	});

	$(document).on('click', '#btnSaveAll', function(){
		var guardar = $(".chkSave").serialize();
		var valores = $(".sltSave").serialize();
		Pace.track(function(){	
			$.ajax({
  			url: APP_URL + '/employe/save-all',
  			type: 'POST',
  			data: {
  				guardar: guardar,
  				valores: valores,
  				'_token': $('meta[name="csrf-token"]').attr('content') 
  			},
  			beforeSend: function(){
		      $('.fadebox').show();
		      $('.overbox').show();
		   	}
  		})
  		.done(function(data) {
  			if (data) {
	  			$(".alert-success").show();
					$(".mensaje1").show();
  			}
  		})
		});
	});

});

