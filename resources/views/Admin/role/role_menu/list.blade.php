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
						<span>Role Menu List</span>
					</li>
				</ol>
			</nav>

			<div class="row layout-top-spacing" id="cancel-row">
				<div class="col-xl-12 col-lg-12 col-md-8 col-12 layout-spacing">
					<div class="widget-content-area br-4">
						<div class="widget-one">
							<h5>Role Menu List</h5>
						</div>
					</div>
				</div>
				<div class="col-xl-8 col-lg-8 col-sm-12  layout-spacing">
					<div class="widget-content widget-content-area br-6">
						<div class="table-responsive mb-4">
							<table id="multi-column-ordering" class="table table-hover" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Name Role</th>
										<th>Name Menu</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($role_menu as $a)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $a['role_id'] }}</td>
										<td>{{ $a['menu_id'] }}</td>
										<td>
											@if($a['status_role_menu']==1)
												<span class="badge badge-success"> Active </span>
											@else
												<span class="badge badge-danger"> Not Active </span>
											@endif
										</td>
										<td>
											<a title="edit" href="{{ url('admin/role/edit/'.$a['id_role_menu']) }}">
												<i class="fa fa-edit"></i>
											</a>
											<a title="delete" href="#" onclick="deleteRole({{ $a['id_role_menu'] }})">
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
	
	<script>
		function deleteAdmin(id)
		{
			var c = confirm("Are you sure remove this admin?");
			if(!c)
				return false;
			
			$.ajax({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				method:'POST',
				data: {id:id},
				cache:false,
				url:base_url+'/admin/admin/delete',
				success:function(result)
				{
					if(result == 1)
					{
						alert("Successfully Removed!");
					}
					else
					{
						alert("Failed Removed!");
					}
					location.reload();
				}
			});
		}
	</script>
	@endsection