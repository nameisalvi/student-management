<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Student Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
</head>
<body>
    <div class="container">
        <div>
            <a href="student" class="btn">Students</a>
            <a href="mark" class="btn">Marks</a>
        </div>
        <br>
        
    @yield('content')
    </div>

    <script src="{{asset('js/jquery-3.6.0.min.js')}}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
    @php $baseUrl = env('APP_URL'); @endphp
    <script>
        window.baseUrl = <?php echo json_encode($baseUrl) ?>;
    </script>
    <script src="{{asset('js/script.js')}}" ></script>
</body>
</html>