@extends('frontend.master')

@section('title')
@parent
- Reset Password
@stop

@section('before_hgroup')

@stop

@section('hgroup')
<section class="hgroup">
	<h1>Reset Password</h1>
	<ul class="breadcrumb pull-right">
		<li>{{ HTML::link('/', 'Home') }}</li>
		<li>{{ HTML::link('/login', 'Register/Login') }}</li>
		<li class="active">Reset Password</li>
	</ul>
</section>
@stop

@section('content')
<section>
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<div class="signup">
				<div class="social_sign">
					<h3>New Password</h3>
				</div>
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="form col-lg-8">
						<p class="sign_title">Enter your new password.</p>
						{{Form::open(array('url'=>URL::route('reset.store', array($token)), 'method'=>'POST'))}}
							{{ Form::password('new_password', array('class'=>'form-control', 'placeholder'=>'New Password', 'required'=>''))}}
							{{ Form::password('new_password_confirmation', array('class'=>'form-control', 'placeholder'=>'New Password Confirmation', 'required'=>''))}}
							<button type="submit" class="btn btn-primary btn-lg">Save Change</button>
						{{ Form::close() }}
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop

