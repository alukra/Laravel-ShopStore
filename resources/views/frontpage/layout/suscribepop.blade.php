<!-- Wait Block -->
	<div class="g-popup-wrapper">
		<div class="g-popup g-popup--fb">
			<div class="g-popup--fb-title">
				<a target="_blank" href="https://www.facebook.com/laptopsvaldez.elsalvador/" class="g-popup--fb__logo"><img alt="facebook" src="{{ asset('frontpage/img/others/fb.png')}}" width="110"></a>
				<div class="g-popup--fb-message">Click <strong>"Like"</strong><br>y lee de nuestros post en Facebook</div>
			</div>
			<div class="g-popup--fb-widjet">
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.4&appId=118547268248380";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<div class="fb-like" data-href="https://www.facebook.com/valdezmobile/" data-width="270" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
			</div>
			<a href="javascript:void(0);" class="g-popup__close g-popup--fb__close"><span class="icon-close" aria-hidden="true"></span></a>
		</div>
	</div>
	<!-- End Wait Block -->
