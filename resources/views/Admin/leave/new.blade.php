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
						<a href="{{ url('admin/leave') }}">Leave List</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>Add Leave</span>
					</li>
				</ol>
			</nav>
			<div class="row" id="cancel-row">
				
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Add Leave</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/leave/add') }}">
								@csrf
								
								<label for="nameEmployee">Name Employee</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="nameEmployee" name="id_employee" class="form-control">
										@foreach($employees as $employee)
										<option value="{{$employee->id_employee}}">	
											{{$employee->name}}
										</option>
										@endforeach
									</select>
								</div>
								
								<label for="startDate">Start Date</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
									</div>
									<input required value="{{ old('start_date') }}" type="date" class="form-control" name="start_date" id="startDate" placeholder="Insert Start Date">
								</div>
								
								<label for="endDate">End Date</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
									</div>
									<input required value="{{ old('end_date') }}" type="date" class="form-control" name="end_date" id="endDate" placeholder="Insert End Date">
								</div>
								
								<label for="reason">Reason</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-paragraph"></i></span>
									</div>
									<input required value="{{ old('reason') }}" type="text" class="form-control" name="reason" id="reason" placeholder="Insert Reason">
								</div>
								
								<label for="statusLeave">Status Leave</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="statusLeave" name="status_active" class="form-control">
										<option value="1">Active</option>
										<option value="0">Not Active</option>
									</select>
								</div>
								
								<a href="{{ url('admin/leave') }}" class="btn btn-danger mt-3">
									<i class="fa fa-arrow-left"></i> 
									Cancel
								</a>
								<button type="submit" class="btn btn-primary mt-3">
									<i class="fa fa-save"></i>
									Add
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