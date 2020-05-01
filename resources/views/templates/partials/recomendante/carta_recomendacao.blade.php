@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
  {!! Html::style( asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ) !!}
  {!! Html::style( asset('bower_components/moment/locale/fr.js') ) !!}
@endsection

@section('carta_recomendacao')
  <div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
      <legend class="text-center">{{ trans('tela_carta_recomendacao.titulo_principal') }}</legend>
      <div class="col-10 col-md-10 col-lg-10">
        {!! Form::open(array('route' => array('salva.carta', 'link_acesso'=> $link_acesso, 'reco' => $reco), 'class' => 'form-horizontal', 'data-parsley-validate' => '' )) !!}
          <fieldset class="scheduler-border">
          <legend class="scheduler-border">{{ trans('tela_carta_recomendacao.carta_candidato').$dados_candidato['nome_candidato'] }}</legend>
          <div class="form-group">
            {!! form::label(trans('tela_carta_recomendacao.nome_recomendante')) !!}
            {!! Form::text('nome_recomendante', $dados_recomendante['nome_recomendante'] ? : '', ['class' => 'form-control', 'required' => '']) !!}
          </div>
          <div class="form-group">
            {!! form::label(trans('tela_carta_recomendacao.instituticao_recomendante')) !!}
            {!! Form::text('instituicao', $dados_recomendante['instituicao_recomendante'] ? : '', ['class' => 'form-control', 'required' => '']) !!}
          </div>
          <div class="form-group">
            {!! form::label(trans('tela_carta_recomendacao.recomendacao')) !!}
            {!! Form::textarea('recomendacao', $dados_recomendante['carta'] ? : '', ['cols' => '40', 'rows' => '15', 'class' => 'form-control', 'required' => '']) !!}
          </div>

          {!! Form::hidden('id_candidato', $dados_candidato['id_candidato'], []) !!}
          {!! Form::hidden('id_recomendante', $dados_recomendante['id_recomendante'], []) !!}
          {!! Form::hidden('id_inscricao_pnpd', $id_inscricao_pnpd, []) !!}

          </fieldset>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-md-offset-3 text-center">
                {!! Form::submit(trans('tela_carta_recomendacao.menu_enviar'), ['class' => 'btn btn-primary btn-lg register-submit']) !!}
              </div>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection