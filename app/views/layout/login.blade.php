<!DOCTYPE html>

<html lang="en">

<head>
    @include('base.head')
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom" style="background-color:#F0F0F0">
<div id="main" class="container">
@include('base.nav')
@yield('content')
@include('js.login')
</div>
</body>

</html>
