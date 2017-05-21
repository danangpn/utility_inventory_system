<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/idaStyle.css')}}">
        <title>Laravel</title>
        @yield('styles')
    </head>
    <body>
    <div class="container">
        <div class="col-md-3 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">My Profile</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Name: </strong>{{Auth::user()->lname}}, {{Auth::user()->fname}} {{Auth::user()->mname}}</p>
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="{{route('staff')}}">List</a></li>
                    <li role="presentation"><a href="{{route('logout')}}">Logout</a></li>

                </ul>
            </div>
        </div>
    </div>

    @yield('contents')

    </div>
    </body>
        <script src="{{URL::to('js/jquery.js')}}"></script>
        <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::to('js/jquery.tablesorter.min.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{URL::to('js/table.js')}}"></script>

    @yield('scripts')
</html>
