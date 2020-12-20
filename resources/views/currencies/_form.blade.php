
@include('form._input', [
    'name'=>'name',
    'label'=>'Название',
    'value'=>isset($currency) ? $currency->getName():'',
    'required'=>true,
])

@include('form._input', [
    'name'=>'exchange_rate',
    'label'=>'Стоимость (руб.)',
    'type'=>'number',
    'value'=>isset($currency) ? $currency->getExchangeRate():'',
    'required'=>true,
])

