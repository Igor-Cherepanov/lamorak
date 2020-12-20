@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow p-3 mb-5 bg-white rounded">
            <div class="card-body m-4">
                <h1 class="mb-3">Обмен валюты</h1>
                <h5 class="mb-4">Выберите тип обмена</h5>
                <a class="btn btn-outline-dark btn-lg mt-2 mr-3" href="{{route('ex-cur.select-currencies', 1)}}">
                    Валюта в рубли
                </a>
                <a class="btn btn-outline-dark btn-lg mt-2 ml-3" href="{{route('ex-cur.select-currencies', 2)}}">
                    Рубли в валюту
                </a>
            </div>
        </div>
    </div>

@endsection
