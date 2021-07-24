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
{{--                        <img class="d-block w-100" src="/img/avatars/{{$product->avatar_url}}" alt="First slide">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class="d-block w-100" src="/img/avatars/{{$product->avatar_url}}" alt="Second slide">--}}
{{--                    </div>--}}
{{--                    <div class="carousel-item">--}}
{{--                        <img class="d-block w-100" src="/img/avatars/{{$product->avatar_url}}" alt="Third slide">--}}
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
{{--            <img class="img-fluid img-thumbnail" width="500px" height="500px" src="/img/avatars/{{$product->avatar_url}}">--}}
                        <div class="card">
                            <div class="d-flex flex-column thumbnails">
                                <div id="f1" class="tb tb-active"> <img class="thumbnail-img fit-image" src="/img/avatars/digicam.webp"> </div>
                                <div id="f2" class="tb"> <img class="thumbnail-img fit-image" src="/img/avatars/hallux.webp"> </div>
                                <div id="f3" class="tb"> <img class="thumbnail-img fit-image" src="/img/avatars/mega-style.webp"> </div>
                                <div id="f4" class="tb"> <img class="thumbnail-img fit-image" src="/img/avatars/smily.webp"> </div>
                            </div>
                            <fieldset id="f11" class="active">
                                <div class="product-pic"> <img class="pic0" src="/img/avatars/digicam.webp"> </div>
                            </fieldset>
                            <fieldset id="f21" class="">
                                <div class="product-pic"> <img class="pic0" src="/img/avatars/hallux.webp"> </div>
                            </fieldset>
                            <fieldset id="f31" class="">
                                <div class="product-pic"> <img class="pic0" src="/img/avatars/mega-style.webp"> </div>
                            </fieldset>
                            <fieldset id="f41" class="">
                                <div class="product-pic"> <img class="pic0" src="/img/avatars/smily.webp"> </div>
                            </fieldset>
                        </div>
        </div>
        <div class="col">
                <h1>{{$product->name}}</h1>
                <br>
                Short description of product
                <br><br>
                <del>{{$product->fake_price}} kn</del>
                <h2>{{$product->price}} kn</h2>
                <br>
            <form method="post" action="/updatecart">
                @csrf
                <input type="hidden" name="product" value="{{$product->id}}">
            @if($color->count() != 0)
                    <div class="d-flex align-items-center">
                        <span class="me-2">Color:</span>
                        @foreach($color as $c)
                            <input class="color-radio" type="radio" name="color" value="{{$c->id}}" id="{{$c->hex}}" />
                            <label class="color-label" for="{{$c->hex}}">
                                <span class="color-span" style="background: #{{$c->hex}};"></span>
                            </label>
                        @endforeach
                    </div>
                    <br>
                @endif
                @if($size->count() != 0)
                    <div class="d-flex align-items-center">
                        <span class="me-2">Size:</span>
                        @foreach($size as $s)
                            <input type="radio" name="size" value="{{$s->id}}" id="{{$s->name}}">
                            <label style="font-weight: bold" class="me-2" for="{{$s->name}}">{{$s->name}}</label>
                        @endforeach
                    </div>
                    <br>
                @endif
                <div class="d-flex align-items-center">
                    <label for="quantity">Quantity:</label>
                    <input class="ms-2" type="number" min="1" style="width: 40px" id="quantity" name="quantity" value="1">
                </div>
                <br>
                <input type="submit" class="btn btn-warning btn-lg" value="Add to cart">
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){

        $(".tb").hover(function(){

            $(".tb").removeClass("tb-active");
            $(this).addClass("tb-active");

            current_fs = $(".active");

            next_fs = $(this).attr('id');
            next_fs = "#" + next_fs + "1";

            $("fieldset").removeClass("active");
            $(next_fs).addClass("active");

            current_fs.animate({}, {
                step: function() {
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        });

    });
</script>
