@forelse ($maintenanceRequests as $request)
	@php
	$isDoc = is_null($request->type) && isset($request->contractors['doc_type']);
	$exists = true;

	if ($isDoc) :
		$docPath = isset($request->contractors['file_path']) ? Storage::url($request->contractors['file_path']) : '#';
		$checkPath = str_replace('/storage', '/public', $docPath);
		$exists = Storage::exists($checkPath);
		if (! $exists) $docPath = '#';
	endif;

	$isPost = is_null($request->type) && $request->user_id === Auth::id();
	@endphp

	<a href="{{ $isDoc ? $docPath :
				($isPost ? route('maintenance.editPost', $request->id) :
				(Auth::user()->type != 0 ? '#' : route('maintenance.edit', $request->id))) }}"

		class="list-group-item list-group-item-action flex-column align-items-start{{ ! $exists ? ' list-group-item-danger' : '' }}"
		{!! $isDoc && $exists ? 'download="'. $request->title .'"' : '' !!}>
		<div class="d-flex w-100 justify-content-between">
			@if ($request->type)
			<h6 class="mb-1">Maintenance Issue #{{ $request->id }} has been Logged: <br><small>{{ array_search($request->type, $request::TYPES) }}</small></h6>

			@elseif (is_array($request->contractors) && isset($request->contractors['doc_type']))
			<h6 class="mb-1">Document <strong>{{ $request->title }}</strong> has been uploaded: <br><small>{{ $request->contractors['doc_type'] }}</small></h6>

			@else
			<h6 class="mb-1">Post #{{ $request->id }}: {{ $request->title }}</h6>
			@endif

			<small>{{ $request->created_at->diffForHumans() }}</small>
		</div>
		<p class="mb-1">{{ $request->description }}</p>

		@if($request->type)
		<span class="badge badge-secondary">{{ array_search($request->status, $request::STATUSES) }}</span>
		@endif
	</a>
@empty
	<h6>No requests found!</h6>
@endforelse