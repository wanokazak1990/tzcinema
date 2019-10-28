<table class="table">
@foreach($cinemas as $itemCinema)
	@if(!isset($currentRoom))
		@php($currentRoom = $itemCinema->room)
		@php($currentDate = $itemCinema->seans_date)
		<tr class="text-danger">
			<th colspan="2">
				Зал {{$currentRoom}}
			</th>
			<th colspan="2" class="text-right">
				{{$currentDate}}
			</th>
		</tr>
	@endif

	@if( $currentRoom !== $itemCinema->room || $currentDate !== $itemCinema->seans_date )
		@php($currentRoom = $itemCinema->room)
		@php($currentDate = $itemCinema->seans_date)
		<tr class="text-danger">
			<th colspan="2">
				Зал {{$currentRoom}}
			</th>
			<th colspan="2" class="text-right">
				{{$currentDate}}
			</th>
		</tr>
	@endif
	

	<tr class="text-right">
		<td class="text-left">
			{{$itemCinema->name}}
		</td>

		<td style="width: 150px">
			{{$itemCinema->years}}
		</td>

		<td style="width: 150px">
			{{$itemCinema->price}}
		</td>

		<td style="width: 150px">
			{{$itemCinema->seans_time}}
		</td>
	</tr>
@endforeach
</table>