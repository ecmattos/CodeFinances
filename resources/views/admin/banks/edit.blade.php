@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="row">
			{!! Form::model($bank, ['route' => ['admin.banks.update', $bank->id], 'method' => 'PUT', 'files' => true]) !!}

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
