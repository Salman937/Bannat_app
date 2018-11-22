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
                    <form action="{{route('product.seller.update',['id' => $product->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">First Category <span class="text-danger">*</span></label>
                                        <select name="head_category" id="head_category" required class="form-control head_category">
                                            <option selected disabled >Select First Category</option>
                                            @foreach($categories as $fir_cat)
                                                <option value="{{ $fir_cat->id }}" @if($product->first_cat == $fir_cat->id) selected @endif>{{ $fir_cat->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <label class="control-label">Qty <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="qty" value="{{ $product->qty }}">
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
                                            @foreach($sec_categories as $sec_cat)
                                                <option value="{{ $sec_cat->id }}" @if($product->sec_cat == $sec_cat->id) selected @endif>{{ $sec_cat->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <label class="control-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
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
                                            @foreach($third_categories as $third_cat)
                                                <option value="{{ $third_cat->id }}" @if($product->products_categories_id == $third_cat->id) selected @endif>{{ $third_cat->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                    <label class="control-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" value="{{ $product->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" cols="5" rows="2" class="form-control">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label class="control-label">Size </label>
                                        <table>
                                            <tr> 
                                            <?php $size = explode('|',$product->size)?>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="XL" @if(array_search('XL',$size) !== false) checked @endif> </td> 
                                                <td>  XL &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="L" @if(array_search('L',$size) !== false) checked @endif> </td> 
                                                <td>  L &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="M" @if(array_search('M',$size) !== false) checked @endif> </td> 
                                                <td>  M &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="S" @if(array_search('S',$size) !== false) checked @endif> </td> 
                                                <td>  S &nbsp;&nbsp;&nbsp; </td>
                                                <td width="20px;"> <input type="checkbox" name="size[]" value="XS" @if(array_search('XS',$size) !== false) checked @endif> </td> 
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
                                        <input type="hidden" name="feature_image" value="{{ $product->image }}">
                                        <?php $image = explode('|',$product->image)?>
                                        @foreach($image as $img)
                                            <img src="{{ $img }}" alt="{{ $img }}" width="50px" height="40px" style="border-radius:3px;">
                                        @endforeach
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Select New Featured Image <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="new_feature_image[]" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label class="control-label">Colour</label>
                                        <table>
                                            <tr>
                                              <td width="30px;"> <button style="margin-right: 2px;margin-top: 4px;" type="button" class="btn btn-xs btn-default add_colour"><i class="fa fa-plus-circle"></i></button></td>
                                              <?php $color = explode('|',$product->color)?>
                                              @foreach($color as $col)
                                                <td><input style="width:30px !important;" type="color" name="color[]" value="{{ $col }}"></td>
                                              @endforeach
                                              <td class="first_color"></td>
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
                                        <input type="hidden" name="option_images" value="{{ $product->options }}">
                                        <?php $options = explode('|',$product->options)?>
                                        @foreach($options as $opt_img)
                                            <img src="{{ $opt_img }}" alt="{{ $opt_img }}" width="50px" height="40px" style="border-radius:3px;">
                                        @endforeach
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label class="control-label">Options Images <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="new_option_images[]" multiple="multiple">
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
        var color = '<td><input style="width:30px !important;" type="color" name="color[]" value="#ff0000"></td>';
        $('.first_color').before(color);
    });
});
</script>
@endsection