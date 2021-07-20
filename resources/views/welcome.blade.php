<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PlainShop - Dobro došli!</title>

        <!-- Fonts -->

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <h1>Dobro došli!</h1>


        <div class="container">
            <div class="row row-cols-4">
                    @foreach(\App\Models\Product::all() as $item)
                        <div class="col text-center">
                            <img class="img-fluid img-thumbnail" src="/img/avatars/{{$item->avatar_url}}"><br>
                            <h5>{{$item->name}}</h5>
                            <del>{{$item->fake_price}} kn</del>
                            <h3>{{$item->price}} kn</h3>
                            <br><br>
                        </div>
                    @endforeach
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
</html>
