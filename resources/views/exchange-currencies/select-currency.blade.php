@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        @forelse($currencies as $currency)
            @if (auth()->user()->getCurrencyBalances()->where('currency_id', '=', $currency->getKey())->first() !== null)
                <div class="col-3 card shadow p-3 mb-5 bg-white rounded m-3">
                    <div class="card-body m-4">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h5 class="mb-3">Валюта</h5>
                            </div>
                            <div class="col-auto">
                                <h5 class="mb-3">{{$currency->getName()}}</h5>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h6 class="mb-3">Курс</h6>
                            </div>
                            <div class="col-auto">
                                <h6 class="mb-3">{{$currency->getExchangeRate()}}(руб.)</h6>
                            </div>
                        </div>
                        <a class="col-12 btn btn-outline-dark btn-lg mt-2 mr-3" href="{{route('ex-cur.exchange', compact('action_id', 'currency'))}}">
                            Обменять
                        </a>
                    </div>
                </div>
            @endif
        @empty
        @endforelse
    </div>

@endsection
