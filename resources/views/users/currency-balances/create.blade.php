@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">
            {{Form::open(['url'=>route('users.currency-balances.store', $user), 'method'=>'POST'])}}

            @include('users.currency-balances._form')
            <button class="btn btn-success mt-4 btn-block mb-5">
                Сохранить
            </button>

            {{Form::close()}}
        </div>
    </div>

@endsection
