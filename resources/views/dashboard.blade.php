@extends('layouts.template')

@section('content')
@if(Auth::user()->type == 'admin')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Monthly</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">40 886,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Annual</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">275,800</h1>
                        <div class="stat-percent font-bold text-info">&nbsp; <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Today</span>
                        <h5>visits</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">106,120</h1>
                        <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                        <small>New visits</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-right">Low value</span>
                        <h5>User activity</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">80,600</h1>
                        <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                        <small>In first month</small>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endif

@if(Auth::user()->type == 'seller')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Monthly</span>
                        <h5>Income</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">40 886,200</h1>
                        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                        <small>Total income</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">Annual</span>
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">275,800</h1>
                        <div class="stat-percent font-bold text-info">&nbsp; <i class="fa fa-level-up"></i></div>
                        <small>New orders</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>On-Hold Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">2</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Accpected Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">4</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Shipped Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">5</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Rejected Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">9</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Top Product</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">19</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Low Stock Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">12</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right"></span>
                        <h5>Out Of Stock Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">21</h1>
                        {{-- <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i></div> --}}
                        {{-- <small>Total income</small> --}}
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endif
@endsection
