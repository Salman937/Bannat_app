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
                    <form action="{{ route('product.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select name="category" id="category" class="form-control">
                                    <option selected disabled >Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Price <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <textarea name="description" id="description" cols="10" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">Sale <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="sale">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Qty <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="qty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Options Images <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="option_images[]" multiple="multiple">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Save Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection\