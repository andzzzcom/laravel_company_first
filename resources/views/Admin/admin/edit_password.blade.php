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
					<li class="breadcrumb-item">
						<a href="{{ url('admin/admin') }}">Admin List</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>Update Password Admin</span>
					</li>
				</ol>
			</nav>
			<div class="row" id="cancel-row">
				
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Update Password Admin</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/admin/edit_password') }}">
								@csrf
								<input type="hidden" value="{{ $id_admin}}" name="id">
								<div class="card-body">			
									<div class="form-group">
										<label for="exampleInputuname">Old Password</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
											</div>
											<input type="password"  name="password" class="form-control" placeholder="Insert Old Password" aria-label="Name Admin" aria-describedby="basic-addon1">
										</div>
									</div>					
									
									<div class="form-group">
										<label for="exampleInputuname">New Password</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
											</div>
											<input type="password"  name="new_password" class="form-control" placeholder="Insert Password" aria-label="Password Admin" aria-describedby="basic-addon1">
										</div>
									</div>	
									
									<div class="form-group">
										<label for="exampleInputuname">New Password (Confirm)</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i class="ti-notepad"></i></span>
											</div>
											<input type="password" name="new_password_confirm" class="form-control" placeholder="Insert Password" aria-label="Password Admin" aria-describedby="basic-addon1">
										</div>
									</div>		
									
									<a href="{{ url('admin/admin') }}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Cancel</a>
									<button type="submit" class="btn btn-success waves-effect waves-light m-r-10"> <i class="fa fa-save"></i> Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--  END CONTENT AREA  -->
	@endsection