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
						<span>General Settings</span>
					</li>
				</ol>
			</nav>
				
			<div class="row" id="cancel-row">
				<div id="flStackForm" class="col-lg-6 layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>General Settings</h4>
								</div>                                                                        
							</div>
						</div>
						<div class="widget-content widget-content-area">
							@if($errors->any())
								@foreach($errors->all() as $err)
									<p> {{$err}} </p>
								@endforeach
							@endif
							<form method="post" enctype="multipart/form-data" action="{{ url('admin/setting/general') }}">
								@csrf
								<label for="titleWebsite">Title Website</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input value="{{$list[0]->title_web}}" placeholder="Insert Title Website" type="text" name="title_web" class="form-control" id="titleWebsite">
								</div>
								
								<label for="metaTitle">Meta Title</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input value="{{$list[0]->meta_title}}" placeholder="Insert Meta Title" type="text" name="meta_title" class="form-control" id="metaTitle">
								</div>
								
								<label for="metaKeywords">Meta Keywords</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input value="{{$list[0]->meta_keywords}}" placeholder="Insert Meta Keywords" type="text" name="meta_keywords" class="form-control" id="metaKeywords">
								</div>
								
								<label for="metaDescription">Meta Description</label>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-file"></i></span>
									</div>
									<input value="{{$list[0]->meta_description}}" placeholder="Insert Meta Description" type="text" name="meta_description" class="form-control" id="metaDescription">
								</div>	
								
								<div class="form-group">
									<label for="exampleInputuname">Url Facebook</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-file"></i></span>
										</div>
										<input type="text" value="{{ $list[0]->url_facebook }}" name="url_facebook" class="form-control" placeholder="Insert Url Facebook" aria-label="Url Facebook" aria-describedby="basic-addon1">
									</div>
								</div>	
													
								<div class="form-group">
									<label for="exampleInputuname">Url Twitter</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-file"></i></span>
										</div>
										<input type="text" value="{{ $list[0]->url_twitter }}" name="url_twitter" class="form-control" placeholder="Insert Url Twitter" aria-label="Url Twitter" aria-describedby="basic-addon1">
									</div>
								</div>	
													
								<div class="form-group">
									<label for="exampleInputuname">Url Instagram</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-file"></i></span>
										</div>
										<input type="text" value="{{ $list[0]->url_instagram }}" name="url_instagram" class="form-control" placeholder="Insert Url Instagram" aria-label="Url Instagram" aria-describedby="basic-addon1">
									</div>
								</div>	
													
								<div class="form-group">
									<label for="exampleInputuname">Url Youtube</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-file"></i></span>
										</div>
										<input type="text" value="{{ $list[0]->url_youtube }}" name="url_youtube" class="form-control" placeholder="Insert Url Youtube" aria-label="Url Youtube" aria-describedby="basic-addon1">
									</div>
								</div>	
								
								<label for="favicon">Favicon</label>
								<br>
								<img style="width:150px;height:auto" src="{{ asset('assets_admin/assets/theme1/images/settings/'.$list[0]->favicon_web) }}">
								<br>	
								<br>	
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-image"></i></span>
									</div>
									<br>
									<input type="file" class="form-control" name="favicon_web" id="favicon">
								</div>
								
								<label for="logoWebsite">Logo</label>
								<br>
								<img style="width:150px;height:auto" src="{{ asset('assets_admin/assets/theme1/images/settings/'.$list[0]->logo_web) }}">
								<br>	
								<br>	
								<div class="input-group mb-3">
									<div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5"><i class="fa fa-image"></i></span>
									</div>
									<br>
									<input type="file" class="form-control" name="logo_web" id="logoWebsite">
								</div>
								<a href="{{ url('admin/home') }}" class="btn btn-danger mt-3">
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