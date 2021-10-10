@extends('shared')

@section('pageContent')


<div class="mainpanel">
  <div class="pageheader">
      <div class="media">
          <div class="pageicon pull-left">
              <i class="fa fa-th-list"></i>
          </div>
          <div class="media-body">
              <ul class="breadcrumb">
                  <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                  <li>Items</li>
              </ul>
              <h4>Items in Inventory</h4>
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
        <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"> Add Item To Inventory</button>
      </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-dark mb30">
            <thead>
              <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Warning Quantity</th>
                <th>Unit</th>
                {{-- <th>Username</th> --}}
                {{-- <th>Username</th> --}}

              </tr>
            </thead>
            <tbody>

              @foreach($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->warning_quantity }}</td>
                <td>{{ $item->unit }}</td>
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
            <h4 class="modal-title">Add / Update Item</h4>
        </div>
        <div class="modal-body">

          <form class="form-inline" method="POST" action="{{ url('/item')}}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Item Name</label>
                <input type="text" class="form-control"  name="itemname" id="exampleInputEmail2" placeholder="Item Name">
            </div><!-- form-group -->
            
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Item Quantity</label>
                <input type="number" step="0.001" class="form-control" name="quantity" id="exampleInputPassword2" placeholder="Item Quantity">
            </div><!-- form-group -->
            
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Warning Quantity</label>
                <input type="number" class="form-control" name="warning_quantity" id="exampleInputPassword2" placeholder="Warning Quantity">
            </div><!-- form-group -->

            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Item Unit</label>
                <input type="text" class="form-control" name="unit" id="exampleInputPassword2" placeholder="kg / peices / liters">
            </div><!-- form-group -->
            <div class="modal-footer">
             <button type="submit" class="btn btn-primary mr5">Add</button> 

            </div>
            <!-- <button class="p-" type="submit" class="btn btn-primary mr5">Add</button>             -->
          </form>
        </div>
        
    </div>
  </div>
</div>
  </div>
@endsection 
        