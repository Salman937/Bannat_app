@extends('layouts.template')

@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading }}</h5>
                    <div class="ibox-tools">
                        {{-- <a class="btn btn-xs btn-primary" href="{{ route('product.create') }}"><i class="fa fa-plus-circle"></i> Add Product</a> --}}
                    </div>
                </div>
                <div class="ibox-content">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                          <tr>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Title</th>
                            <th>Featured</th>
                            <th>Description</th>
                            <th>Sale</th>
                            <th>Quantity</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $pro)
                              <tr class="gradeX">
                                <td>{{$pro->products_categories_id}}</td>
                                <td>{{$pro->price}}</td>
                                <td>{{$pro->title}}</td>
                                <td><img src="{{ $pro->image }}" alt="{{ $pro->image }}" width="70px" height="50px" style="border-radius:15px;"></td>
                                <td>{{$pro->description}}</td>
                                <td>{{$pro->sale}}</td>
                                <td>{{$pro->qty}}</td>
                                <td>
                                    <a href="{{ route('product.edit', [$pro->id]) }}" class="btn btn-primary btn-xs" title="Edit Colour"><i class="fa fa-pencil"> </i> </a>

                                    <form action="{{ URL::route('product.destroy', [$pro->id]) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button onclick=" return confirm('Are you sure you want to delete this record');" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"> </i></button>
                                    </form>
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
        });
    </script>
@endsection