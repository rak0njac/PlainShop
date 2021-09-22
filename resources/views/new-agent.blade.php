@include('base')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>New agent</h1>
            <form method="POST" action="add">
                @csrf
                <label for="email">Email</label>
                <input class="form-control" name="email" id="email" type="email">
                <label for="name">Name</label>
                <input class="form-control" name="name" id="name" type="text">
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
</div>
