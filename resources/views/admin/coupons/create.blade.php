@extends('layouts.template')

@section('content')
<form action="{{ route('coupons.store') }}" method="post" class="form-horizontal">
    {{ csrf_field() }}
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{ $heading }}</h5>
                        <div class="ibox-tools">
                            <a data-toggle="modal" class="btn btn-primary btn-xs" href="#modal-form">Apply Coupons</a>
                        </div>
                        @include('include.error')
                    </div>
                    <div class="ibox-content">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                              <tr>
                                <th>Product</th>
                                <th>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox3" type="checkbox" name="head_check_box" class="head_check_box">
                                        <label for="checkbox3" id="head_label">
                                            Checked All
                                        </label>
                                    </div> 
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $prod)
                                  <tr class="product_row">
                                    <td>
                                        <input type="text" class="form-control" readonly name="product_id[]" style="width: 100%;" value="{{ $prod->title }}"></td>
                                    <td>
                                        <div class="checkbox checkbox-success">
                                            <input id="checkbox3" type="checkbox" name="product_check[]" value="{{ $prod->id }}" class="product_check_box">
                                            <label for="checkbox3">
                                            </label>
                                        </div>
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <h3 class="m-t-none m-b">Apply Coupons</h3>
                        <p>Fill All The Field.</p>
                        {{-- <hr> --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Coupon Code</label> 
                                <input type="text" class="form-control" name="coupon_code">
                            </div>
                            <div class="form-group">
                                <label>Discount Type</label> 
                                <input type="text" class="form-control" name="discount_type">
                            </div>
                            <div class="form-group">
                                <label>Discount Value</label> 
                                <input type="number" class="form-control" name="discount_value">
                            </div>
                            <div class="form-group" id="data_1">
                                <label class="font-normal">End Date</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="end_date">
                                </div>
                            </div>
                            <div class="form-group" id="data_1">
                                <label class="font-normal">Start Date</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="start_date">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Save</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('styles')
    <!-- data table  -->
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

    {{-- <link href="{{ asset('css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"> --}}

@endsection

@section('scrpits')
    <!-- data table -->
    {{-- <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script> --}}

    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.dataTables-example').DataTable({
                "order": [],
                pageLength: 25,
                responsive: true,
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
    <script>
        $('body').on('change', '.head_check_box', function () {
            $('.product_row input').prop('checked', true);
            $('.head_check_box').attr("style", "");
            $(this).addClass("decelect_check_box");
            $(this).removeClass('head_check_box ');
            $('#head_label').text('Unchecked All');
        });

        $('body').on('change', '.decelect_check_box', function () {
            $('.product_row input').prop('checked', false);
            $('.decelect_check_box').attr("style", "");
            $(this).addClass("head_check_box");
            $(this).removeClass('decelect_check_box ');
            $('#head_label').text('Checked All');
        });
    </script>
   <!-- Data picker -->
   <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    
    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>

@endsection


@section('styles')
<link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection