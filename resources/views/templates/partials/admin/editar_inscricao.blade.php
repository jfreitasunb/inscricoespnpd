@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
@endsection

@section('editar_inscricao')
<div class="row">
   <div class="col-md-8 col-md-offset-2">
      {!! Form::open(array('route' => 'editar.inscricao','data-parsley-validate' => '')) !!}
      {!! Form::hidden('id_inscricao_pnpd', $edital_vigente->id_inscricao_pnpd, []) !!}
        <div class="form-group row">
            {!! Form::label('inicio_inscricao', 'Início da Inscrição', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('inicio_inscricao', $edital_vigente->inicio_inscricao, ['class' => 'form-control', 'required' => '']) !!}
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('fim_inscricao', 'Fim da Inscrição', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('fim_inscricao', $edital_vigente->fim_inscricao, ['class' => 'form-control', 'required' => '']) !!}
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('prazo_carta', 'Prazo da Carta', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('prazo_carta', $edital_vigente->prazo_carta, ['class' => 'form-control', 'required' => '']) !!}
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('data_homologacao', 'Data da Homologação', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('data_homologacao', $edital_vigente->data_homologacao, ['class' => 'form-control', 'required' => '']) !!}
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('data_divulgacao_resultado', 'Data de Divulgação', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('data_divulgacao_resultado', $edital_vigente->data_divulgacao_resultado, ['class' => 'form-control', 'required' => '']) !!}
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
            {!! Form::label('necessita_recomendante', 'Necessita de Recomendante?', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('necessita_recomendante', $edital_vigente->necessita_recomendante? 'Sim' : 'Não', ['class' => 'form-control']) !!}
              </div>
            </div>
          </div>
          <div class="form-group row">
            {!! Form::label('numero_cartas', 'Necessita de Recomendante?', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="input-group">
                {!! Form::text('numero_cartas', $edital_vigente->numero_cartas? 'Sim' : 'Não', ['class' => 'form-control']) !!}
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
@endsection