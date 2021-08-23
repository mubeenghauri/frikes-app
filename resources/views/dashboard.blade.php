@extends('shared')

@section('css-links')
<link href="css/morris.css" rel="stylesheet">
<link href="css/select2.css" rel="stylesheet" />
<link href="css/font-awesome.css" rel="stylesheet" />
@endsection

@section('pageContent')      
<div class="mainpanel">
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Dashboard</li>
                </ul>
                <h4>Dashboard</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
    
    <div class="contentpanel">
        
        <div class="row row-stat">
            <div class="col-md-4">
                <div class="panel panel-success-alt noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        {{-- <div class="panel-icon"><i class="fa fa-dollar"></i></div> --}}
                        <div class="media-body">
                            <h5 class="md-title nomargin">Today's Earnings</h5>
                            <h1 class="mt5">$8,102.32</h1>
                        </div><!-- media-body -->
                        <hr>
                        <div class="clearfix mt20">
                            <div class="pull-left">
                                <h5 class="md-title nomargin">Yesterday</h5>
                                <h4 class="nomargin">$29,009.17</h4>
                            </div>
                            <div class="pull-right">
                                <h5 class="md-title nomargin">This Week</h5>
                                <h4 class="nomargin">$99,103.67</h4>
                            </div>
                        </div>
                        
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->
            
            <div class="col-md-4">
                <div class="panel panel-primary noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        {{-- <div class="panel-icon"><i class="fa fa-users"></i></div> --}}
                        <div class="media-body">
                            <h5 class="md-title nomargin">New User Accounts</h5>
                            <h1 class="mt5">138,102</h1>
                        </div><!-- media-body -->
                        <hr>
                        <div class="clearfix mt20">
                            <div class="pull-left">
                                <h5 class="md-title nomargin">Yesterday</h5>
                                <h4 class="nomargin">10,009</h4>
                            </div>
                            <div class="pull-right">
                                <h5 class="md-title nomargin">This Week</h5>
                                <h4 class="nomargin">178,222</h4>
                            </div>
                        </div>
                        
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->
            
            <div class="col-md-4">
                <div class="panel panel-dark noborder">
                    <div class="panel-heading noborder">
                        <div class="panel-btns">
                            <a href="" class="panel-close tooltips" data-toggle="tooltip" data-placement="left" title="Close Panel"><i class="fa fa-times"></i></a>
                        </div><!-- panel-btns -->
                        {{-- <div class="panel-icon"><i class="fa fa-pencil"></i></div> --}}
                        <div class="media-body">
                            <h5 class="md-title nomargin">New User Posts</h5>
                            <h1 class="mt5">153,900</h1>
                        </div><!-- media-body -->
                        <hr>
                        <div class="clearfix mt20">
                            <div class="pull-left">
                                <h5 class="md-title nomargin">Yesterday</h5>
                                <h4 class="nomargin">144,009</h4>
                            </div>
                            <div class="pull-right">
                                <h5 class="md-title nomargin">This Week</h5>
                                <h4 class="nomargin">987,212</h4>
                            </div>
                        </div>
                        
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->
        </div><!-- row -->
        
        <div class="alert alert-info">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
            <strong>Heads up!</strong> This <a class="alert-link" href="">alert needs your attention</a>, but it's not super important.
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Site Statistics</h5>
                        <div id="basicFlotLegend" class="flotLegend"></div>
                        <div id="basicflot" class="flotChart"></div>
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <div class="tinystat pull-left">
                            <div id="sparkline" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Average</span>
                                <h4>$9,201</h4>
                            </div>
                        </div><!-- tinystat -->
                        <div class="tinystat pull-right">
                            <div id="sparkline2" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Total</span>
                                <h4>$8,201</h4>
                            </div>
                        </div><!-- tinystat -->
                    </div><!-- panel-footer -->
                </div><!-- panel -->
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Site Visitors</h5>
                        <div id="basicFlotLegend2" class="flotLegend"></div>
                        <div id="basicflot2" class="flotChart"></div>
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <div class="tinystat pull-left">
                            <div id="sparkline3" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Average</span>
                                <h4>52,201</h4>
                            </div>
                        </div><!-- tinystat -->
                        <div class="tinystat pull-right">
                            <div id="sparkline4" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Total</span>
                                <h4>11,201</h4>
                            </div>
                        </div><!-- tinystat -->
                    </div><!-- panel-footer -->
                </div><!-- panel -->
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body padding15">
                        <h5 class="md-title mt0 mb10">Site Impressions</h5>
                        <div id="basicFlotLegend3" class="flotLegend"></div>
                        <div id="basicflot3" class="flotChart"></div>
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <div class="tinystat pull-left">
                            <div id="sparkline5" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Average</span>
                                <h4>37,101</h4>
                            </div>
                        </div><!-- tinystat -->
                        <div class="tinystat pull-right">
                            <div id="sparkline6" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Total</span>
                                <h4>18,899</h4>
                            </div>
                        </div><!-- tinystat -->
                    </div><!-- panel-footer -->
                </div><!-- panel -->
            </div>
            
        </div><!-- row -->
        
        <div class="row">
            
            <div class="col-lg-12 col-md-8">
                <div class="panel panel-success-head widget-todo">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <a title="" data-toggle="tooltip" class="tooltips mr5" href="" data-original-title="Settings"><i class="glyphicon glyphicon-cog"></i></a>
                            <a title="" data-toggle="tooltip" class="tooltips" id="addnewtodo" href="" data-original-title="Add New"><i class="glyphicon glyphicon-plus"></i></a>
                        </div><!-- panel-btns -->
                        <h3 class="panel-title">To-Do List for HA </h3>
                    </div>
                    <ul class="panel-body list-group nopadding">
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" id="washcar" value="1">
                                  <label for="washcar">Make Mahal ;) ifykwim</label>
                              </div>
                        </li>
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" checked="checked" id="eatpizza" value="1">
                                  <label for="eatpizza">Become Billonaire</label>
                              </div>
                        </li>
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" checked="checked" id="washdish" value="1">
                                  <label for="washdish">Have a huge dick ;) ;) VVIP</label>
                              </div>
                        </li>
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" id="buyclothes" value="1">
                                  <label for="buyclothes">Buy some clothes for _______</label>
                              </div>
                        </li>
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" checked="checked" id="throw" value="1">
                                  <label for="throw">Throw myself in the garbage</label>
                              </div>
                        </li>
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" id="reply" value="1">
                                  <label for="reply"> Do Chaiking with lads VVIP</label>
                              </div>
                        </li>
                        <li class="list-group-item">
                              <div class="ckbox ckbox-default">
                                  <input type="checkbox" id="reply" value="1">
                                  <label for="reply"> We could make this thing work too, </label>
                              </div>
                        </li>
                    </ul>
                </div>
            </div><!-- col-md-4 -->
        </div><!-- row -->
      </div><!-- row -->
    </div><!-- contentpanel -->
@endsection 


@section('js')



<script src="js/flot/jquery.flot.min.js"></script>
<script src="js/flot/jquery.flot.resize.min.js"></script>
<script src="js/flot/jquery.flot.spline.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael-2.1.0.min.js"></script>
<script src="js/bootstrap-wizard.min.js"></script>
<script src="js/select2.min.js"></script>

<script src="js/dashboard.js"></script>
@endsection
        