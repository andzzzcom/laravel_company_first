@extends("Front.incl.layout")

	@section("content")
	<div class="row text-left cblue1">
		<div class="col-md-12 col-xs-12 fbold">
			<h3>
				<a href="{{ url('') }}">
					BestLists
				</a>
			</h3>
			<a href="{{ url('') }}">
				BL 
			</a>
			/ my account
		</div>
		
		<div class="col-md-3"></div>
		<div class="col-md-6 text-center col-xs-12 container-login cblack">
			<h5 class="fbold bggray p-10">
			{{ $message }}
			</h5>
			<h5>
				Questions/comments?  Please see our help pages.
			</h5>
		</div>
	</div>
	@endsection