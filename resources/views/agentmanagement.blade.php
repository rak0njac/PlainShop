@include('base')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>Agent management</h1>
            <div class="border rounded p-3 mb-3">
                <a class="btn btn-primary" href="/agent-management/add">Add new agent</a>
            </div>
            <div class="border rounded p-3 mb-3">
                <h4>Search</h4>
                <div class="d-flex justify-content-between" >
                    <div>
                        <label for="search-email">Email</label>
                        <input class="form-control me-5" type="text" id="search-email">
                    </div>
                    <div>
                        <label for="search-name">Name</label>
                        <input class="form-control me-5" type="text" id="search-name">
                    </div>

                    <button class="btn btn-primary btn-search">Search</button>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="body">
                @foreach($agents as $agent)
                    <tr data-id="{{$agent->id}}">
                        <td><input class="form-control" name="email" type="email" value="{{$agent->email}}"></td>
                        <td><input  class="form-control" name="name" type="text" value="{{$agent->name}}"></td>
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

    function save(row)
    {
        var id = $(row).attr('data-id')
        var email = $(row).find('input[name=email]').val()
        var name = $(row).find('input[name=name]').val()

        $.ajax({
            method: "POST",
            url: "/agent-management/save",
            data: {id:id, email:email,name:name}
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
            url: "/agent-management/delete",
            data: {id:id}
        }).done(function (data){
            console.log(data)
            $(row).hide();
            $("#spinner-back").removeClass('show')
            $("#spinner-front").removeClass('show')
        })
    }

    $('.btn-search').click(function (){
        $("#spinner-back").addClass('show')
        $("#spinner-front").addClass('show')

        var name = $("#search-name").val()
        var email = $("#search-email").val()

        $.ajax({
            method: "POST",
            url: "/agent-management/search",
            data: {name:name,email:email}
        }).done(function (data) {
            console.log(data)
            $(".body").empty();
            data.forEach(function (key) {
                $(".body").append("<tr data-id='" + key.id +"'>\
                <td><input class='form-control' name='email' type='email' value='" + key.email +"'></td>\
                <td><input  class='form-control' name='name' type='text' value='" + key.name +"'></td>\
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

</script>
