@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning btn-sm mb-2" href="/product-management">Back to product management</a>
            <h1>New product</h1>
            <form method="POST" action="add" enctype="multipart/form-data">
                @csrf
                <label for="sku">SKU</label>
                <input class="form-control" name="sku" id="sku" type="text">
                <label for="name">Name</label>
                <input class="form-control" name="name" id="name" type="text">
                <label for="shortname">Short name</label>
                <input class="form-control" name="shortname" id="shortname" type="text">
                <label for="fakeprice">Fake price</label>
                <input class="form-control" name="fakeprice" id="fakeprice" type="text">
                <label for="price">Price</label>
                <input class="form-control" name="price" id="price" type="text">
                <label for="thumbnail">Thumbnail</label>
                <input class="form-control" name="thumbnail" id="thumbnail" type="file">
                <label for="hidden">Hidden</label>
                <select class="form-select" name="hidden" id="hidden">
                    <option value="0" selected>No</option>
                    <option value="1">Yes</option>
                </select>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
