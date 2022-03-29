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
						<span>Edit Admin</span>
					</li>
				</ol>
			</nav>
			<div class="row" id="cancel-row">
				
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Edit Admin</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/admin/edit') }}">
								@csrf
								<input type="hidden" value="{{ $admin[0]['id_admin'] }}" name="id_admin">
								<label for="emailAdmin">Email</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-envelope"></i></span>
									</div>
									<input required readonly value="{{ $admin[0]['email'] }}" name="email" type="email" class="form-control" id="emailAdmin">
								</div>
								
								<label for="nameAdmin">Name</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-user"></i></span>
									</div>
									<input required value="{{ $admin[0]['name'] }}" type="text" class="form-control" name="name" id="nameAdmin" placeholder="Insert Name Admin">
								</div>
								
								<label for="addressAdmin">Address</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-home"></i></span>
									</div>
									<input required value="{{ $admin[0]['address'] }}" type="text" class="form-control" name="address" id="addressAdmin" placeholder="Insert Address Admin">
								</div>
								
								<label for="phoneAdmin">Phone</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-phone"></i></span>
									</div>
									<input required value="{{ $admin[0]['phone'] }}" type="text" class="form-control" name="phone" id="phoneAdmin" placeholder="Insert Phone Admin">
								</div>
								
								<label for="bornPlaceAdmin">Born Place</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-location-arrow"></i></span>
									</div>
									<input required type="text" value="{{ $admin[0]['born_place'] }}"  class="form-control" name="born_place" id="bornPlaceAdmin" placeholder="Insert Born Place Admin">
								</div>
								
								<label for="avatarAdmin">Avatar</label>
								<br>
								@if(!is_null($admin[0]['avatar']) && file_exists(('assets/theme1/images/'.$admin[0]['avatar'])))
									<img src="{{ asset('assets/theme1/images/'.$admin[0]['avatar']) }}" style="height:50px;width:auto" class="mt-10 img-responsive">
								@else
									<img src="{{ asset('assets/theme1/images/person.png') }}" style="height:50px;width:auto" class="mt-10 img-responsive">
								@endif
								<br>	
								<br>	
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-image"></i></span>
									</div>
									<input type="file" class="form-control" name="avatar" id="avatarAdmin">
								</div>
								
								<label for="roleAdmin">Roles</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-transgender"></i></span>
									</div>
									<select id="roleAdmin" name="role" class="form-control">
										@foreach($role as $r)
										<option @if($admin[0]['role'] == $r->id_role) selected @endif value="{{$r->id_role}}">{{$r->name_role}}</option>
										@endforeach
									</select>
								</div>
								
								<label for="genderAdmin">Gender</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-transgender"></i></span>
									</div>
									<select id="genderAdmin" name="gender" class="form-control">
										<option @if($admin[0]['gender'] == 1) selected @endif value="1">Male</option>
										<option @if($admin[0]['gender'] == 0) selected @endif value="0">Female</option>
									</select>
								</div>
								
								<label for="statusAdmin">Status</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="statusAdmin" name="status_active" class="form-control">
										<option @if($admin[0]['status_active'] == 1) selected @endif value="1">Active</option>
										<option @if($admin[0]['status_active'] == 0) selected @endif value="0">Not Active</option>
									</select>
								</div>
								
								<a href="{{ url('admin/admin') }}" class="btn btn-danger mt-3">
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