@extends('shared')

@section('pageContent')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-th-list"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Products</li>
                </ul>
                <h4>Products</h4>
            </div>
        </div><!-- media -->

    </div><!-- pageheader -->
    @if(isset($success))
    <div class="alert alert-success">
        {{ $success }}
    </div>
    @endif
    <div class="contentpanel">
        <div class="heading" style="margin-bottom: 30px;">
            <div align="center">
                <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"> Add
                    Product</button>
            </div>
        </div>
        <div class="table-responsive mt-4">
            <table class="table table-dark mb30">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->price }}</td>
                        <td>{{ $p->category }} </td>
                        <td> <img onclick="getItems('{{ $p->id }}')" style="margin-right: 10px" src="css/icons/list.svg"
                                width="25" alt="list items"> <img style="margin-right: 10px"
                                src="css/icons/solid/edit.svg" width="15" alt=""> <img
                                onclick="cancelSale('${d.sale_id}')" src="css/icons/trash.svg" alt="cancel sale"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- table-responsive -->


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">Add Product</h4>
                    </div>
                    <div class="modal-body">

                        <form class="form-inline" method="POST" action="{{ url('/products')}}">
                            @csrf
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Product Name</label>
                                <input type="text" class="form-control" name="productname" id="exampleInputEmail2"
                                    placeholder="Product Name">
                            </div><!-- form-group -->

                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Price</label>
                                <input type="number" class="form-control" name="price" id="exampleInputPassword2"
                                    placeholder="Unit Price">
                            </div><!-- form-group -->
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Category</label>
                                <select name="category" id="">
                                    <option value="main-course"> Main Course</option>
                                    <option value="soft-drinks"> Soft Drinks </option>
                                </select>
                            </div><!-- form-group -->
                            <div class="form-group">
                                <label class="sr-only">Items </label>

                                @foreach($items as $i)
                                <div>
                                    <label>
                                        <input type="number" name="{{$i->name}}" step="0.001"
                                            placeholder="{{$i->name}}">
                                        {{ $i->name }}
                                    </label>
                                </div>

                                @endforeach
                            </div><!-- form-group -->
                            <button type="submit" class="btn btn-primary mr5">Add</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-secondry mr5">Update</button> --}}

                    </div>
                </div>
            </div>
        </div>
            <!-- begin product items modal -->
            <div id="items-modal" class="modal fade" tabindex="" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                            <h4 class="modal-title">Items</h4>
                        </div>
                        <div id="items-modal-body" class="modal-body">

                            jey akldnakldnaskldnaskld
                        </div>
                        <div class="modal-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- End product items modal -->

        
    </div>
</div>
    @endsection


    @section('js')
    <script>
        function getItems(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ url('/products/items') }}",
                data: {
                    'productid': id
                },
                success: (response) => {
                    console.log(response);

                    var data = '<table class="table"> <thead> <tr> <th>Item Name </th> <th> Units Consumed </th> <th> Warning Cound </th> </tr>  </thead>';
                    data +=  `<tbody class="table"> `;

                    response.forEach(r => {
                      data +=  `<tr> <td> ${r.name} </td> <td>${r.pivot.unit_consumed}</td> <td>${r.warning_quantity} </td> </tr> `;
                    });

                    data += "</tbody> </table>";

                    $('#items-modal-body')[0].innerHTML = data;
                    $('#items-modal').modal('show');
                },
                dataType: 'json'
            });
        }

    </script>
    @endsection
