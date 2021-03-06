@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h1 class="text-center">Basic Details</h1>
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			<hr>

			<form method="POST" action="{{ route('maintenance.store') }}">
				@csrf
				<div class="form-group row">
					<label for="title" class="col-md-4 col-form-label text-md-right">Issue Title</label>
					<div class="col-md-6">
						<input
							id="title"
							type="text"
							name="title"
							value=""
							required="required"
							autofocus="autofocus"
							class="form-control"
						/>
					</div>
				</div>
				<div class="form-group row">
					<label for="type" class="col-md-4 col-form-label text-md-right">Issue Type</label>
					<div class="col-md-6">
						<select name="type" id="type" required="required" class="form-control">
							@foreach ($types as $key => $type)
								<option value="{{ $key }}">{{ $type }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="description" class="col-md-4 col-form-label text-md-right">Issue Description</label>
					<div class="col-md-6">
						<textarea name="description" id="description" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<button class="btn btn-primary">Submit Request</button>
						<button class="btn btn-danger">Cancel</button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>
@endsection
