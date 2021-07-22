@include('base')

<div class="container">
    <div class="row">
        <div class="col">
{{--            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">--}}
{{--                <ol class="carousel-indicators">--}}
{{--                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>--}}
{{--                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>--}}
{{--                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>--}}
{{--                </ol>--}}
{{--                <div class="carousel-inner">--}}
{{--                    <div class="carousel-item active">--}}
{{--                        <img class="d-block w-100" src="..." alt="First slide">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class="d-block w-100" src="..." alt="Second slide">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class="d-block w-100" src="..." alt="Third slide">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
{{--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Previous</span>--}}
{{--                </a>--}}
{{--                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
{{--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                    <span class="sr-only">Next</span>--}}
{{--                </a>--}}
{{--            </div>--}}
            <img class="img-fluid img-thumbnail" width="500px" height="500px" src="/img/avatars/{{$product->avatar_url}}">
        </div>
        <div class="col">
            <h1>{{$product->name}}</h1>
            <br>
            Short description of product
            <br><br>
            <del>{{$product->fake_price}} kn</del>
            <h2>{{$product->price}} kn</h2>
            <br>
            <div class="d-flex align-items-center">
                <span class="me-2">Color:</span>
                @foreach($color as $color)
                    <input type="radio" name="color" id="{{$color->hex}}" />
                    <label for="{{$color->hex}}"><span style="background: #{{$color->hex}};"></span></label>
                @endforeach
            </div>
        </div>
    </div>
</div>
