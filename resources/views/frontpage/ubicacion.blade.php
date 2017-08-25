@extends('frontpage.layout')

@section ('title') {{ $page_title }} @stop

@section('content')

  <!--=== Breadcrumbs ===-->
  <div class="breadcrumbs">
    <div class="container">
      <h1 class="pull-left">Sucursal: {{ $ubicacion->nombre }}</h1>
      <ul class="pull-right breadcrumb">
        @foreach ($ubicaciones as $key => $ubi)
          @if ($ubi->id == $ubicacion->id)
            <li><a href="{{ url('location/'. $ubi->id) }}" CLASS="active">{{ $ubi->nombre }}</a></li>
          @else
            <li><a href="{{ url('location/'. $ubi->id) }}">{{ $ubi->nombre }}</a></li>
          @endif
        @endforeach
      </ul>
    </div>
  </div><!--/breadcrumbs-->
  <!--=== End Breadcrumbs ===-->

  <!-- Google Map -->
  <div id="map" class="map"></div>
  <!-- End Google Map -->

  <!--=== Content Part ===-->
  <div class="container content">
    <div class="row margin-bottom-30">
      <div class="col-md-8 col-lg-8 mb-margin-bottom-30">
        <div class="headline"><h2>Sucursal {{ $ubicacion->nombre }}</h2></div>
        <div class="row">
          <div class="col-md-7">
            <h3 class="text-justify"><i class="fa fa-map-marker"></i> {{ $ubicacion->direccion }}</h3>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <h2 class="text-center"><a href="tel://{{ $ubicacion->telefono }}"><i class="fa fa-phone"></i>{{ $ubicacion->telefono }}</a></h2>
            <h4><i class="fa fa-clock-o fa-fw"></i> <strong>lun - Vie:</strong> {{ $ubicacion->horario1 }}<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sabado:</strong> {{ $ubicacion->horario2 }}<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Domingo:</strong> {{ $ubicacion->horario3 }}
            </h4>
          </div>
        </div>
        <hr><br>
      </div><!--/col-md-9-->

      <div class="col-md-4 col-lg-4">
        <!-- Contacts -->
          <div class="responsive-video">
            <video src="{{ asset($ubicacion->video) }}" loops controls width="100%">  Tu navegador no soporta el formato de video de Valdez Mobile  </video>
          </div>
      </div><!--/col-md-3-->
    </div><!--/row-->

  </div><!--/container-->
  <!--=== End Content Part ===-->

@endsection


@section('cssExtras')
@endsection

@section('scriptsExtras')
  <script>
    jQuery(document).ready(function() {
      App.init();
      ContactForm.initContactForm();
      OwlCarousel.initOwlCarousel();
      StyleSwitcher.initStyleSwitcher();
    });

    // Google Map
    function initMap() {
      GoogleMap.initGoogleMap();
    }
  </script>  
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGIAkd5LvY6YBAry_0Us1TpYiN1wbWkIU&sensor=false"></script>
  <script>
		// Google Map
		function initMap() {
			GoogleMap.initGoogleMap();
		}
	</script>
	<script type="text/javascript">
	//Defining map as a global variable to access from
	//other functions
	var map;
	var trafficLayer = new google.maps.TrafficLayer();
	function initMap() {
	//Enabling new cartography and themes
	google.maps.visualRefresh = true;
	//Setting starting options of map
	var mapOptions = {
	center: new google.maps.LatLng({{ $ubicacion->latitud_mapa }}, {{ $ubicacion->longitud_mapa }}),
	zoom: {{ $ubicacion->zoom }},
	mapTypeId: google.maps.MapTypeId.TERRAIN
	};
	//Getting map DOM element
	var mapElement = document.getElementById('map');

	//Creating a map with DOM element which is just
	//obtained
	map = new google.maps.Map(mapElement, mapOptions);
	trafficLayer.setMap(map);
	var infowindow = new google.maps.InfoWindow({
	    content: '<div class="text-center"><h5><a href="https://www.waze.com/es-419/livemap?zoom=15&lat={{ $ubicacion->coord_x }}&lon={{ $ubicacion->coord_y }}&from_lat={{ $ubicacion->latitud_mapa }}&from_lon={{ $ubicacion->longitud_mapa }}&to_lat={{ $ubicacion->latitud_mapa }}&to_lon={{ $ubicacion->longitud_mapa }}&at_req=0&at_text=Now" target="_blank"><img src="{{asset('frontpage/img/wazze.png')}}"><br>¿Como llegar a Sucursal <br></h5><h3>{{ $ubicacion->nombre }}?</a></h3> </div>',
	    position: new google.maps.LatLng({{ $ubicacion->latitud_mapa }},{{ $ubicacion->longitud_mapa }})
	});
	infowindow.open(map);
	}
	google.maps.event.addDomListener(window, 'load', initMap);
	</script>
@endsection
