<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
           
        }
        .offline-container {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
           
        }
        .offline-image {
            width: 75px;
            margin-bottom: 20px;
        }
     
    </style>
</head>
<body>
    <div class="offline-container">
        <img src="{{ asset('assets/images/offline.png') }}" class="offline-image opacity-25" alt="Offline">
        <h1>Você está offline</h1>
  
        <p class="text-muted fs-5" >Verifique sua conexão com a internet e tente novamente.</p>
        <a href="{{ route('home') }}" class="btn btn-primary fs-6"><i class="fa fa-refresh"></i> Tentar novamente</a>
    </div>



    	<!--**********************************
	Scripts
	***********************************-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.min.js') }}"></script>
	<script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>
	<script src="{{ asset('assets/js/layout-dark.js') }}"></script>
	<script src="{{ asset('assets/js/layout-compact-nav.js') }}"></script>
	<script rel="manifest" href="{{ asset('manifest.json') }}"></script>
</body>
</html>
