@include('base')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/admin">Back to admin panel</a>
            <h1>Product management</h1>
            <div class="border rounded p-3 mb-3">
                <a class="btn btn-primary" href="add">Add new product</a>
            </div>
            <div class="border rounded p-3 mb-3">
                <h4>Search</h4>
                <div class="d-flex justify-content-between" >
                    <div>
                        <label for="search-sku">SKU</label>
                        <input class="form-control me-5" type="text" id="search-sku">
                    </div>
                    <div>

                    <label for="search-name">Name</label>
                    <input class="form-control me-5" type="text" id="search-name">
                    </div>
                        <div>

                    <label for="search-shortname">Short name</label>
                    <input class="form-control me-5" type="text" id="search-shortname">
                        </div>

                    <button class="btn btn-primary btn-search">Search</button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Short name</th>
                    <th>Default price</th>
                    <th>Fake price</th>
                    <th>Thumbnail</th>
                    <th>Hidden</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="body">
                @foreach($products as $product)
                    <tr data-id="{{$product->id}}">
                        <td style="width: 150px"><input  class="form-control" name="SKU" type="text" value="{{$product->SKU}}"></td>
                        <td><input class="form-control" type="text" name="name" value="{{$product->name}}"></td>
                        <td style="width: 150px"><input  class="form-control" name="short_name" type="text" value="{{$product->short_name}}"></td>
                        <td style="width: 150px"><input  class="form-control" name="price" type="text" value="{{$product->price}}"></td>
                        <td style="width: 150px" ><input class="form-control" name="fake_price" type="text" value="{{$product->fake_price}}"></td>
                        <td style="width: 150px">
                                <img style="border-width: 1px; border-style: solid" width="40px" src="/storage/{{$product->avatar_url}}">
                            <span>
                            <a style="text-decoration: none" href="edit-thumbnail/{{$product->id}}">Change</a>
                            </span>
                        </td>
                        <td style="width: 100px">
                            <select name="hidden" class="form-select">
                                <option @if($product->hidden == 1) selected @endif value="1">Yes</option>
                                <option @if($product->hidden == 0) selected @endif value="0">No</option>
                            </select>
                        </td>
                        <td style="width: 110px">
                            <a href="product-management/product-colors/{{$product->id}}" class="btn btn-warning btn-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                                Colors
                            </a>
                        </td>
                        <td style="width: 110px">
                            <a href="product-management/product-sizes/{{$product->id}}" class="btn btn-info btn-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                                Sizes
                            </a>
                        </td>
                        <td style="width: 100px"><button type="button" class="btn btn-primary btn-save">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"></path>
                                </svg>
                                Save
                            </button></td>
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
        </div>

    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-save').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var row = $(this).parents("tr");
        save(row)
    })

    $('.btn-delete').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var row = $(this).parents("tr");
        purge(row)
    })

    $('.btn-search').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var sku = $("#search-sku").val()
        var name = $("#search-name").val()
        var shortname = $("#search-shortname").val()

        $.ajax({
            method: "POST",
            url: "/admin/product-management/search",
            data: {sku:sku,name:name,shortname:shortname}
        }).done(function (data){
            console.log(data)
            $(".body").empty();
            data.forEach(function (key){
                $(".body").append("<tr data-id='" + key.id + "'>\
                    <td style='width: 150px'><input  class='form-control' name='SKU' type='text' value='" + key.SKU + "'></td>\
                    <td><input class='form-control' type='text' name='name' value='" + key.name + "'></td>\
                    <td style='width: 150px'><input  class='form-control' name='short_name' type='text' value='" + key.short_name + "'></td>\
                    <td style='width: 150px'><input  class='form-control' name='price' type='text' value='" + key.price + "'></td>\
                    <td style='width: 150px' ><input class='form-control' name='fake_price' type='text' value='" + key.fake_price + "'></td>\
                    <td style='width: 150px'>\
                        <img style='border-width: 1px; border-style: solid' width='40px' src='/storage/" + key.avatar_url + "'>\
                            <span>\
                            <a style='text-decoration: none' href='edit-thumbnail/" + key.id + "'>Change</a>\
                            </span>\
                    </td>\
                    <td style='width: 100px'>\
                        <select name='hidden' value='" + key.hidden + "' class='form-select'>\
                            <option value='1'>Yes</option>\
                            <option value='0'>No</option>\
                        </select>\
                    </td>\
                    <td style='width: 100px'><button type='button' class='btn btn-primary btn-save'>\
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-save' viewBox='0 0 16 16'>\
                            <path d='M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z'></path>\
                        </svg>\
                        Save\
                    </button></td>\
                    <td style='width: 110px'>\
                        <button type='button' class='btn btn-outline-danger btn-delete'>\
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>\
                                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'></path>\
                                <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'></path>\
                            </svg>\
                            Delete\
                        </button>\
                    </td>\
                </tr>")
            })
            //console.log(json_encode(data))
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    })

    function save(row)
    {
        var id = $(row).attr('data-id')
        var SKU = $(row).find('input[name=SKU]').val()
        var name = $(row).find('input[name=name]').val()
        var short_name = $(row).find('input[name=short_name]').val()
        var price = $(row).find('input[name=price]').val()
        var fake_price = $(row).find('input[name=fake_price]').val()
            var select = $(row).find('select[name=hidden]')
        var hidden = $(select).find(':selected').val()

        $.ajax({
            method: "POST",
            url: "/admin/product-management/save",
            data: {id:id, SKU:SKU,name:name,short_name:short_name,price:price,fake_price:fake_price,hidden:hidden}
        }).done(function (data){
            console.log(data)
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    }

    function purge(row)
    {
        var id = $(row).attr('data-id')

        $.ajax({
            method: "POST",
            url: "/admin/product-management/delete",
            data: {id:id}
        }).done(function (data){
            console.log(data)
            $(row).hide();
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    }
</script>
