
@include('form._input', [
    'name'=>'name',
    'label'=>'Название',
    'value'=>isset($exchangeOffice) ? $exchangeOffice->getName():'',
    'required'=>true,
])

@include('form._select', [
    'name'=>'bank_id',
    'label'=>'Банк',
    'list'=>$banks,
    'value'=>isset($exchangeOffice) ? $exchangeOffice->getbankId():'',
    'required'=>true,
])
