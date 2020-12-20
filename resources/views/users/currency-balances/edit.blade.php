@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-8">
            {{Form::model($currency_balance, ['url'=>route('users.currency-balances.update', compact('user', 'currency_balance')), 'method'=>'PATCH'])}}

            @include('users.currency-balances._form')
            <button class="btn btn-success mt-4 btn-block mb-5">
                Сохранить
            </button>

            {{Form::close()}}

        </div>
    </div>

@endsection
