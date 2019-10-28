@extends('layouts.app')

@section('content')
@if(isset($cinemas))
<div class="container pb-5">
	<form>
	<div class="row">
		
			<div class="col-2">
				<label>Рейтинг</label>
				<select name="years" class="form-control">
					<option selected="" value="">Рейтинг</option>
					@foreach($ratings as $rating)
						<option value="{{$rating}}"> {{$rating}} </option>
					@endforeach
				</select>
			</div>

			<div class="col-2">
				<label>Цена от:</label>
				<input type="number" name="price" class="form-control">
			</div>

			<div class="col-2">
				<label>Время от:</label>
				<input type="time" name="seans_time" class="form-control">
			</div>

			<div class="col-2">
				<label>&nbsp</label>
				<button class="btn btn-primary form-control" id="sendFilter" type="button" data-url="{{route('cinema.search')}}">Найти</button>
			</div>
		
	</div>
	</form>
</div>

<div class="container afisha">
	@include('cinema.afisha')
</div>
@endif
@endsection