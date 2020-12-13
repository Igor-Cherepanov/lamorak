@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                {{ Form::open(['url'=>route('currencies.index'),'method'=>'get']) }}
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
                        <a class="btn btn-outline-danger" href="{{route('currencies.index')}}">
                            <i class="far fa-window-close"></i>
                        </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="col-2 text-right">
                <a class="btn btn-outline-success" href="{{route('currencies.create')}}">
                    Создать
                </a>
            </div>
        </div>

        @forelse($currencies as $currency)
            <div class="row">
                <div class="col-1">
                    # {{$currency->getKey()}}
                </div>
                <div class="col-9">
                    <a class="text-primary" href="{{route('currencies.edit', $currency)}}">
                        {{$currency->getName()}}
                    </a>
                </div>
                <div class="col-2 text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('currencies.edit', $currency)}}"><i
                                class="fa fa-fw fa-edit"></i></a>
                        <button form="news-delete-{{$currency->getKey()}}" onclick="return confirm('Вы уверены ?')"
                                class="btn btn-sm btn-outline-danger rounded-right"><i class="fas fa-trash-alt"></i></button>
                        {{Form::open(['url'=>route('currencies.destroy', $currency), 'method'=>'DELETE', 'id'=>'news-delete-'.$currency->getKey()])}}
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
            'elements'=>$currencies,
        ])
    </div>

@endsection
