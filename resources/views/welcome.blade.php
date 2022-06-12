<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{url('backend/jquery.min.js')}}"></script>
</head>

<body class="mx-auto">
    <section class="col-md-8 offset-2 mx-auto m-4">
        <h1>Laravel AJAX CRUD</h1>
    </section>
    <!-- Button trigger modal -->
    <section class="col-md-8 mx-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productname" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Product Price</label>
                                <input type="text" class="form-control" id="productprice">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Product Quantity</label>
                                <input type="text" class="form-control" id="productqty">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="storedata()" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="col-md-8 mx-auto">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        function alldata(){
            $.ajax({
                type: "GET",
                url: "{{route('product.index')}}",
                dataType: "json",

                success: function (response) {
                    let data ="";
                    $.each(response, function (key, value) {
                        data = data + "<tr>"
                            data = data + "<td>"+value.id+"</td>"
                            data = data + "<td>"+value.productname+"</td>"
                            data = data + "<td>"+value.productprice+"</td>"
                            data = data + "<td>"+value.productqty+"</td>"
                            data = data + "<td>"
                                data = data + "<button class='btn btn-primary mr-5'>Edit</button>"
                                data = data + "<button class='btn btn-danger ms-5'>Delete</button>"
                                data = data + "</td>"
                            data= data + "</tr>"
                    });
                    $('tbody').html(data);
                }
            });
        }
        alldata();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        function storedata(){
            let productname = $('#productname').val();
            let productprice = $('#productprice').val();
            let productqty = $('#productqty').val();
            $.ajax({
                type: "POST",
                url: "{{route('product.store')}}",
                data: {productname:productname,productprice:productprice,productqty:productqty},
                dataType: "json",
                success: function (response) {
                    console.log("success");
                }
            });
        }
    </script>
</body>

</html>
