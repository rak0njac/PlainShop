@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Product colors for {{$product->name}}</h1>
            @foreach($product->colors as $color)
                <label class="color-label ms-2">
                    <span class="color-span" style="background: #{{$color->hex}};"> Hex: {{$color->hex}}</span>
                </label>
            @endforeach
            Add new color
            <a href="https://g.co/kgs/kjhy2w"></a>
            <form method="POST" action="add">
                @csrf
                <input type="hidden" name="product" value="{{$product->id}}">
                <label class="form-label" for="hex">Hex</label>
                <input type="text" id="hex" name="hex" class="form-control">
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
