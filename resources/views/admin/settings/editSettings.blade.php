@extends('admin.layouts.master')

@section('content')
<section class="content-header">
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Personal Information</h3>
                </div>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success</h4>
                        {{ session('status') }}
                    </div>
                @endif

                <form role="form" accept-charset="UTF-8" action="{{ route('admin::settings.update') }}" method="POST">
                    <input type="hidden" value="PATCH" name="_method">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('settings_name') ? ' has-error' : '' }}">
                            <label for="settings_name">Name</label>
                            <input type="text" class="form-control" name="settings_name" id="settings_name" placeholder="Enter your name" value="{{ Auth::user()->name }}">

                            @if ($errors->has('settings_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('settings_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('settings_email') ? ' has-error' : '' }}">
                            <label for="settings_email">Email address</label>
                            <input type="email" class="form-control" name="settings_email" id="settings_email" placeholder="Enter email" value="{{ Auth::user()->email }}">

                            @if ($errors->has('settings_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('settings_email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">

                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group show_div {{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}" style="display: none;">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password">

                            @if ($errors->has('new_password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group show_div {{ $errors->has('settings_password') ? ' has-error' : '' }}" style="display: none;">
                            <label for="settings_password">Current Password</label>
                            <input type="password" class="form-control" name="settings_password" id="settings_password" placeholder="Current Password">

                            @if ($errors->has('settings_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('settings_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#new_password').on('focus', function(){
            $('.show_div').show('slow');
        })

        $('#new_password').on('blur', function(){
            if (!($(this).val().length > 0)) {
                $('.show_div').hide('slow');
            }
        })
    });
</script>
@endsection