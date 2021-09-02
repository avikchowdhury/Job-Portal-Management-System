@extends('layouts.main')
@section('content')

<div class="container">
	<h2>Companies</h2>
	<div class="row">
		@foreach($companies as $company)
		<div class="col-md-3">

			<div class="card" style="width: 18rem;">
				@if(empty($company->logo))

			<img width="100" src="{{asset('avatar/man.jpg')}}"class="card-img-top">

			@else
			<img width="100" src="{{asset('uploads/logo')}}/{{$company->logo}}"class="card-img-top">


			@endif
			<div class="card-body">
			<h5 class="card-title text-center">{{$company->cname}}</h5>
			
			<center><a href="{{route('company.index',[$company->id,$company->slug])}}" class="btn btn-primary">View Company</a></center>
  </div>
</div>

		</div>
		@endforeach

	</div>
	<br><br><br>
			{{$companies->links()}}

</div>
@endsection