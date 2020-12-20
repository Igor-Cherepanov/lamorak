@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                {{ Form::open(['url'=>route('users.currency-balances.index', $user),'method'=>'get']) }}
                <div class="row">
                    <div class="col-auto">
                        @include('form._input',[
                            'name'=>'search',
                            'placeholder'=>'Поиск',
                        ])

                    </div>
                    <div class="col-auto">
                        @include('form._select',[
                            'name'=>'ordering',
                            'text'=>'Сортировка',
                            'list'=>[
                                'name'=>'Название',
                                'id'=>'ID',
                            ]
                        ])
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="fas fa-fw fa-search"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-outline-danger" href="{{route('users.currency-balances.index', $user)}}">
                            <i class="far fa-window-close"></i>
                        </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="col-2 text-right">
                <a class="btn btn-outline-success" href="{{route('users.currency-balances.create', $user)}}">
                    Создать
                </a>
            </div>
        </div>

        @forelse($currencyBalances as $currency_balance)
            <div class="row">
                <div class="col-1">
                    # {{$currency_balance->getKey()}}
                </div>
                <div class="col-3">
                    <a class="text-primary" href="{{route('users.currency-balances.edit', compact('user','currency_balance'))}}">
                        {{$currency_balance->getCurrency()->getName()}}
                    </a>
                </div>
                <div class="col-6">
                    {{$currency_balance->getBalance()}} <span class="text-secondary">{{$currency_balance->getSubCurrencyName()}}</span>
                </div>
                <div class="col-2 text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary"
                           href="{{route('users.currency-balances.edit', compact('user','currency_balance'))}}"><i
                                class="fa fa-fw fa-edit"></i></a>
                        <button form="balance-delete-{{$currency_balance->getKey()}}"
                                onclick="return confirm('Вы уверены ?')"
                                class="btn btn-sm btn-outline-danger rounded-right"><i class="fas fa-trash-alt"></i>
                        </button>
                        {{Form::open(['url'=>route('users.currency-balances.destroy', compact('user','currency_balance')), 'method'=>'DELETE', 'id'=>'balance-delete-'.$currency_balance->getKey()])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <hr class="mb-2 mt-2">

        @empty
            <div class="alert alert-primary" role="alert">
                По запросу ничего не найдено
            </div>
        @endforelse
        @include('form._pagination',[
            'elements'=>$currencyBalances,
        ])
    </div>

@endsection
