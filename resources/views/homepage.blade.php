@include('base')


        <div class="container">
            <div class="row row-cols-4">
                    @foreach(\App\Models\Product::all() as $item)
                        <a class="text-decoration-none" href="/product/{{$item->short_name}}">
                            <div class="col text-center">
                                <img class="img-fluid img-thumbnail" src="/img/avatars/{{$item->avatar_url}}"><br>
                                <h5>{{$item->name}}</h5>
                                <del>{{$item->fake_price}} kn</del>
                                <h3>{{$item->price}} kn</h3>
                                <br><br>
                            </div>
                        </a>
                    @endforeach
            </div>
        </div>
