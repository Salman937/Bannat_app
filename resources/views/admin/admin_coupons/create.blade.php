@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    @include('include.error')
                </div>
                <div class="ibox-content"> 
                    <form action="{{ route('admin.coupons.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Coupon Code <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="coupon_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Discount Type <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="discount_type">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Discount Value <span class="text-danger">*</span></label> 
                            <div class="col-sm-7">
                                <input type="number" class="form-control" name="discount_value">
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Start Date <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="start_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">End Date <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="end_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save Coupons</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('styles')
    <link href="{{ asset('css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection

@section('scrpits')
    <script>
        $(document).ready(function(){
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
   <!-- Data picker -->
   <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

@endsection