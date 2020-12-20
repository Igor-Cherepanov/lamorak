<?php
$user = auth()->user();
$currencyBalance = $user->getCurrencyBalance($currency->getKey());
?>

<div class="row">
    <div class="col-4">
        @include('form._input', [
    'name'=>'f_name',
    'label'=>'Фамилия',
    'value'=>$user->getFName(),
    'required'=>true,
])
    </div>
    <div class="col-4">
        @include('form._input', [
    'name'=>'l_name',
    'label'=>'Имя',
    'value'=>$user->getLName(),
    'required'=>true,
])
    </div>
    <div class="col-4">
        @include('form._input', [
    'name'=>'m_name',
    'label'=>'Отчество',
    'value'=>$user->getMName(),
    'required'=>true,
])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @include('form._input', [
    'name'=>'passport',
    'label'=>'Паспорт',
    'value'=>$user->getPassport(),
    'required'=>true,
])
    </div>
    <div class="col-6">
        @include('form._select', [
    'name'=>'exchange_office_id',
    'label'=>'Обменный пункт',
    'list'=>$exchangeOfficeList,
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getExchangeOfficeId():'',
    'required'=>true,
])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @include('form._input', [
            'name'=>$action_id === 1 ? 'sold_currency_count' : 'sold_rub_count',
            'label'=>$action_id === 1 ? 'Валюта ('.$currency->getName().')': 'Рубли',
            'type'=>'number',
            'value'=>'',
            'required'=>true,
            'id'=>'convert',
            'max'=>$action_id === 1 ? $currencyBalance->getBalance():$user->getRubCurrencyBalance()->getBalance(),
        ])
    </div>
    <div class="col-6">
        @include('form._input', [
            'name'=>$action_id === 1 ? 'bought_currency_count' : 'bought_rub_count',
            'label'=>$action_id === 1 ? 'Рубль' : 'Валюта ('.$currency->getName().')',
            'type'=>'number',
            'value'=>'',
            'required'=>true,
            'disabled'=>true,
            'id'=>'converted',
        ])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @if ($action_id === 1)
            <span>Ваш баланс: {{$currencyBalance->getBalance().' ('.$currencyBalance->getSubCurrencyName().')'}}</span>
        @else
            <span>Ваш баланс: {{$user->getRubCurrencyBalance()->getBalance().' ('.$user->getRubCurrencyBalance()->getSubCurrencyName().')'}}</span>
        @endif
    </div>
    <div class="col-6">
        @if ($action_id === 2)
            <span>Ваш баланс: {{$currencyBalance->getBalance().' ('.$currencyBalance->getSubCurrencyName().')'}}</span>
        @else
            <span>Ваш баланс: {{$user->getRubCurrencyBalance()->getBalance().' ('.$user->getRubCurrencyBalance()->getSubCurrencyName().')'}}</span>
        @endif
    </div>
</div>

{{Form::hidden('exchange_rate', $currency->getExchangeRate(), ['id'=>'exchange_rate'])}}

{{Form::hidden($action_id === 2 ? 'sold_currency_count' : 'sold_rub_count', 0)}}
{{Form::hidden($action_id === 2 ? 'bought_currency_count' : 'bought_rub_count', 0)}}
