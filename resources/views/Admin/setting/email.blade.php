@extends("Admin.incl.layout")

	@section("content")
	<!--  BEGIN CONTENT AREA  -->
	<div id="content" class="main-content">
		<div class="layout-px-spacing">

			<nav class="breadcrumb-one layout-top-spacing" aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="{{ url('admin/home') }}">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
						</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>Email Settings</span>
					</li>
				</ol>
			</nav>
				
			<div class="row" id="cancel-row">
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Email Settings</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/setting/email') }}">
								@csrf
								<label for="mailType">Mail Type</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input required value="{{$list[0]->mail_type}}" placeholder="Mail Type" type="text" name="mail_type" class="form-control" id="mailType">
								</div>
								
								<label for="mailHost">Mail Host</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input required value="{{$list[0]->mail_host}}" placeholder="Mail Host" type="text" name="mail_host" class="form-control" id="mailHost">
								</div>
								
								<label for="mailUsername">Mail Username</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input required value="{{$list[0]->mail_username}}" placeholder="Mail Username" type="text" name="mail_username" class="form-control" id="mailUsername">
								</div>
								
								<label for="mailPassword">Mail Password</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input required value="{{$list[0]->mail_password}}" placeholder="Mail Password" type="password" name="mail_password" class="form-control" id="mailPassword">
								</div>
								
								<label for="mailPort">Mail Port</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input required value="{{$list[0]->mail_port}}" placeholder="Mail Port" type="text" name="mail_port" class="form-control" id="mailPort">
								</div>
								
								<label for="mailEncryption">Mail Encryption</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input required value="{{$list[0]->mail_encryption}}" placeholder="Mail Encryption" type="text" name="mail_encryption" class="form-control" id="mailEncryption">
								</div>
								
								<a href="{{ url('admin/home') }}" class="btn btn-danger mt-3">
									<i class="fa fa-arrow-left"></i> 
									Cancel
								</a>
								<button type="submit" class="btn btn-primary mt-3">
									<i class="fa fa-save"></i>
									Update
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--  END CONTENT AREA  -->
	@endsection