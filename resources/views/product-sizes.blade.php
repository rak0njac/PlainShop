@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/product-management">Back to product management</a>
            <h1>Product sizes for {{$product->name}}</h1>
            <div class="border rounded p-3">
                Add new size
                <a href="https://g.co/kgs/kjhy2w"></a>
                <form method="POST" action="add">
                    @csrf
                    <input type="hidden" name="product" value="{{$product->id}}">
                    <label class="form-label" for="size">Size</label>
                    <input type="text" id="size" name="size" class="form-control">
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Size</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="body">
                @foreach($product->sizes as $size)
                    <tr data-id="{{$size->id}}">
                        <td>{{$size->name}}</td>
                        <td style="width: 110px">
                            <button type="button" class="btn btn-outline-danger btn-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

{{--        @foreach($product->colors as $color)--}}
{{--                <div>--}}
{{--                    <label class="color-label ms-2">--}}
{{--                        <span class="color-span" style="background: #{{$color->hex}};"></span>--}}
{{--                    </label>--}}
{{--                    Hex: {{$color->hex}}--}}
{{--                </div>--}}
{{--            @endforeach--}}

        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-delete').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var row = $(this).parents("tr");
        purge(row)
    })

    function purge(row)
    {
        var id = $(row).attr('data-id')

        $.ajax({
            method: "POST",
            url: "/product-management/product-sizes/delete",
            data: {id:id}
        }).done(function (data){
            console.log(data)
            $(row).hide();
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    }
</script>
