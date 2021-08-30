@extends('shared')

@section('css')
        <link href="css/bootstrap.min.css" rel="stylesheet">

@endsection

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
                  <li>Sales</li>
              </ul>
              <h4>Sales</h4>
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
      <div class="container" align="center">
        <div class="col-md-4">
          <!-- <select class="form-control" name="sales-date" id="sales-date" placeholder="Select Date"></select> -->
          <h4> Gross Sales : <span id="gross-sales"> </span> </h4>
        </div>  
        <div class="col-md-4">
            <select class="form-control" name="sales-date" id="sales-date" placeholder="Select Date"></select>
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"> Generate X-Report for this date </button>
      </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-dark mb30">
            <thead>
              <tr>
                <th>#</th>
                <th>Sales Id</th>
                <th>Total</th>
                <th>Discount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>

            </thead>
            <tbody id="table">
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
                <input type="text" class="form-control"  name="productname" id="exampleInputEmail2" placeholder="Product Name">
            </div><!-- form-group -->
            
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Price</label>
                <input type="number" class="form-control" name="price" id="exampleInputPassword2" placeholder="Unit Price">
            </div><!-- form-group -->
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Category</label>
                <select name="category" id="">
                  <option value="main-course"> Main Course</option>
                  <option value="soft-drinks"> Soft Drinks </option>
                </select>  
            </div><!-- form-group -->
            <div class="form-group">
                <label class="sr-only" >Items </label>

               
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

    
    <!-- 
     -->
            <!-- begin product items modal -->
    <div id="products-modal" class="modal fade" tabindex="" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title">Items</h4>
                </div>
                <div id="products-modal-body" class="modal-body">

                    jey akldnakldnaskldnaskld
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

  </div>


@endsection 
    

@section('js')

<script>

var sales = {!! json_encode( $sales->toArray() )  !!};
console.log(sales);
var dates = Object.keys(sales);
console.log(dates);

var dateSelect = $('#sales-date')[0];
dates.forEach((date, idx, _) => {
    console.log('i = '+idx+' idx = ');
    var option = document.createElement('option');
    option.value = date;
    option.innerHTML = date;
    if(idx == dates.length-1) {
        option.selected = true;
        console.log(idx+" - "+date);
    }
    dateSelect.appendChild(option);
});

$('select').on('change', function () {
    // alert(this.value);
    updateTable(this.value);
});

function updateTable(date) {
    
    var data = sales[date];
    var table = $('#table')[0];
    table.innerHTML = "";
    data.forEach((d, i, _) => {
        var t = `<tr onclick="getProducts('${d.sale_id}')" > <td> ${i+1} </td>  <td> ${d.sale_id} </td> <td> ${d.total_amount} </td><td> ${d.discount} </td>`;

        if(d.deleted_at ==  null) {
            t += ` <td style="color:green"> Clear  </td> `;
            t += ` <td> <img onclick="cancelSale('${d.sale_id}')" src="css/icons/trash.svg" alt="cancel sale">  </td> `;
        } else {
            t += ` <td style="color:red"> Cancelled  </td> `;
            t += ` <td> <img onclick="undoCancelSale('${d.sale_id}')" width="15" src="css/icons/solid/redo.svg" alt="undo cancel sale">  </td> `;

        }
        
        t += "</tr>";

        table.innerHTML += t;
    });
}

function cancelSale(id) {
    console.log("Canceling sale id: "+id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "{{ url('/sales/cancel') }}",
        data: {'saleid': id},
        success: () => {
            window.location.reload(true);
        }
    });
}

function undoCancelSale(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "{{ url('/sales/cancel/undo') }}",
        data: {'saleid': id},
        success: () => {
            window.location.reload(true);
        }
    });
}

function getProducts(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // localstorage.get('token')
        }
    });
    $.ajax({
        type: 'GET',
        url: "{{ url('/sales/products') }}",
        data: {
            'saleid': id
        },
        success: (response) => {
            console.log(response);

            var data = '<table class="table"> <thead> <tr> <th>Product Name </th> <th> Quantity </th> <th> Price </th> </tr>  </thead>';
            data +=  `<tbody class="table"> `;

            response.forEach(r => {
                data +=  `<tr> <td> ${r.name} </td> <td>${r.pivot.quantity}</td> <td>${r.pivot.price} </td> </tr> `;
            });

            data += "</tbody> </table>";

            $('#products-modal-body')[0].innerHTML = data;
            $('#products-modal').modal('show');
        },
        dataType: 'json'
    });
}

updateTable($('select')[0].value);
</script>
@endsection