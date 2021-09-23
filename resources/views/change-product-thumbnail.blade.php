@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/product-management">Back to product management</a>
            <h1>Change thumbnail for {{$product->name}}</h1>
            <img style="border-style: solid" width="500" height="500" src="/storage/{{$product->avatar_url}}"/>
            <form method="POST" action="save" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product" value="{{$product->id}}">
                <input type="file" name="file" accept=".jpg,.bmp,.png,.webp" class="form-control">
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
