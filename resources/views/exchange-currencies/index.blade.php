@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                {{ Form::open(['url'=>route('exchange-currencies.index'),'method'=>'get']) }}
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
                        <a class="btn btn-outline-danger" href="{{route('exchange-currencies.index')}}">
                            <i class="far fa-window-close"></i>
                        </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="col-2 text-right">
                <a class="btn btn-outline-success" href="{{route('exchange-currencies.create')}}">
                    Создать
                </a>
            </div>
        </div>

        @forelse($exchangeCurrencies as $exchangeCurrency)
            <div class="row">
                <div class="col-1">
                    # {{$exchangeCurrency->getKey()}}
                </div>
                <div class="col-9">
                    <a class="text-primary" href="{{route('exchange-currencies.edit', $exchangeCurrency)}}">
                        {{$exchangeCurrency->getName()}}
                    </a>
                </div>
                <div class="col-2 text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('exchange-currencies.edit', $exchangeCurrency)}}"><i
                                class="fa fa-fw fa-edit"></i></a>
                        <button form="news-delete-{{$exchangeCurrency->getKey()}}" onclick="return confirm('Вы уверены ?')"
                                class="btn btn-sm btn-outline-danger rounded-right"><i class="fas fa-trash-alt"></i></button>
                        {{Form::open(['url'=>route('exchange-currencies.destroy', $exchangeCurrency), 'method'=>'DELETE', 'id'=>'news-delete-'.$exchangeCurrency->getKey()])}}
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
            'elements'=>$exchangeCurrencies,
        ])
    </div>

@endsection
