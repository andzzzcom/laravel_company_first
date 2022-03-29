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
						<span>Home</span>
					</li>
				</ol>
			</nav>
				
			<div class="row layout-top-spacing" id="cancel-row">
			
				<div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5><b>{{$set["title_web"]}}:</b> Admin Panel</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
					<div class="widget widget-card-four">
						<div class="widget-content">
							<div class="w-content">
								<div class="w-info">
									<h6 class="value">1</h6>
									<p class="">Departments</p>
								</div>
								<div class="">
									<div class="w-icon">
										<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
					<div class="widget widget-card-four">
						<div class="widget-content">
							<div class="w-content">
								<div class="w-info">
									<h6 class="value">2</h6>
									<p class="">Designations</p>
								</div>
								<div class="">
									<div class="w-icon">
										<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
					<div class="widget widget-card-four">
						<div class="widget-content">
							<div class="w-content">
								<div class="w-info">
									<h6 class="value">5</h6>
									<p class="">Employees</p>
								</div>
								<div class="">
									<div class="w-icon">
										<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
					<div class="widget widget-card-four">
						<div class="widget-content">
							<div class="w-content">
								<div class="w-info">
									<h6 class="value">10</h6>
									<p class="">Projects</p>
								</div>
								<div class="">
									<div class="w-icon">
										<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>Latest 10 Projects</h5>
							<a title="view all projects" class="m-2 btn btn-warning" href="{{url('admin/project/')}}">
								<i class="fa fa-eye"></i> View All Projects
							</a>
							<table id="multi-column-ordering" class="table table-hover" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Category</th>
										<th>Start Date</th>
										<th>Duration</th>
										<th>Member</th>
										<th>Status</th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($projects as $project)
									<tr>
										<td>{{ $i }}</td>
										<td>
											{{$project->name}}
										</td>
										<td>
											<a href="{{url('admin/projects/categories/edit/'.$project->id_category)}}">
												{{$project->catName}}
											</a>
										</td>
										<td>
											{{$project->start_date}}
										</td>
										<td>
											{{$project->duration}} day(s)
										</td>
										<td class="text-center">
											<a title="view all member" class="btn btn-info" href="{{url('admin/project/member/all/'.$project->id_project)}}">
												<i class="fa fa-eye"></i> List
											</a>
											<br>
											<br>
											<a title="manage all member" class="btn btn-primary" href="{{url('admin/project/member/list/'.$project->id_project)}}">
												<i class="fa fa-tools"></i> Manage
											</a>
										</td>
										<td>
											@if($project->status_active==1)
												<span class="badge badge-success">Active</span>
											@else
												<span class="badge badge-danger">Not Active</span>
											@endif
										</td>
										<td>
											<a title="edit" href="{{ url('admin/project/edit/'.$project->id_project) }}">
												<i class="fa fa-edit"></i>
											</a>
											<a title="delete" href="{{ url('admin/project/delete/'.$project->id_project) }}">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
									@php $i++; @endphp
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