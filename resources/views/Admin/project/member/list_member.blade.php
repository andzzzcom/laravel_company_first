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
						<a href="{{ url('admin/project') }}">Project List</a>
					</li>
                    <li class="breadcrumb-item active" aria-current="page">
						<span>Project Member Manage</span>
					</li>
				</ol>
			</nav>

			<div class="row layout-top-spacing" id="cancel-row">
				<div class="col-xl-12 col-lg-12 col-md-8 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>Project Member Manage</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
					<div class="widget-content widget-content-area br-6">
						<h5>
							Project Name: 
							<a class="btn btn-warning" href="{{url('admin/project/edit/'.$project[0]->id_project)}}">
								<i class="fa fa-edit"></i>
								{{$project[0]->name}}
							</a>
						</h5>
						<div class="table-responsive mb-4 mt-4">
							<table id="multi-column-ordering" class="table table-hover" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Department</th>
										<th>Designation</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; $check = 0; @endphp
									@foreach($employees as $employee)
										@foreach($relations as $relation)
											@if($relation->id_employee == $employee->id_employee)
												@php
													$check = $relation->status_active
												@endphp
											@endif
										@endforeach
									<tr>
										<td>{{ $i }}</td>
										<td>
											@if(!is_null($employee->photo) && file_exists(('assets_admin/assets/theme1/images/employee/'.$employee->photo)))
												<img src="{{ asset('assets_admin/assets/theme1/images/employee/'.$employee->photo) }}" style="height:50px;width:50px" class="mt-10 img-responsive">
											@else
												<img src="{{ asset('assets_admin/assets/theme1/images/employee/person.png') }}" style="height:50px;width:50px" class="mt-10 img-responsive">
											@endif
										</td>
										<td class="text-center">
											<a href="{{url('admin/employee/edit/'.$employee->id_employee)}}">
												{{$employee->name}}
												<br>
												<i class="fa fa-eye"></i> 
											</a>
										</td>
										<td>
											{{$employee->email}}
										</td>
										<td>
											{{$employee->departmentName}}
										</td>
										<td>
											{{$employee->designationName}}
										</td>
										<td>
											<label class="switch s-outline s-outline-primary  mb-4 mr-2">
												<input {{($check==1)?'checked':''}} type="checkbox" onclick="changeMember('{{$employee->id_employee}}', '{{$project[0]->id_project}}')">
												<span class="slider round"></span>
											</label>
										</td>
									</tr>
									@php $i++; $check=0; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--  END CONTENT AREA  -->
	@endsection