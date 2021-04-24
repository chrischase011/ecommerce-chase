@extends('layouts.app')
@section('content')

<div class="container-fluid bg-light">
	<div class="container p-3">
		<h3>Notification</h3>
		<table class="table table-light">
			<thead>
				<th>Date</th>
				<th>Notification</th>
			</thead>
			<tbody>
				@foreach($notifs as $notif)
					<tr>
						<td>{{$notif->created_at}}</td>
						<td>{!! $notif->data !!}</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				{{$notifs->links()}}
			</tfoot>
		</table>
	</div>
</div>

@endsection