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
      <div class="container-fluid" align="center">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Gross Total</div>
                                <div class="panel-body" id="gross-sales">
                                    Panel content
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Total Discount</div>
                                <div class="panel-body" id="discount">
                                    discount
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
                
            <div class="col-md-4 mt-2">
                <select class="form-control" name="sales-date" id="sales-date" placeholder="Select Date"></select>
            </div>
            <div class="col-md-4 mt-4">
                <button class="btn btn-primary" onclick="getXreport()"> Generate X-Report for this date </button>
            </div>
            
        </div>
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
    let samount = 0;
    let disc = 0;
    var data = sales[date];
    var table = $('#table')[0];
    table.innerHTML = "";
    data.forEach((d, i, _) => {
        
        var t = `<tr onclick="getProducts('${d.sale_id}')" > <td> ${i+1} </td>  <td> ${d.sale_id} </td> <td> ${d.total_amount} </td><td> ${d.discount} </td>`;

        if(d.deleted_at ==  null) {
            samount = samount + parseInt(d.total_amount);
            disc = disc + parseInt(d.discount);
            t += ` <td style="color:green"> Clear  </td> `;
            t += ` <td> <img onclick="cancelSale('${d.sale_id}')" src="css/icons/trash.svg" alt="cancel sale">  </td> `;
        } else {
            t += ` <td style="color:red"> Cancelled  </td> `;
            t += ` <td> <img onclick="undoCancelSale('${d.sale_id}')" width="15" src="css/icons/solid/redo.svg" alt="undo cancel sale">  </td> `;

        }
        
        t += "</tr>";

        table.innerHTML += t;
    });
    $('#gross-sales')[0].innerText = samount;
    $('#discount')[0].innerText = disc;

    console.log(samount);
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

function getXreport() {
    let date = $('select')[0].value;
    console.log("getting xreport for date : "+date);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: "{{ url('/sales/xreport') }}",
        data: {'date': date},
        success: () => {
            toastr.success('Generating Report');
            // window.location.reload(true);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            toastr.warning("Unable to Print Report\nProbably Printer issue. ");
        } 
       
    });
}

updateTable($('select')[0].value);
</script>
@endsection