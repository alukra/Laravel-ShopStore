jQuery(document).ready(function($) {
	$(".alert-error").hide();
	$(".alert-success").hide();
	$(".mensaje1").hide();
	$(".mensaje2").hide();
	$(".mensaje3").hide();
	$(".mensaje4").hide();

	//Datatable
	var tabla = $('#tblrol').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });

	//Modal editar
  $(document).on('click', '#modal-editar', function(){
  	var id = $(this).val();
  	resetForm();
  	$("#btnEditar").show();
  	$("#btnCrear").hide();
  	$('.rol-modal').modal('show');
      $.ajax({
    		url: APP_URL + '/back/role/' + id,
    		type: 'GET',
    		data: { id : id },
    	})
    	.done(function(data) {
    		data = jQuery.parseJSON(data);
    		$("#id").val(data.id);
    		$("#txtNombre").val( data.nombre );
  			$("#txtDescripcion").val( data.descripcion );
    	})
    	.fail(function() {
    		$(".alert-error").show();
    		$(".mensaje4").show();
    	});
  });

  //Modal crear
  $(document).on('click', '#modal-crear', function(){
  	resetForm();
  	$("#btnCrear").show();
  	$("#btnEditar").hide();
  	$('.rol-modal').modal('show');
  });


  $(document).on('click', "#asignar", function(){
  	var id = $(this).val();
  	$.get(APP_URL + '/back/role-module/asignar-rol', {id : id }, function(data) {
          $('.modulo-modal-body').html(data);
  		  	$('.modulo-modal').modal('show');
  	});
  });

  //Crear el rol
  $(document).on('click', '#btnCrear', function(){
  	$(this).addClass('disabled');
  	flag = true;
  	if ( $("#txtNombre").hasClass('has-error') || $("#txtDescripcion").hasClass('has-error') || $("#txtNombre").val() == "" || $("#txtDescripcion").val() == "" ) {
  		flag = false;
  	}
  	if (flag) {
  		var nombre = $("#txtNombre").val();
			var descripcion = $("#txtDescripcion").val();
    		$.ajax({
    			url: APP_URL + '/back/role',
    			type: 'POST',
    			data: {
    				nombre: nombre,
    				descripcion: descripcion,
  					'_token': $('meta[name="csrf-token"]').attr('content')
    			},
    		})
    		.done(function(data) {
    			data = jQuery.parseJSON(data);
    			if (data.estado) {
    				$('.rol-modal').modal('hide');
    				tabla.row.add([
    					data.rol.nombre,
    					data.rol.descripcion,
    					"<button id='modal-editar' value='" + data.rol.id +"' class='btn btn-default'><i class='fa fa-pencil'></i> </button>\
  							<button id='asignar' value='" + data.rol.id +"' class='btn btn-default'><i class='fa fa-cog'></i> </button>\
  							<button id='activar' value='" + data.rol.id +"' class='btn btn-primary'> <i class='fa fa-power-off'></i></button>"
    				]).draw( false );
    				$(".alert-success").show();
  					$(".mensaje1").show();
    			}else{

    			};
    		})
    		.fail(function() {
    			$(".alert-error").show();
    			$(".mensaje4").show();
    		});

  	}else{
  		$(".alert-error").show();
  		$(".mensaje3").show();
  	}
  	$(this).removeClass('disabled');
  });


	//Actualizar el rol
  $(document).on('click', '#btnEditar', function(){
  	$(this).addClass('disabled');
  	flag = true;
  	if ( $("#txtNombre").hasClass('has-error') || $("#txtDescripcion").hasClass('has-error') || $("#txtNombre").val() == "" || $("#txtDescripcion").val() == "" ) {
  		flag = false;
  	}

  	if (flag) {
  		var id = $("#id").val();
  		var nombre = $("#txtNombre").val();
			var descripcion = $("#txtDescripcion").val();

    		$.ajax({
    			url: APP_URL + '/back/role/' + id,
    			type: 'PUT',
    			data: {
    				id: id,
    				nombre: nombre,
    				descripcion: descripcion,
  					'_token': $('meta[name="csrf-token"]').attr('content')
    			},
    		})
    		.done(function(data) {
    			data = jQuery.parseJSON(data);
    			if (data.estado) {
    				$('.rol-modal').modal('hide');
    				$(".alert-success").show();
  					$(".mensaje2").show().delay( 1000, function(){
  						location.reload();
  					});
    			}else{
    				$(".alert-error").show();
    				$(".mensaje4").show();
    			};
    		})
    		.fail(function() {
    			$(".alert-error").show();
    			$(".mensaje4").show();
    		});


  	}else{
  		$(".alert-error").show();
  		$(".mensaje3").show();
  	}
  	$(this).removeClass('disabled');
  });

  $(document).on("click","#asignarRoles", function(){
    permiso =  $("#permiso_rol").serialize();
      $.ajax({
        url: APP_URL + '/back/role-module/asignar-rol',
        type: 'POST',
        data: {
          permiso : permiso,
          '_token': $('meta[name="csrf-token"]').attr('content')
        },
      })
      .done(function(data) {
        if (data) {
          $('.rol-modal').modal('hide');
          $(".alert-success").show();
          $('.modulo-modal').modal('hide');
          $(".mensaje5").show().delay( 1000, function(){
          //  location.reload();
          });
        }else{
          $(".alert-error").show();
          $(".mensaje4").show();
        };
      });

  });

	//Reiniciar el form
  function resetForm(){
  	$("#txtNombre").val("");
  	$("#txtDescripcion").val("");
  	$("#id").val("");
  }

});
