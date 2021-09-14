@extends('shared')

@section('css')
<style>
.ml30 {
    margin-left: 30px;
}
ul {
    list-style-type: none;
}
.input-none {
    border-top-style: hidden;
  border-right-style: hidden;
  border-left-style: hidden;
  border-bottom-style: hidden;
    outline: none;
}
input[type="text"] {
             display: block;
             margin : 0 auto;
        }
.panel{
    width: 70%;
    font-size: 48px;
    text-align-last: center;
    text-emphasis: bold;
}
</style>

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
                    <li>Closing</li>
                </ul>
                <h4>Closing</h4>
            </div>
        </div><!-- media -->  
    </div><!-- pageheader -->
    <div class="contentpanel">
        <div class="heading" style="margin-bottom: 30px;">
          <div class="container-fluid" align="center">
            <div class="row">
                <div class="col-md-4">
                     <div class="row">
                       <div class="col-md-1">
                        </div>
                        <!-- </div> -->
                        <div class="col-md-10">
                            {{-- <div> --}}
                                <button class="btn btn-primary" onclick=""> Close Day </button>
                            {{-- </div> --}}
                        </div>
                    </div>      
                </div>
                    
                <div class="col-md-4 mt-2">
                    <select class="form-control" name="sales-date" id="sales-date" placeholder="Select Date">
                        <option value="">Today </option>
                    </select>
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-primary" onclick="getXreport()"> Generate X-Report for this date </button>
                </div>
        </div>
        
        <div style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-6">
                    <center><h1 style="font-size: 26px; font-style: bold;">Products Sold</h1></center>
                    <div class="table-responsive mt-4">
                        <table class="table table-dark mb30">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>quantity</th>
                                {{-- <th>Discount</th>
                                <th>Status</th>
                                <th>Action</th> --}}
                              </tr>
                
                            </thead>
                            <tbody id="table">
                                <tr>
                                    <td>1</td>
                                    <td>Fries Simple</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Loaded Fries Simple</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Loaded Fries Cheese</td>
                                    <td>10</td>
                                </tr>
                            </tbody>    
                        </table>
                    </div><!-- table-responsive -->
                </div>
                <div class="col-md-6 mt20">
                    <ul>
                        <li class="list-group">
                            <div class="ml30 mr30 mb10 panel panel-default">
                                <div class=" mb10 panel-heading">Gross Total</div>
                                <div class="ml30 mr30 mb10 panel-body text-center" id="gross-sales">
                                    <center><input id="total-sales" class="input-none "  type="text" value="-" disabled></center>
                                </div>
                            </div>
                            {{-- </div> --}}
                        </li>
                        <li>
                            <div class="ml30 mt20 mr30 mb10 panel panel-default">
                                <div class=" mb10 panel-heading">Total Discounts</div>
                                <div class="ml30 mr30 mb10 panel-body" >
                                    <center><input id="total-discounts" class="input-none"  type="text" value="-" disabled></center>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>    
        </div>
        <div class="row mt20">
            <div class="col-md-6 mt20">
                <center><button id="update-products-button" class="btn btn-primary" onclick="enableEditQuantity()">Update Products</button></center>
                <center><button id="save-products" style="display: none" class="btn btn-danger" onclick="saveQuantity()">Save Product Quantities</button></center>
            </div>
            <div class="col-md-6 mt20"> 
                <div class="row">
                    <div class="col-md-6">
                        <center><button id="update-total" onclick="enableEditTotal()" class="btn btn-primary">Update Total</button></center>
                        <center><button id="save-total" style="display: none" class="btn btn-danger" onclick="saveTotal()">Save Total</button></center>
                    </div>
                    <div class="col-md-6">
                        <center><button id="update-discount" onclick="enableEditDiscount()" class="btn btn-primary">Update Discount</button></center>
                        <center><button id="save-discount" style="display: none" class="btn btn-danger" onclick="saveDiscount()">Save Discount</button></center>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- contentpanel --}}
</div> {{--! mainpanel  --}}
@endsection

@section('js')
<script>
    function getTodays() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // localstorage.get('token')
        }
        });
        $.ajax({
            type: 'GET',
            url: "{{ url('/closing/unclosed') }}",
            success: (response) => {
                console.log(response);

                let productsQuantity = {};
                let total = 0;
                let discounts = 0;

                if(response.length > 0) {
                    response.forEach(sale => {
                        // get products and add their quantity to 
                        sale.products.forEach(product => {
                            let quant, price;
                            if( product.name in productsQuantity) {
                                productsQuantity[product.name] += parseInt(product.pivot.quantity);
                                quant = parseInt(product.pivot.quantity);
                                price = parseInt(product.pivot.price);
                            } else {
                                productsQuantity[product.name] = parseInt(product.pivot.quantity);
                                quant = parseInt(product.pivot.quantity);
                                price = parseInt(product.pivot.price);
                            }
                            // update total
                            total += quant * price;
                        });
                        // update discount
                        discounts += parseInt(sale.discount);
                    });
                } else {
                    // handle this case
                    // hide content Panel
                } 

                console.log(productsQuantity);
                console.log(total);
                console.log(discounts);

                setAllVals(productsQuantity, total, discounts);
            },
            dataType: 'json'
        });
    }

    
    function setAllVals(productsCount, total, discount) {
        let table = $('#table')[0];
        table.innerHTML = '';
        let i = 1;
        Object.keys(productsCount).forEach(pname => {
            let tr = `<tr> <td>${i}</td>
                            <td>${pname}</td>
                            <td> <input class="products-quantity input-none"  type="text" value="${productsCount[pname]}" disabled>  </td>
                        </tr>`;
            table.innerHTML += tr;
            i += 1;
        });
        $('#total-sales').val(total);
        $('#total-discounts').val(discount);
    }

    function enableEditQuantity() {
        $('.products-quantity').prop('disabled', false);
        $('.products-quantity').removeClass('input-none');
        $('#update-products-button').hide();
        $('#save-products').show();
    }

    function saveQuantity() {
        $('.products-quantity').prop('disabled', true);
        $('.products-quantity').addClass('input-none');
        $('#update-products-button').show();
        $('#save-products').hide();
    }

    function enableEditTotal() {
        $('#total-sales').prop('disabled', false);
        $('#total-sales').removeClass('input-none');
        $('#update-total').hide();
        $('#save-total').show();
    }

    function saveTotal() {
        $('#total-sales').prop('disabled', true);
        $('#total-sales').addClass('input-none');
        $('#update-total').show();
        $('#save-total').hide();
    }

    function enableEditDiscount() {
        $('#total-discounts').prop('disabled', false);
        $('#total-discounts').removeClass('input-none');
        $('#update-discount').hide();
        $('#save-discount').show();
    }

    function saveDiscount() {
        $('#total-discounts').prop('disabled', true);
        $('#total-discounts').addClass('input-none');
        $('#update-discount').show();
        $('#save-discount').hide();
    }
    getTodays();    
</script>
@endsection