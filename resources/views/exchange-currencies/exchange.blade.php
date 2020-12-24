@extends('layouts.app')

@section('content')

    {{Form::open(['url'=>route('exchange-currencies.store'), 'method'=>'POST'])}}

    {{Form::hidden('action_id', $action_id)}}
    {{Form::hidden('currency_id', $currency->getKey())}}
    <div class="row justify-content-center">
        <div class="col-12 card shadow p-3 mb-5 bg-white">
            <div class="card-body m-4">
                @include('exchange-currencies._form')
                <div class="row justify-content-center mt-5">
                    <div class="col-auto">
                        <button class="btn btn-success" style="width: 300px">Обменять</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{Form::close()}}

@endsection

<script>
    window.onload = function (){
        let convert = document.getElementById('convert');
        let converted = document.getElementById('converted');
        let exchange_rate = document.getElementById('exchange_rate');

        convert.onchange = function (){
            converted.value = exchange_rate.value * convert.value;
        }

        $(function () {
            $("input").keydown(function () {
                // Save old value.
                if (!$(this).val() || (parseInt($(this).val()) <= parseInt($(this).attr('max')) && parseInt($(this).val()) >= 0))
                    $(this).data("old", $(this).val());
            });
            $("input").keyup(function () {
                // Check correct, else revert back to old value.
                if (!$(this).val() || (parseInt($(this).val()) <= parseInt($(this).attr('max')) && parseInt($(this).val()) >= 0))
                    ;
                else
                    $(this).val($(this).data("old"));
            });
        });
    }


</script>
