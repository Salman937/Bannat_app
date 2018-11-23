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
                    <form action="{{ route('gallery.update', [$gallery->id]) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <img src="{{ $gallery->images }}" width="70px" height="60px" style="border-radius: 3px; margin-bottom: 1%;" alt="{{ $gallery->images }}">
                                <input type="hidden" name="pre_image" value="{{ $gallery->images }}">
                            </div>
                            <label class="col-sm-2 control-label">New Gallery Image <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="new_image">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Update Gallery Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection