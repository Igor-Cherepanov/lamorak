
@include('form._input', [
    'name'=>'name',
    'label'=>'Название',
    'value'=>isset($bank) ? $bank->getName():'',
    'required'=>true,
])

@include('form._select', [
    'name'=>'city_id',
    'label'=>'Город',
    'list'=>$cities,
    'value'=>isset($bank) ? $bank->getCityId():'',
    'required'=>true,
])
