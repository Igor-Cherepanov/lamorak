@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">

            {{Form::model($bank, ['url'=>route('banks.update', $bank), 'method'=>'PATCH'])}}

            @include('banks._form')
            <button class="btn btn-success mt-4 btn-block mb-5">
                Сохранить
            </button>

            {{Form::close()}}

        </div>
    </div>

@endsection
