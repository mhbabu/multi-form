<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('meta')

    <title>{{ env('APP_NAME','Docusign') }} </title>

    <!-- Font Awesome Icons -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets/backend/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {!! Html::style('/assets/backend/plugins/fontawesome-free/css/all.min.css') !!}
    {!! Html::style('/assets/backend/plugins/toaster/css/toaster.min.css') !!}
    {!! Html::style('/assets/backend/dist/css/adminlte.min.css') !!}
    {!! Html::style('/assets/backend/dist/css/custom.css') !!}
    {!! Html::style('/assets/backend/plugins/sweet-alert/css/sweetalert.min.css') !!}
    @yield('header-css')
</head>

<body class="hold-transition login-page">
    <section class="content my-4">
        <div class="container-fluid">
            @include('layouts.includes.messages')
            @yield('content')
        </div>
        <!--/. container-fluid -->
    </section>

<!-- REQUIRED SCRIPTS -->
{!! Html::script('/assets/backend/plugins/jquery/jquery.min.js') !!}
{!! Html::script('/assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
{!! Html::script('/assets/backend/plugins/toaster/js/toaster.min.js') !!}
{!! Html::script('/assets/backend/dist/js/adminlte.js') !!}
{!! Html::script('/assets/backend/plugins/sweet-alert/js/sweetalert.min.js') !!}
{!! Html::script('/assets/backend/plugins/jquery/jquery.validate.min.js') !!}

{!! Toastr::message() !!}

@yield('footer-script')
</body>

</html>
