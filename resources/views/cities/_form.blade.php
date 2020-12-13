
@include('form._input', [
    'name'=>'name',
    'label'=>'Название',
    'value'=>isset($city) ? $city->getName():'',
    'required'=>true,
])
