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
						<span>Menu List</span>
					</li>
				</ol>
			</nav>

			<div class="row layout-top-spacing" id="cancel-row">
				<div class="col-xl-12 col-lg-12 col-md-8 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>Menu List</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-8 col-lg-8 col-sm-12  layout-spacing">
					<div class="widget-content widget-content-area br-6">
						<a href="#" data-toggle="modal" data-target="#add-menu" class="btn btn-info">
							<i class="fa fa-2x fa-plus-circle"></i> New
						</a>
						<div class="table-responsive mb-4 mt-4">
							<table id="multi-column-ordering" class="table table-hover" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Name Menu</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($menu as $a)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $a['name_menu'] }}</td>
										<td>
											@if($a['status_menu']==1)
												<span class="badge badge-success"> Active </span>
											@else
												<span class="badge badge-danger"> Not Active </span>
											@endif
										</td>
										<td>
											<a title="edit" href="#" data-toggle="modal" data-target="#edit-menu" onclick="editMenu({{ $a['id_menu'] }})">
												<i class="fa fa-edit"></i>
											</a>
											<a title="delete" href="#" data-toggle="modal" data-target="#delete-menu" onclick="deleteMenu({{ $a['id_menu'] }})">
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
	
	
	<!-- Modal -->
	<div id="add-menu" class="text-center modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add New Menu</h5>
				</div>
				<div class="modal-body text-left">
					<form action="{{url('admin/menu/add_act')}}" method="post" class="mt-2">
						@csrf
						<div class="form-group">
							<input required name="name_menu" type="text" class="form-control" placeholder="Insert Name Menu">
						</div>
						<div class="form-group">
							<select name="status_menu" class="form-control">
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-plus-circle"></i> Add
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<div id="edit-menu" class="text-center modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Menu</h5>
				</div>
				<div class="modal-body text-left">
					<form action="{{url('admin/menu/edit_act')}}" method="post" class="mt-2">
						@csrf
						<input required type="hidden" name="id_menu" id="id_menu">
						<div class="form-group">
							<input required name="name_menu" id="name_menu" type="text" class="form-control" placeholder="Insert Name Menu">
						</div>
						<div class="form-group">
							<select name="status_menu" id="status_menu" class="form-control">
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-plus-circle"></i> Update
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	  
	<div id="delete-menu" class="text-center modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Remove Menu</h5>
				</div>
				<div class="modal-body text-left">
					<form action="{{url('admin/menu/delete_act')}}" method="post" class="mt-2">
						@csrf
						<input required type="hidden" name="id_menu" id="id_menu_r">
						<div class="form-group">
							<input readonly required name="name_menu" id="name_menu_r" type="text" class="form-control" placeholder="Insert Name Menu">
						</div>
						<div class="form-group">
							<select readonly name="status_menu" id="status_menu_r" class="form-control">
								<option value="1">Active</option>
								<option value="0">Not Active</option>
							</select>
						</div>
						<div class="form-group mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-plus-circle"></i> Remove
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	
	<script>
		function editMenu(idMenu)
		{
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id_menu:idMenu},
				cache:false,
				url:'{{url("admin/menu/detail")}}',
				success:function(result)
				{
					console.log(result);
					$("#id_menu").val(result[0].id_menu);
					$("#name_menu").val(result[0].name_menu);
					$("#status_menu").val(result[0].status_menu);
				}
			});
		}
		
		function deleteMenu(idMenu)
		{
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id_menu:idMenu},
				cache:false,
				url:'{{url("admin/menu/detail")}}',
				success:function(result)
				{
					$("#id_menu_r").val(result[0].id_menu);
					$("#name_menu_r").val(result[0].name_menu);
					$("#status_menu_r").val(result[0].status_menu);
				}
			});
		}
	</script>
	@endsection