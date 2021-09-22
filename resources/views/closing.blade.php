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
                        <!-- </div> -->
                        <div class="col-md-5">
                            {{-- <div> --}}
                                <button id="closing-button" class="btn btn-primary" onclick="closeDay()"> Close Day </button>
                            {{-- </div> --}}
                        </div>
                        <div class="col-md-6" >
                            <div id="close-date-group">
                                <label for="closedate"> Close Date </label>
                                <input type="date" name="closedate" id="closedate" placeholder="Close Date">
                            </div>
                            <button id="update-closed-button" style="display: none;" class="btn btn-dark" onclick="updateClosed()"> Update Closed Record </button>
                        </div>
                    </div>      
                </div>
                    
                <div class="col-md-4 mt-2">
                    <select class="form-control" name="sales-date" id="sales-date" placeholder="Select Date">
                        <option value="today">Today </option>
                        @foreach ($closingdates as $c)
                            <option value="{{ $c->date }}"> {{ $c->date }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-primary" onclick="xreport()"> Generate X-Report for this date </button>
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

    var loadeddata = {};

    $('select').on('change', function () {
        // alert(this.value);
        updateData(this.value);
        console.log(loadeddata);
        this.value == 'today' ? showclose() : hideclose();
    });
    
    function showclose() {
        $('#closing-button').prop('disabled', false);
        $('#closing-button').text('Close Day');
        $('#close-date-group').show();
    }
    
    function hideclose() {
        $('#closing-button').prop('disabled', true);
        $('#closing-button').text('Closed');
        $('#close-date-group').hide();
    }

    function updateData(date) {
        if(date in loadeddata) {
            let pc = loadeddata[date].products;
            let t = loadeddata[date].total;
            let d = loadeddata[date].discount;

            setAllVals(pc, t, d);

        } else {
            if (date == 'today') {
                getTodays();
            } else {
                getClosed(date);
            }
        }
    }

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


                setLoadedData('today', productsQuantity, total, discounts);
                setAllVals(productsQuantity, total, discounts);

            },
            dataType: 'json'
        });
    }

    function getClosed(date) {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // localstorage.get('token')
        }
        });
        $.ajax({
            type: 'GET',
            url: "{{ url('/closing/closed') }}",
            data: {'date': date},
            success: (response) => {
                console.log(response);

                let productsQuantity = JSON.parse(response.products);
                let total = response.total_sales;
                let discounts = response.total_discount;

                
               
                console.log(productsQuantity);
                console.log(total);
                console.log(discounts);


                setLoadedData(date, productsQuantity, total, discounts);
                setAllVals(productsQuantity, total, discounts);

            },
            dataType: 'json'
        });
    }

    function setLoadedData(date, productsCount, total, discount ) {
        loadeddata[date] = {
            'products': productsCount,
            'total' : total,
            'discount' : discount
        }
    }
    
    function setAllVals(productsCount, total, discount) {
        let table = $('#table')[0];
        table.innerHTML = '';
        let i = 1;
        Object.keys(productsCount).forEach(pname => {
            // var name = 
            let tr = `<tr> <td>${i}</td>
                            <td>${pname}</td>
                            <td> <input class="products-quantity input-none" name="${pname}" type="text" value="${productsCount[pname]}" disabled>  </td>
                        </tr>`;
            table.innerHTML += tr;
            i += 1;
        });
        $('#total-sales').val(total);
        $('#total-discounts').val(discount);
    }



    function closeDay() {
        console.log('closing');
        let prodsObj = {};
        let prods = $(".products-quantity");
        let total = $('#total-sales').val()
        let discount =   $('#total-discounts').val();
        let closedate = $('#closedate').val();

        if (closedate === '') {
            toastr.warning("Please provide a valid date for closing");
            return;
        }

        if (total == '0') {
            toastr.warning('Nothing to Close !!! Make some sales !!');
            return;
        }

        for (let i = 0; i < prods.length; i++) {
            prodsObj[prods[i].name] = prods[i].value;
        }

        let closePayload = {
            'date' : closedate,
            'total-sales': total,
            'total-discounts': discount,
            'products': prodsObj
        }

        console.log(closePayload);

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // localstorage.get('token')
        }
        });

        $.ajax({
            type: 'POST',
            url: "{{ url('/closing/close') }}",
            data: {'data' : JSON.stringify(closePayload)},
            success: () => {
                toastr.success('Closed Successfully');
                // window.location.reload(true);
                window.location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                toastr.warning(`Error : ${textStatus}, ${errorThrown}`);
            } 
        
        });
    }

    function xreport() {
        console.log('closing');
        let prodsObj = {};
        let prods = $(".products-quantity");
        let total = $('#total-sales').val()
        let discount =   $('#total-discounts').val();
        let closedate = $('#sales-date')[0].value;

        if (closedate === 'today' || closedate === '') {
            toastr.warning("Please provide a valid date to put into the report");
            return;
        }

        if (total == '0') {
            toastr.warning('Nothing to add into report !!! Make some sales !!');
            return;
        }

        for (let i = 0; i < prods.length; i++) {
            prodsObj[prods[i].name] = prods[i].value;
        }

        let closePayload = {
            'date' : closedate,
            'total-sales': total,
            'total-discounts': discount,
            'products': prodsObj
        }

        console.log(closePayload);

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // localstorage.get('token')
        }
        });

        $.ajax({
            type: 'POST',
            url: "{{ url('/closing/xreport') }}",
            data: {'data' : JSON.stringify(closePayload)},
            success: () => {
                toastr.success('Closed Successfully');
                // window.location.reload(true);
                window.location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                toastr.warning(`Error : ${textStatus}, ${errorThrown}`);
            } 
        
        });
    }

    function updateClosed() {
        console.log('updating closed');
        let prodsObj = {};
        let prods = $(".products-quantity");
        let total = $('#total-sales').val()
        let discount =   $('#total-discounts').val();
        let closedate = $('#sales-date')[0].value;


        if (total == '0') {
            toastr.warning('Nothing to Close !!! Make some sales !!');
            return;
        }

        for (let i = 0; i < prods.length; i++) {
            prodsObj[prods[i].name] = prods[i].value;
        }

        let closePayload = {
            'date' : closedate,
            'total-sales': total,
            'total-discounts': discount,
            'products': prodsObj
        }

        console.log(closePayload);

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // localstorage.get('token')
        }
        });

        $.ajax({
            type: 'POST',
            url: "{{ url('/closing/update') }}",
            data: {'data' : JSON.stringify(closePayload)},
            success: () => {
                toastr.success('Closed Successfully');
                // window.location.reload(true);
                window.location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                toastr.warning(`Error : ${textStatus}, ${errorThrown}`);
            } 
        
        });
    }

    function showUpdateButton() {
        if( $('select').val() != 'today' ) {
            $('#update-closed-button').show();
        }
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
        showUpdateButton()
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
        showUpdateButton()
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
        showUpdateButton()
    }
    getTodays();    
</script>
@endsection