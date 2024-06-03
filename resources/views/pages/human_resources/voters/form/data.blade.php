<!--
|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
| Form row
|‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
!-->

<div class="card-body">

    <div class="form-row">
        <div class="form-group col-md-12">
            {!! Html::decode(Form::label('name', 'Foto *', array('class' => 'col-form-label'))) !!}
            {{Form::text('name', old('name',(isset($Data) ? $Data->name : "")), ['id'=>'social_reason','placeholder'=>'Foto *','class'=>'form-control','minlength'=>'3', 'maxlength'=>'200', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-6">
            {!! Html::decode(Form::label('name', 'Nome completo *', array('class' => 'col-form-label'))) !!}
            {{Form::text('name', old('name',(isset($Data) ? $Data->name : "")), ['id'=>'social_reason','placeholder'=>'Nome completo *','class'=>'form-control','minlength'=>'3', 'maxlength'=>'200', 'required'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-6">
            {!! Html::decode(Form::label('surname', 'Apelido', array('class' => 'col-form-label'))) !!}
            {{Form::text('surname', old('surname',(isset($Data) ? $Data->surname : "")), ['id'=>'surname','placeholder'=>'Apelido','class'=>'form-control','maxlength'=>'200'])}}
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cnpj', 'Data nasc', array('class' => 'col-form-label'))) !!}
            {{Form::text('cnpj', old('cnpj',(isset($Data) ? $Data->cnpj : "")), ['id'=>'cnpj','placeholder'=>'Data nasc','class'=>'form-control show-date','maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cnpj', 'Idade aprox.', array('class' => 'col-form-label'))) !!}
            {{Form::text('cnpj', old('cnpj',(isset($Data) ? $Data->cnpj : "")), ['id'=>'cnpj','placeholder'=>'Idade aprox.','class'=>'form-control','maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cnpj', 'Instagram', array('class' => 'col-form-label'))) !!}
            {{Form::text('cnpj', old('cnpj',(isset($Data) ? $Data->cnpj : "")), ['id'=>'cnpj','placeholder'=>'Instagram','class'=>'form-control','maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cnpj', 'Tit eleitor zona', array('class' => 'col-form-label'))) !!}
            {{Form::text('cnpj', old('cnpj',(isset($Data) ? $Data->cnpj : "")), ['id'=>'cnpj','placeholder'=>'Tit eleitor zona','class'=>'form-control','maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cpf', 'Tit eleitor seção', array('class' => 'col-form-label'))) !!}
            {{Form::text('cpf', old('cpf',(isset($Data) ? $Data->cpf : "")), ['id'=>'cpf','placeholder'=>'Tit eleitor seção','class'=>'form-control show-cpf', 'maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cpf', 'CPF', array('class' => 'col-form-label'))) !!}
            {{Form::text('cpf', old('cpf',(isset($Data) ? $Data->cpf : "")), ['id'=>'cpf','placeholder'=>'CPF','class'=>'form-control show-cpf', 'maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-2">
            {!! Html::decode(Form::label('cpf', 'Falecido?', array('class' => 'col-form-label'))) !!}
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label">Sim</label>
            </div>
        </div>
        <div class="form-group col-md-4">
            {!! Html::decode(Form::label('cnpj', 'Data falecimento', array('class' => 'col-form-label'))) !!}
            {{Form::text('cnpj', old('cnpj',(isset($Data) ? $Data->cnpj : "")), ['id'=>'cnpj','placeholder'=>'Data falecimento','class'=>'form-control show-date','maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            {!! Html::decode(Form::label('cpf', 'Função social histórico', array('class' => 'col-form-label'))) !!}
            {{Form::textarea('cpf', old('cpf',(isset($Data) ? $Data->cpf : "")), ['id'=>'cpf','placeholder'=>'Função social histórico','class'=>'form-control', 'maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <h6 class="text-uppercase mt-3">Votos</h6>
    <hr class="hr-sm mb-2">
    <div class="form-row">
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cpf', 'Estimativa votos', array('class' => 'col-form-label'))) !!}
            {{Form::text('cpf', old('cpf',(isset($Data) ? $Data->cpf : "")), ['id'=>'cpf','placeholder'=>'Estimativa votos','class'=>'form-control', 'maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-3">
            {!! Html::decode(Form::label('cpf', 'Grau de certeza de voto', array('class' => 'col-form-label'))) !!}
            {{Form::text('cpf', old('cpf',(isset($Data) ? $Data->cpf : "")), ['id'=>'cpf','placeholder'=>'Grau de certeza de voto','class'=>'form-control', 'maxlength'=>'20'])}}
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-2">
            {!! Html::decode(Form::label('cpf', 'Apoiador?', array('class' => 'col-form-label'))) !!}
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label">Sim</label>
            </div>
        </div>
        <div class="form-group col-md-2">
            {!! Html::decode(Form::label('cpf', 'Cabo eleitoral?', array('class' => 'col-form-label'))) !!}
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label">Sim</label>
            </div>
        </div>
    </div>


    @include('pages.human_resources.forms.contact', ['Contact' => (isset($Data) ? $Data->contact : NULL)])

    @include('pages.human_resources.forms.address', ['Address' => (isset($Data) ? $Data->address : NULL)])




    <footer class="card-footer text-right">
        <button class="btn btn-primary" type="submit">Salvar</button>
    </footer>
</div>

