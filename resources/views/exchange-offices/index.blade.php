@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                {{ Form::open(['url'=>route('exchange-offices.index'),'method'=>'get']) }}
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
                        <a class="btn btn-outline-danger" href="{{route('exchange-offices.index')}}">
                            <i class="far fa-window-close"></i>
                        </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="col-2 text-right">
                <a class="btn btn-outline-success" href="{{route('exchange-offices.create')}}">
                    Создать
                </a>
            </div>
        </div>

        @forelse($exchangeOffices as $exchangeOffice)
            <div class="row">
                <div class="col-1">
                    # {{$exchangeOffice->getKey()}}
                </div>
                <div class="col-3">
                    <a class="text-primary" href="{{route('exchange-offices.edit', $exchangeOffice)}}">
                        {{$exchangeOffice->getName()}}
                    </a>
                </div>
                <div class="col-6 text-secondary">
                    {{$exchangeOffice->getBank()->getName()}}
                </div>
                <div class="col-2 text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('exchange-offices.edit', $exchangeOffice)}}"><i
                                class="fa fa-fw fa-edit"></i></a>
                        <button form="news-delete-{{$exchangeOffice->getKey()}}" onclick="return confirm('Вы уверены ?')"
                                class="btn btn-sm btn-outline-danger rounded-right"><i class="fas fa-trash-alt"></i></button>
                        {{Form::open(['url'=>route('exchange-offices.destroy', $exchangeOffice), 'method'=>'DELETE', 'id'=>'news-delete-'.$exchangeOffice->getKey()])}}
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
            'elements'=>$exchangeOffices,
        ])
    </div>

@endsection
