
@include('form._input', [
    'name'=>'name',
    'label'=>'Название',
    'value'=>isset($currency) ? $currency->getName():'',
])
