@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row">
			{!! Form::open(['route' => 'admin.banks.store', 'files' => true]) !!}

			    @include('admin.banks._form')

			    <div class="row">
					<div class="input-field col s6">
						{!! Form::submit('Confirmar',['class' => 'btn waves-effect right']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>		
	</div>
@endsection
