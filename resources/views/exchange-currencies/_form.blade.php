@include('form._input', [
    'name'=>'f_name',
    'label'=>'Фамилия',
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getFName():'',
    'required'=>true,
])

@include('form._input', [
    'name'=>'l_name',
    'label'=>'Имя',
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getLName():'',
    'required'=>true,
])

@include('form._input', [
    'name'=>'m_name',
    'label'=>'Отчество',
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getMName():'',
    'required'=>true,
])

@include('form._input', [
    'name'=>'passport',
    'label'=>'Паспорт',
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getPassport():'',
    'required'=>true,
])

@include('form._select', [
    'name'=>'exchange_office_id',
    'label'=>'Обменный пункт',
    'list'=>$exchangeOfficeList,
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getExchangeOfficeId():'',
    'required'=>true,
])

@include('form._select', [
    'name'=>'currency_id',
    'label'=>'Валюта',
    'list'=>$currencyList,
    'value'=>isset($excahngeCurrency) ? $excahngeCurrency->getCurrencyId():'',
    'required'=>true,
])
