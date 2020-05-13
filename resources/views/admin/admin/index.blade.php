@extends('layouts.adminlayout.adminlogin')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    
    <form action="{{ route('admin') }}" method="post">
    {{ csrf_field() }}
    <span class="aler alert-danger">
        @if(Session::has('flash_message_error'))
            {{Session('flash_message_error')}}
        @endif
     </span>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        
      </div>
      <div class="form-group">
        @error('email')
              <span class="alert alert-danger">  {{ $message }}</span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          
      </div>
      <div class="form-group">
            @error('password')
                <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
        </div>  
      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>

@endsection