@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
@endsection

@section('configura_inscricao')
<div class="row">
   <div class="col-md-8 col-md-offset-2">
      {!! Form::open(array('route' => 'configura.inscricao','data-parsley-validate' => '' ,'enctype' => 'multipart/form-data')) !!}
        <div class="form-group row">
            {!! Form::label('inicio_inscricao', 'Início da Inscrição', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('inicio_inscricao', null, ['class' => 'form-control', 'required' => '']) !!}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('fim_inscricao', 'Fim da Inscrição', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('fim_inscricao', null, ['class' => 'form-control', 'required' => '']) !!}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('prazo_carta', 'Prazo da Carta', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('prazo_carta', null, ['class' => 'form-control', 'required' => '']) !!}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('data_homologacao', 'Data da Homologação', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('data_homologacao', null, ['class' => 'form-control', 'required' => '']) !!}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('data_divulgacao_resultado', 'Data de Divulgação', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('data_divulgacao_resultado', null, ['class' => 'form-control', 'required' => '']) !!}
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="form-group row">
            {!! Form::label('edital', 'Edital', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
                {!! Form::text('edital', null, ['class' => 'form-control', 'required' => '']) !!}
            </div>
          </div> --}}
          <div class="form-group row">
            {!! Form::label('recomendante', 'Necessita de recomendante?', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('necessita_recomendante', 1, true, ['id' => 'necessita_recomendante_0', 'class' => 'custom-control-input', 'required' => '']) !!}
                <label for="necessita_recomendante_0" class="custom-control-label">Sim</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                {!! Form::radio('necessita_recomendante', 0, false, ['id' => 'necessita_recomendante_1', 'class' => 'custom-control-input', 'required' => '']) !!}
                <label for="necessita_recomendante_1" class="custom-control-label">Não</label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('numero_cartas', 'Número de cartas:', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('numero_cartas', null, ['class' => 'form-control']) !!}
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('scripts')
  {!! Html::script( asset('js/parsley.min.js') ) !!}
  {!! Html::script( asset('js/pt-br.js') ) !!}
  {!! Html::script( asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js')) !!}
  {!! Html::script( asset('js/datepicker.js') ) !!}
@endsection