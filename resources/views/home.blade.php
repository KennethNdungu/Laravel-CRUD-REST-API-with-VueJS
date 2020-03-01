<!DOCTYPE html>
<head>
    <title>Solutech API</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

 <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div id="app" > 
        <div class="row">
            <div class="col-md-4" style="border:solid 2px">
                <Product></Product>
            </div>
            <div class="col-md-4" style="border:solid 2px">
                <Order></Order>
            </div>
            <div class="col-md-4" style="border:solid 2px">
                <Supplier></Supplier>
            </div>
        </div>
        
        
        
        

    </div>
    
</body>
</html>