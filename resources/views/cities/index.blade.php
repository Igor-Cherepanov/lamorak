@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                {{ Form::open(['url'=>route('cities.index'),'method'=>'get']) }}
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
                        <a class="btn btn-outline-danger" href="{{route('cities.index')}}">
                            <i class="far fa-window-close"></i>
                        </a>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="col-2 text-right">
                <a class="btn btn-outline-success" href="{{route('cities.create')}}">
                    Создать
                </a>
            </div>
        </div>

        @forelse($cities as $city)
            <div class="row">
                <div class="col-1">
                    # {{$city->getKey()}}
                </div>
                <div class="col-9">
                    <a class="text-primary" href="{{route('cities.edit', $city)}}">
                        {{$city->getName()}}
                    </a>
                </div>
                <div class="col-2 text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-outline-secondary" href="{{route('cities.edit', $city)}}"><i
                                class="fa fa-fw fa-edit"></i></a>
                        <button form="news-delete-{{$city->getKey()}}" onclick="return confirm('Вы уверены ?')"
                                class="btn btn-sm btn-outline-danger rounded-right"><i class="fas fa-trash-alt"></i></button>
                        {{Form::open(['url'=>route('cities.destroy', $city), 'method'=>'DELETE', 'id'=>'news-delete-'.$city->getKey()])}}
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
            'elements'=>$cities,
        ])
    </div>

@endsection
