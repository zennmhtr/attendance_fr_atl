<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="theme-color" content="#2196f3">
	<meta http-equiv="Content-Security-Policy" content="default-src * 'self' 'unsafe-inline' 'unsafe-eval' data: gap:">
	
	<meta name="description" content="Ombe - Coffee Shop Mobile App ( Framework 7 + PWA )" />
	<meta property="og:title" content="Ombe - Coffee Shop Mobile App ( Framework 7 + PWA )" />
	<meta property="og:description" content="Ombe - Coffee Shop Mobile App ( Framework 7 + PWA )" />
	<meta property="og:image" content="https://ombe.dexignzone.com/xhtml/social-image.png"/>
	<meta name="format-detection" content="telephone=no">
	<link rel="manifest" href="{{ url('/myhr/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
	
	<!-- Title -->
	<title>GACOANKU</title>
	
	<!-- Framework7 css -->
	<link rel="stylesheet" href="{{ url('/gc/css/framework7-bundle.css') }}">
	<link rel="stylesheet" href="{{ url('/gc/css/app.css') }}">
	
	<!-- Fonts -->
	<link rel="stylesheet" href="{{ url('/gc/css/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ url('/gc/css/line-awesome/css/line-awesome.min.css') }}">
	
	<!-- Style css -->
	<link rel="stylesheet" href="{{ url('/gc/css/style.css') }}">
	<link rel="stylesheet" href="{{ url('/gc/css/perfect-scrollbar.css') }}">
	
	<!-- Favicon -->
	<link rel="apple-touch-icon" href="{{ url('/gc/img/f7-icon-square.png') }}">
	<link rel="icon" href="{{ url('/gc/img/f7-icon.png') }}">
  
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
	
</head>
<body>
<div id="app">
	<div class="page welcome-screen">
        <div class="page-content">
            <div class="container welcome-inner">
                <div class="text-align-center mb-70">
                    <div class="main-logo center mb-50">
                        <div class="logo-icon">
                            <img src="{{ url('/gc/img/logo2.jpg') }}" width="80" height="92">
                        </div>
                        <h2 class="logo-name">Gacoanku</h2>
                        <p class="logo-text">Mie Gacoan Application</p>	
                    </div>
                    <h2 class="ma-0">Morning begins with Mie Gacoan</h2>
                </div>
                <div class="clearfix pb-30">
                    <a href="{{ url('/') }}" id="btnget" class="button-large button button-social rounded-xl button-fill mb-40"><span>sign in</span></a>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- Script -->

<script src="{{ url('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(function(){
        $('#btnget').on('click', function(){
            window.location.href = "{{ url('/') }}";
        })
    })
</script>
<script src="{{ url('/gc/js/framework7-bundle.min.js') }}"></script>
<script src="{{ url('/gc/js/routes.js') }}"></script>
<script src="{{ url('/gc/js/store.js') }}"></script>
<script src="{{ url('/gc/js/app.js') }}"></script>

</body>
</html>