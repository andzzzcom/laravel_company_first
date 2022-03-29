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
		
		@if(\Session::has('success'))
			<div class="col-md-3"></div>
			<div class="col-md-6 text-center col-xs-12 container-login cblack">
				<h5 class="fbold bggray p-10">
					Thanks for signing up for a bestlist account! <br>
					<span class="fnormal">
						A link to activate your account has been emailed to {{ Session::get("success") }}.
					</span>
				</h5>
				<h5>
					Questions/comments?  Please see our help pages.
				</h5>
			</div>
		@else
			<div class="col-md-4"></div>
			<div class="col-md-4 text-left col-xs-12 mt-20 container-login">
				<form id="reg_form" method="post" action="{{ url('register') }}">
					@csrf
					@if($errors->any())
						@foreach($errors->all() as $err)
							<h5 class="cred2 fbold">
								{{ $err }}
							</h5>
						@endforeach
					@endif
					<div class="col-md-12 col-xs-12 text-center bgheaderlogin">
						<h5 class="fbold colorblack">
							Create an account
						</h5>
					</div>
					<div class="col-md-12 col-xs-12 colorblack mt-10">
						<div class="form-group">
							<label>
								Username
							</label>
							<input type="text" placeholder="enter your username" name="username" class="form-control">
							<label class="fnormal text-justify">
								Choose a username 6-30 characters long. 
								Your username can be any combination of any letters, numbers only
							</label>
						</div>
						<div class="form-group">
							<label>
								Email
							</label>
							<input type="email" placeholder="enter your email" name="email" class="form-control">
						</div>
					</div>
					<div class="col-md-12 col-xs-12 text-center bgheaderlogin">
						<h5 class="fbold colorblack">
							Set a password
						</h5>
					</div>
					<div class="col-md-12 col-xs-12 colorblack mt-10" id="jquery-script-menu">
						<div class="form-group cred2 fbold">
							<div id="password_check"></div>
						</div>
						
						<div class="form-group">
							<label>
								New Password
							</label>
							<div class="form-inline">
								<input required placeholder="enter your password" style="width:100%" type="password" name="password" id="password" class="form-control">
								<a id="pass" style="display:none;cursor:pointer" onclick="togglePassword(0)">
									show
								</a>
							</div>
						</div>
						
						<div class="form-group">
							<label>
								Re-type New Password
							</label>
							<div class="form-inline">
								<input placeholder="enter your password (confirmation)" required style="width:100%" type="password" name="password_conf" id="password_conf" class="form-control">
								<a id="pass_conf" style="display:none;cursor:pointer" onclick="togglePassword(1)">
									show
								</a>
							</div>
						</div>
						
						<div class="form-group">
							<label>Password Strength</label>
							<div id="password_strength"></div>
						</div>
						
						<div class="form-group text-justify">
							<label class="fnormal">
								Password minimum 5 characters, must using a mixture of lowercase letter, uppercase letter, numbers and symbols (eg: @$!%*#?&).
								Avoid using common words, phrases, or personal information.
							</label>
						</div>
						
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">
								register now
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		@endif
	</div>
	@endsection