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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Username</th>
                <th>Username</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
                <td>Otto</td>
                <td>Otto</td>

                <td>@mdo</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Jacob</td>
                <td>Otto</td>
                <td>Otto</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Otto</td>
                <td>Otto</td>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
        </table>
    </div><!-- table-responsive -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            <h4 class="modal-title">Large Modal</h4>
        </div>
        <div class="modal-body">

          <form class="form-inline">
            <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">Item Name</label>
                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Item Name">
            </div><!-- form-group -->
            
            <div class="form-group">
                <label class="sr-only" for="exampleInputPassword2">Item Quantity</label>
                <input type="number" class="form-control" id="exampleInputPassword2" placeholder="Item Quantity">
            </div><!-- form-group -->
            
            
          </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary mr5">Add</button>
        </div>
    </div>
  </div>
</div>
  </div>
@endsection 
        