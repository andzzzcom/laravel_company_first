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
						<a href="{{ url('admin/employee') }}">Employee List</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>Update Employee</span>
					</li>
				</ol>
			</nav>
			<div class="row" id="cancel-row">
				
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Update Employee</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/employee/edit') }}">
								@csrf
								<input type="hidden" value="{{ $employee[0]['id_employee'] }}" name="id_employee">
								<label for="designationEmployee">Designation Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="designationEmployee" name="id_designation" class="form-control">
										@foreach($designations as $designation)
										<option @if($employee[0]['id_designation'] == $designation->id_designation) selected @endif value="{{$designation->id_designation}}">{{$designation->id_department}} - {{$designation->name}}</option>
										@endforeach
									</select>
								</div>
								
								<label for="nameEmployee">Name Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-barcode"></i></span>
									</div>
									<input required value="{{ $employee[0]->name }}" type="text" class="form-control" name="name" id="nameEmployee" placeholder="Insert Employee Name">
								</div>
								
								<label for="emailEmployee">Email Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-barcode"></i></span>
									</div>
									<input required value="{{ $employee[0]->email }}" type="email" class="form-control" name="email" id="emailEmployee" placeholder="Insert Employee Email">
								</div>
								
								<label for="phoneEmployee">Phone Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-phone"></i></span>
									</div>
									<input required value="{{ $employee[0]->phone }}" type="text" class="form-control" name="phone" id="phoneEmployee" placeholder="Insert Phone Employee">
								</div>
								
								<label for="bornDateEmployee">Born Date Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
									</div>
									<input required value="{{ $employee[0]->born_date }}" type="date" class="form-control" name="born_date" id="bornDateEmployee" placeholder="Insert Born Date Employee">
								</div>
								
								<label for="addressEmployee">Address Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-home"></i></span>
									</div>
									<input required value="{{ $employee[0]->address }}" type="text" class="form-control" name="address" id="addressEmployee" placeholder="Insert Address Employee">
								</div>
								
								<label for="photoEmployee">Photo Employee</label>
								<br>
								@if(!is_null($employee[0]['photo']) && file_exists(('assets_admin/assets/theme1/images/employee/'.$employee[0]['photo'])))
									<img src="{{ asset('assets_admin/assets/theme1/images/employee/'.$employee[0]['photo']) }}" style="height:50px;width:auto" class="mt-10 img-responsive">
								@else
									<img src="{{ asset('assets_admin/assets/theme1/images/employee/person.png') }}" style="height:50px;width:auto" class="mt-10 img-responsive">
								@endif
								<br>	
								<br>	
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-image"></i></span>
									</div>
									<input type="file" class="form-control" name="photo" id="photoEmployee">
								</div>
								
								<label for="genderEmployee">Gender Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="genderEmployee" name="gender" class="form-control">
										<option @if($employee[0]['gender'] == 1) selected @endif value="1">Male</option>
										<option @if($employee[0]['gender'] == 0) selected @endif value="0">Female</option>
									</select>
								</div>
								
								<label for="salaryEmployee">Salary Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-dollar-sign"></i></span>
									</div>
									<input required value="{{ $employee[0]->salary }}" type="number" class="form-control" name="salary" id="salaryEmployee" placeholder="Insert Salary Employee">
								</div>
								
								<label for="statusEmployee">Status Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="statusEmployee" name="status_active" class="form-control">
										<option @if($designation[0]['status_active'] == 1) selected @endif value="1">Active</option>
										<option @if($designation[0]['status_active'] == 0) selected @endif value="0">Not Active</option>
									</select>
								</div>
								
								<a href="{{ url('admin/employee') }}" class="btn btn-danger mt-3">
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