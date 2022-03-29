@section("header")
<!DOCTYPE html>
<html lang="en">
@show

	@section("header_settings")		
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
		
		<meta name="description" content="{{$set['meta_description']}}">
		<meta name="keywords" content="{{$set['meta_keywords']}}">
		<meta name="title" content="{{$set['meta_title']}}">
		
		<title>Admin Panel </title>
		<link rel="icon" type="image/x-icon" href="{{ asset('assets_admin/assets/theme1/images/settings/'.$set['favicon_web'] ) }}"/>
		<link href="{{ asset('assets_admin/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
		<script src="{{ asset('assets_admin/assets/js/loader.js') }}"></script>
		
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
		<link href="{{ asset('assets_admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets_admin/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
		<!-- END GLOBAL MANDATORY STYLES -->

		<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
		<link href="{{ asset('assets_admin/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('assets_admin/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
		<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
		
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/table/datatable/datatables.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/assets/css/forms/theme-checkbox-radio.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/table/datatable/dt-global_style.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/flatpickr/flatpickr.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/flatpickr/custom-flatpickr.css') }}">
		<!-- END PAGE LEVEL STYLES -->
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/table/datatable/custom_dt_html5.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/plugins/table/datatable/dt-global_style.css') }}">
		
		<script>
			var base_url = "{{ url('/') }}";
		</script>
		<link rel="stylesheet" href="{{ url('assets_admin/assets/theme1/fontawesome/css/all.css') }}">
		<link rel="stylesheet" href="{{ url('assets_admin/assets/css/forms/switches.css') }}">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
		<script src="{{ asset('assets_admin/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
		<style>
			body{
				font-weight:bold;
				font-size:14px
			}
		
		</style>
	</head>
	@show
	
	<body>
		@include("Admin.incl.header")
		
		
		<!--  BEGIN MAIN CONTAINER  -->
		<div class="main-container sidebar-closed sbar-open" id="container">
			<div class="overlay"></div>
			<div class="cs-overlay"></div>
			<div class="search-overlay"></div>
			@include("Admin.incl.sidebar")
			@include("Admin.incl.content")
			@include("Admin.incl.footer")
	
			<!-- Modal -->
			<div id="edit-q" class="modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
			<div id="edit-settings" class="modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
		</div>
		<!-- END MAIN CONTAINER -->
	
		@section("footer")
		<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
		<script src="{{ asset('assets_admin/bootstrap/js/popper.min.js') }}"></script>
		<script src="{{ asset('assets_admin/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets_admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
		<script src="{{ asset('assets_admin/assets/js/app.js') }}"></script>
		<script>
			$(document).ready(function() {
				App.init();
			});
		</script>
		<script src="{{ asset('assets_admin/assets/theme1/js/custom.js') }}"></script>
		<script src="{{ asset('assets_admin/assets/theme1/js/sidebar.js') }}"></script>
		<!-- END GLOBAL MANDATORY SCRIPTS -->

		<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
		<script src="{{ asset('assets_admin/plugins/apex/apexcharts.min.js') }}"></script>
		<script src="{{ asset('assets_admin/assets/js/dashboard/dash_1.js') }}"></script>
		<script src="{{ asset('assets_admin/plugins/flatpickr/flatpickr.js') }}"></script>
		<script src="{{ asset('assets_admin/plugins/flatpickr/custom-flatpickr.js') }}"></script>
		<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
		<script src="https://cdn.tiny.cloud/1/fhnoed7d1ma1lwlv63sxi0cewm87ryjrkftxzznak19714pe/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		
		<script src="https://momentjs.com/downloads/moment.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
		
		
		<script>
			tinymce.init({
				selector: '#textareas, #textareas2',
				height:'350px',
				plugins: [ "paste code" ],
				entity_encoding : 'raw',
				force_br_newlines : true,
				force_p_newlines : false,
				forced_root_block : false,
				paste_as_text: true
			}); 
			$('#edit-settings').on('hide.bs.modal', function () {
				tinymce.remove('#edit-settings textarea');
			});
			flatpickr(document.getElementById('basicFlatpickr'), {
				//enableTime: true,
				//dateFormat: "Y-m-d H:i:ss",
			});

		</script>

		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="{{ asset('assets_admin/plugins/table/datatable/datatables.js') }}"></script>
		
		<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
		<script src="{{ asset('assets_admin/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('assets_admin/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>    
		<script src="{{ asset('assets_admin/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('assets_admin/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
	
		<script>
			$('#multi-column-ordering').DataTable({
				"oLanguage": {
					"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
					"sInfo": "Showing page _PAGE_ of _PAGES_",
					"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
					"sSearchPlaceholder": "Search...",
				   "sLengthMenu": "Results :  _MENU_",
				},
				"stripeClasses": [],
				"lengthMenu": [50, 150, 500, 1500],
				"pageLength": 50,
				columnDefs: [ {
					targets: [ 0 ],
					orderData: [ 0, 1 ]
				}, {
					targets: [ 1 ],
					orderData: [ 1, 0 ]
				}, {
					targets: [ 2 ],
					orderData: [ 2, 0 ]
				} ]
			});
						
			$('#table-data-export').DataTable( {
				dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
				buttons: {
					buttons: [            
						{ extend: 'excel', className: 'btn' },
						{ extend: 'csv', className: 'btn' },
					]
				},
				"oLanguage": {
					"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
					"sInfo": "Showing page _PAGE_ of _PAGES_",
					"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
					"sSearchPlaceholder": "Search...",
				},
				"stripeClasses": [],
				"lengthMenu": [100, 500, 1000, 5000],
				"pageLength": 25
			} );
			
			$('.tools').select2();
			$(".tools").on("select2:select", function (evt) {
				var element = evt.params.data.element;
				var $element = $(element);
			  
				$element.detach();
				$(this).append($element);
				$(this).trigger("change");
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
		@show

	</body>
</html>