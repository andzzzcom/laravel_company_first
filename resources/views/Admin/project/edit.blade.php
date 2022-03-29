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
						<span>Update Project</span>
					</li>
				</ol>
			</nav>
			<div class="row" id="cancel-row">
				
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Update Project</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/project/edit') }}">
								@csrf
								<input type="hidden" value="{{ $project[0]['id_project'] }}" name="id_project">
								
								<label for="categoryProject">Project Category</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="categoryProject" name="id_category" class="form-control">
										@foreach($categories as $category)
										<option @if($project[0]['id_category'] == $category->id_category) selected @endif value="{{$category->id_category}}">
											{{$category->name}}
										</option>
										@endforeach
									</select>
								</div>
								
								<label for="nameProject">Project Name</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-barcode"></i></span>
									</div>
									<input required value="{{ $project[0]->name }}" type="text" class="form-control" name="name" id="nameProject" placeholder="Insert Project Name">
								</div>
								
								<label for="startDateProject">Start Date Project</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-calendar"></i></span>
									</div>
									<input required value="{{ $project[0]->start_date }}" type="date" class="form-control" name="start_date" id="startDateProject" placeholder="Insert Start Date Project">
								</div>
								
								<label for="durationProject">Duration Project</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-clock"></i></span>
									</div>
									<input required value="{{ $project[0]->duration }}" type="number" min="1" step="1" class="form-control" name="duration" id="durationProject" placeholder="Insert Duration Project">
								</div>
								
								<label for="statusProject">Status Project</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-toggle-on"></i></span>
									</div>
									<select id="statusProject" name="status_active" class="form-control">
										<option @if($project[0]['status_active'] == 1) selected @endif value="1">Active</option>
										<option @if($project[0]['status_active'] == 0) selected @endif value="0">Not Active</option>
									</select>
								</div>
								
								<a href="{{ url('admin/project') }}" class="btn btn-danger mt-3">
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