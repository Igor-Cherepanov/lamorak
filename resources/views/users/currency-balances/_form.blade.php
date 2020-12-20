
@include('form._input', [
    'name'=>'balance',
    'label'=>'Баланс',
    'value'=>isset($currency_balance) ? $currency_balance->getBalance():'',
    'required'=>true,
])

@include('form._select', [
    'name'=>'currency_id',
    'label'=>'Валюта',
    'list'=>$currencyList,
    'value'=>isset($currency_balance) ? $currency_balance->getCurrencyId():'',
    'required'=>true,
])

