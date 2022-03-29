
	<!--  BEGIN SIDEBAR  -->
	<div class="sidebar-wrapper sidebar-theme">
		
		<nav id="sidebar">

			<ul class="navbar-nav theme-brand flex-row  text-center">
				<li class="nav-item theme-logo">
					<a href="{{ url('admin/home') }}">
						<img style="margin:3px;width:40px;height:auto;" src="{{asset('assets_admin/assets/theme1/images/settings/'.$set['logo_web'])}}"><br>
                    </a>
				</li>
				<li class="nav-item theme-text">
					<a href="{{ url('admin/home') }}" class="nav-link" style="font-size:24px !important"> 
						{{$set["title_web"]}} 
					</a>
				</li>
			</ul>

			<ul class="list-unstyled menu-categories" id="accordionExample">
				<li class="menu">
					<a href="#dashboard" id="dashboard-menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
							<span>Dashboard</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/home') }}"> Home </a>
						</li>
					</ul>
				</li>
				
				<li class="menu menu-heading">
					<div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>Administrative Dashboard</span></div>
				</li>

				<li class="menu">
					<a href="{{ url('admin/home') }}" aria-expanded="true" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
							<span>Dashboard</span>
						</div>
					</a>
				</li>
			
			@php
				$check		= true;
				$deps 		= false;
				$dess 		= false;
				$emps	 	= false;
				$projs		= false;
				$leaves		= false;
				$admins		= false;
				$settings	= false;
				$dep 		= "admin/department";
				$des 		= "admin/designation";
				$emp	 	= "admin/employee";
				$proj		= "admin/project";
				$leave		= "admin/leave";
				$admin 		= "admin/admin";
				$setting	= "admin/setting";
			@endphp
			@foreach($set['role_menu'] as $t)
				@if($dep==$t["name_menu"])
					@php
						$deps = true;
					@endphp
				@endif
				@if($des==$t["name_menu"])
					@php
						$dess = true;
					@endphp
				@endif
				@if($emp==$t["name_menu"])
					@php
						$emps = true;
					@endphp
				@endif
				@if($proj==$t["name_menu"])
					@php
						$projs = true;
					@endphp
				@endif
				@if($leave==$t["name_menu"])
					@php
						$leaves = true;
					@endphp
				@endif
				@if($admin==$t["name_menu"])
					@php
						$admins = true;
					@endphp
				@endif
				@if($setting==$t["name_menu"])
					@php
						$settings = true;
					@endphp
				@endif
			@endforeach

			@if(($check == $deps) || ($check == $dess))
				<li class="menu">
					<a href="#deps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
							<span>Department</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
			
					<ul class="collapse submenu list-unstyled" id="deps" data-parent="#accordionExample">
						@if($check == $deps)
						<li>
							<a href="#deps-one" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
								Department 
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> 
							</a>
							<ul class="collapse list-unstyled sub-submenu" id="deps-one" data-parent="#deps"> 
								<li>
									<a href="{{url('admin/department/add')}}"> Add New </a>
								</li>
								<li>
									<a href="{{url('admin/department')}}"> List Departments </a>
								</li>
							</ul>
						</li>
						@endif
						
						@if($check == $dess)
						<li>
							<a href="#dess-one" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> 
								Designation 
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> 
							</a>
							<ul class="collapse list-unstyled sub-submenu" id="dess-one" data-parent="#deps"> 
								<li>
									<a href="{{url('admin/designation/add')}}"> Add New </a>
								</li>
								<li>
									<a href="{{url('admin/designation')}}"> List Departments </a>
								</li>
							</ul>
						</li>
						@endif
						
					</ul>
				</li>
			@endif
			
			@if($check == $emps)
				<li class="menu">
					<a href="#employee" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
							<span>Employee</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="employee" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/employee/add') }}"> Add Employee </a>
						</li>
						<li>
							<a href="{{ url('admin/employee') }}"> List Employees </a>
						</li>
					</ul>
				</li>
			@endif

			@if($check == $projs)
				<li class="menu">
					<a href="#project" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
							<span>Projects</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="project" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/project/add') }}"> Add Project </a>
						</li>
						<li>
							<a href="{{ url('admin/project') }}"> List Projects </a>
						</li>
						<li>
							<a href="{{ url('admin/project/category') }}"> Project Categories </a>
						</li>
					</ul>
				</li>
			@endif

			@if($check == $leaves)
				<li class="menu">
					<a href="#leaves" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
							<span>Leaves</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="leaves" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/leave/add') }}"> Add Leave </a>
						</li>
						<li>
							<a href="{{ url('admin/leave') }}"> List Leaves </a>
						</li>
					</ul>
				</li>
			@endif

			@if($check == $admins)
				<li class="menu">
					<a href="#admin" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							<span>Admin</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="admin" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/admin/add') }}"> Add New </a>
						</li>
						<li>
							<a href="{{ url('admin/admin') }}"> List Admin </a>
						</li>
						<li>
							<a href="{{ url('admin/role') }}"> List Role </a>
						</li>
						<li class="d-none">
							<a href="{{ url('admin/menu') }}"> List Menu </a>
						</li>
					</ul>
				</li>
			@endif
			
			@if($check == $settings)

				<li class="menu">
					<a href="#Settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
						<div class="">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
							<span>Settings</span>
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
						</div>
					</a>
					<ul class="collapse submenu list-unstyled" id="Settings" data-parent="#accordionExample">
						<li>
							<a href="{{ url('admin/setting/general') }}"> General </a>
						</li>
						<li>
							<a href="{{ url('admin/setting/logs') }}"> Logs </a>
						</li>
						<li>
							<a href="{{ url('admin/setting/email') }}"> Email </a>
						</li>
					</ul>
				</li>
			@endif
				
				
			</ul>
			
		</nav>

	</div>
	<!--  END SIDEBAR  -->