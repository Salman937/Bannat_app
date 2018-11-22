@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $ord)
                              <tr>
                                <td>#{{ $ord->id }} &nbsp; {{ $ord->name }}</td>
                                <td>{{ $ord->order_date->diffForHumans() }}</td>
                                <td>
                                    <input type="hidden" class="order_id" value="{{ $ord->id }}">
                                    <select name="order_status" id="order_status" class="form-control order_status">
                                        <option value="pending" class="form-control" @if($ord->order_status == 'pending') selected @endif>pending</option>
                                        <option value="inprogress" class="form-control" @if($ord->order_status == 'inprogress') selected @endif>inprogress</option>
                                        <option value="shipped" class="form-control" @if($ord->order_status == 'shipped') selected @endif>shipped</option>
                                        <option value="completed" class="form-control" @if($ord->order_status == 'completed') selected @endif>completed</option>
                                    </select>
                                </td>
                                <td>{{ $ord->total_price }}</td>
                                <td>
                                    @if($ord->accpect_reject == 1)
                                        <button class="btn btn-xs btn-primary accpect_button" type="button"><i class="fa fa-check"></i></button>
                                    @else
                                        <button class="btn btn-xs btn-default accpect_button" type="button"><i class="fa fa-check"></i></button>
                                    @endif
                                    @if($ord->accpect_reject == 0)
                                        <button class="btn btn-xs btn-danger reject_button" type="button"><i class="fa fa-minus-square "></i></button>
                                    @else
                                        <button class="btn btn-xs btn-default reject_button" type="button"><i class="fa fa-minus-square "></i></button>
                                    @endif
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
@endsection

@section('styles')
    <!-- data table  -->
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('scrpits')
    <!-- data table -->
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                "order": [],
                pageLength: 25,
                responsive: true,
            });

            $('body').on('change','.order_status',function(){
                var status = $(this).val();
                var row = $(this).closest('tr');
                var order_id = row.find('.order_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data:{status:status,order_id:order_id},
                    type:'POST',
                    url:"/order_status_update",
                    success: function(return_data)
                    {
                        if (return_data == '1') {
                            message('success','Order Status Updated SuccessFully');
                            location.reload();
                        }
                        else{
                            message('error','There Are Some Error! Please Contact System Developer');
                        }
                    },
                });
            });

            $('.reject_button').click(function(){
                var row = $(this).closest('tr');
                var order_id = row.find('.order_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data:{order_id:order_id},
                    type:'POST',
                    url:"/order_status_reject",
                    success: function(return_data)
                    {
                        if (return_data == '1') {
                            message('success','Order Added To Rejected List');
                            location.reload();
                        }
                        else{
                            message('error','There Are Some Error! Please Contact System Developer');
                        }
                    },
                });
            });
            $('.accpect_button').click(function(){
                var row = $(this).closest('tr');
                var order_id = row.find('.order_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data:{order_id:order_id},
                    type:'POST',
                    url:"/order_status_accpect",
                    success: function(return_data)
                    {
                        if (return_data == '1') {
                            message('success','Order Added To Accpected List');
                            location.reload();
                        }
                        else{
                            message('error','There Are Some Error! Please Contact System Developer');
                        }
                    },
                });
            });

            function message(type,message)
            {
                if(type=='error') {
                    toastr.error(''+message,{timeOut: 5000});
                }
                if(type=='success') {
                    toastr.success(''+message,{timeOut: 5000});
                }
                if(type=='info') {
                    toastr.info(''+message,{timeOut: 5000});
                }
            }
        });
    </script>
@endsection