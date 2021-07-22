<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PlainShop - Dobro došli!</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/color-chooser.css" rel="stylesheet">
<style>
</style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-5">
    <div class="col ">
        <a class="navbar-brand d-flex align-items-center" href="{{url('/')}}">
            <img style="margin-left: 10px; margin-right: 10px;" src="/img/logo" width="50px" height="50px">
            <span class="navbar-text" style="font-family: Impact; font-style: italic; font-size:30px; color: white;">PlainShop</span>
        </a>
    </div>
    <div class="col d-flex justify-content-center">
        <form class="form-inline ">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col d-flex justify-content-end me-3">
        <a class="d-flex align-items-center text-decoration-none">
            <img style="margin-left: 10px; margin-right: 10px;" src="/img/cart.png" width="50px" height="50px">
            <span style="color: white; font-size: 24px;">Cart</span>
        </a>
    </div>
</nav>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
