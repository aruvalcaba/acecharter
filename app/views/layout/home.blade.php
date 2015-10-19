<!DOCTYPE html>

<html lang="en">

<head>
@include('base.head')
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom"  style="background-color:#F0F0F0">
@include('base.nav')
<div id="main" class="container">
@yield('content')
@include('js.home')
</div>
@include('base.footer')
</body>
</html>
