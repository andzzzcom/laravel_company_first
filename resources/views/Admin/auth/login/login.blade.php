@extends("Front.incl.layout")

	@section("content")
	<div class="row text-left cblue1">
		<div class="col-md-12 col-xs-12 fbold hidden">
			<h3>
				<a href="{{ url('') }}">
					BestLists
				</a>
			</h3>
			<a href="{{ url('') }}">
				BL 
			</a>
			/ my account
		</div>
		<div class="col-md-4"></div>
		
		<div class="col-md-4 text-left col-xs-12 mt-20 container-login">
			<div class="col-md-12 col-xs-12 text-center bgheaderlogin">
				<h5 class="fbold colorblack">
					Login
				</h5>
			</div>
			<form method="post" action="{{ url('login') }}">
				@csrf
				<div class="col-md-12 col-xs-12 colorblack mt-10">
					@if($errors->any())
						@foreach($errors->all() as $err)
							<div class="form-group">
								<h5 class="fbold cred2">
								{{ $err }}
								</h5>
							</div>
						@endforeach
					@endif
					<div class="form-group">
						<label>
							Username
						</label>
						<input type="text" placeholder="enter your username" required name="username" class="form-control">
					</div>
					
					<div class="form-group">
						<label class="pull-left">
							Password
						</label>
						<label class="pull-right">
							<a href="{{ url('forgot') }}" class="cblue1">
								Forgot Password?
							</a>
						</label>
						<div class="form-inline">
							<input placeholder="enter your password" id="password_login" required style="width:100%" type="password" name="password" class="form-control">
							<a id="pass_log" style="display:none;cursor:pointer" onclick="togglePassword(2)">
								show
							</a>
						</div>
					</div>
					
					<div class="form-group">
						<label class="pull-right">
							<button type="submit" class="btn btn-primary">
								login
							</button>
						</label>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection