<?php if(isset($Data)) $Contact = $Data->contact; ?>
<h6 class="text-uppercase mt-3">Dados de Contato</h6>
<hr class="hr-sm mb-2">
<div class="form-row">
    <div class="form-group col-md-4">
        {!! Html::decode(Form::label('email_contact', 'Email', array('class' => 'col-form-label'))) !!}
        {{Form::text('email_contact', old('email_contact',((isset($Contact)) ? $Contact->email_contact : '')), ['id' => 'email_contact', 'placeholder' => 'Email', 'maxlength'=>'100','class'=>'form-control'])}}
    </div>
    <div class="form-group col-md-4">
        {!! Html::decode(Form::label('phone', 'Whatsapp', array('class' => 'col-form-label'))) !!}
        {{Form::text('phone', old('phone',((isset($Contact)) ? $Contact->phone : '')), ['id' => 'phone', 'placeholder' => 'Whatsapp', 'class'=>'form-control show-phone'])}}
    </div>
    <div class="form-group col-md-4">
        {!! Html::decode(Form::label('cellphone', 'Celular', array('class' => 'col-form-label'))) !!}
        {{Form::text('cellphone', old('cellphone',((isset($Contact)) ? $Contact->cellphone : '')), ['id' => 'cellphone', 'placeholder' => 'Celular', 'class'=>'form-control show-cellphone'])}}
    </div>
</div>
