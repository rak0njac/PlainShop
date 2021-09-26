@include('base')


        <div class="container">
            <div class="row row-cols-4">
                    @foreach($products as $product)
                        <a class="text-decoration-none text-muted" href="/product/{{$product->short_name}}">
                            <div class="col text-center">
                                <img class="img-fluid img-thumbnail" src="/storage/{{$product->avatar_url}}"><br>
                                <h5>{{$product->name}}</h5>
                                <del>{{$product->fake_price}}</del>
                                <h3>{{$product->price}}</h3>
                                <br><br>
                            </div>
                        </a>
                    @endforeach
            </div>
        </div>
