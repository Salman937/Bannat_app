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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">First Category <span class="text-danger">*</span></label>
                                        <select name="head_category" id="head_category" required class="form-control head_category">
                                            <option selected disabled >Select First Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <label class="control-label">Qty <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="qty">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Secound Category <span class="text-danger">*</span></label>
                                        <select name="secound_cat" id="secound_cat" required class="form-control secound_cat">
                                            <option selected disabled >Select Secound Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <label class="control-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Third Category <span class="text-danger">*</span></label>
                                        <select name="third_cat" id="third_cat" required class="form-control third_cat">
                                            <option selected disabled >Select Third Category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <label class="control-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Featured Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="images[]" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label class="control-label">Size <span class="text-danger">*</span></label>
                                        <table>
                                            <tr> <td width="20px;"> <input type="checkbox" name="size[]" value="XL"> </td> 
                                                <td>  XL &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="L"> </td> 
                                                <td>  L &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="M"> </td> 
                                                <td>  M &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="S"> </td> 
                                                <td>  S &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="XS"> </td> 
                                                <td>  XS &nbsp;&nbsp;&nbsp; </td>
                                            </tr>
                                        </table>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Options Images <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="option_images[]" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label class="control-label">Colour <span class="text-danger">*</span></label>
                                        <table>
                                            <tr> <td width="20px;" class="first_color" > <input type="color" name="color[]" value="#ff0000"></td>
                                            <td width="30px;"> <button  type="button" class="btn btn-xs btn-default add_colour"><i class="fa fa-plus-circle"></i></button></td>
                                            </tr>
                                        </table>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" cols="10" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        {{-- <label class="control-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-primary" type="submit">Save Product</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('scrpits')
<script>
$(document).ready(function(){
    $('body').on('change','.head_category',function(){
        var first_cat = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data:{id:first_cat},
            type:'POST',
            url:"/get_cat_seller",
            success: function(return_data)
            {
                var data= jQuery.parseJSON(return_data);
                if(!jQuery.isEmptyObject(data))
                {
                    $('.secound_cat')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option disabled selected>Select Secound Category</option>');
                  $.each( data, function( index, value ){
                   $('.secound_cat').append($('<option value="'+value['id']+'">'+value['category']+'</option>'));
                  });
                }
            },
        });
    });
    $('body').on('change','.secound_cat',function(){
        var sec_cat = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            data:{id:sec_cat},
            type:'POST',
            url:"/get_cat_seller",
            success: function(return_data)
            {
                var data= jQuery.parseJSON(return_data);
                if(!jQuery.isEmptyObject(data))
                {
                    $('.third_cat')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option disabled selected>Select Third Category</option>');
                  $.each( data, function( index, value ){
                   $('.third_cat').append($('<option value="'+value['id']+'">'+value['category']+'</option>'));
                  });
                }
            },
        });
    });
    $('.add_colour').click(function(){
        console.log('add colour');
        var color = '<td width="20px;"><input type="color" name="color[]" value="#ff0000"></td>';
        $('.first_color').before(color);
    });
});
</script>
@endsection