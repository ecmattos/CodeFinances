@if($errors->any)
	<ul class="collection">
		<li>
			<h5>Opss...Favor verificar o(s) erro(s) abaixo:</h5>
		</li>
		@foreach($errors->all() as $error)
			<li class="collection-item red white-text">{{ $error }}</li>
		@endforeach
	</ul>
@endif