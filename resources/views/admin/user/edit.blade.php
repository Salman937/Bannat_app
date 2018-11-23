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
                    <form method="POST" action="{{ route('user.update', [$user->id ]) }}" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">Name <span class="text-danger">*</span></label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-2 control-label">E-Mail Address <span class="text-danger">*</span></label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" required value="{{ $user->email }}">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="old_password" value="{{ $user->password }}">
                        <div class="form-group">
                            <label for="password" class="col-md-2 control-label">New Password </label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-2 control-label">Confirm New Password </label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="phone_no" class="col-md-2 control-label">Phone No <span class="text-danger">*</span></label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control" name="phone_no" required value="{{ $user->phone_no }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-md-2 control-label">User Type<span class="text-danger">*</span></label>

                            <div class="col-md-7">
                                <select name="type" id="type" class="form-control" required autofocus>
                                    <option selected disabled class="form-control">Select User Type</option>
                                    @if($user->type == 'admin')
                                        <option value="admin" selected class="form-control">Admin</option>
                                        <option value="seller" class="form-control">Seller</option>
                                    @else
                                        <option value="admin" class="form-control">Admin</option>
                                        <option value="seller" selected class="form-control">Seller</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="active" class="col-md-2 control-label">Active | De-Active<span class="text-danger">*</span></label>

                            <div class="col-md-7">
                                <select name="active" id="active" class="form-control" required autofocus>
                                    @if($user->deactive_users == 1)
                                        <option value="1" selected class="form-control">Active</option>
                                        <option value="0" class="form-control">De-Active</option>
                                    @else
                                        <option value="1" class="form-control">Active</option>
                                        <option value="0" selected class="form-control">De-Active</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Update User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection
