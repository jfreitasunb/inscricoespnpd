@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
@endsection

@section('formulario_inscricao')
  <div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
      <legend class="text-center">{{ trans('tela_inscricao.menu_principal') }}</legend>
      <div class="col-10 col-md-10 col-lg-10">
        {!! Form::open(array('route' => 'candidato.inscricao','data-parsley-validate' => '' ,'enctype' => 'multipart/form-data')) !!}
          {{ Form::hidden('id_inscricao_pnpd', $id_inscricao_pnpd) }}
          <fieldset class="scheduler-border">
            <legend class="scheduler-border">{{ trans('tela_inscricao.dados_pessoais') }}</legend>
            <div class="form-group">
              {!! Form::text('nome', null, ['placeholder'=> trans('tela_inscricao.nome'),  'class' => 'form-control', 'required' => '']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('cpf', null, ['placeholder'=> trans('tela_inscricao.cpf'),  'class' => 'form-control', 'required' => '']) !!}
            </div>
            <div class="form-row">
              <div class="form-group col-md-10">
                <label for="instituicao">{{ trans('tela_inscricao.instituicao') }}</label>
                {!! Form::text('instituicao', null, ['placeholder'=> trans('tela_inscricao.instituicao'),  'class' => 'form-control', 'required' => '']) !!}
              </div>
              <div class="form-group col-md-2">
                <label for="ano_doutorado">{{ trans('tela_inscricao.ano_doutorado') }}</label>
                {!! Form::text('ano_doutorado', null, ['class' => 'form-control', 'required' => '']) !!}
              </div>
            </div>
        </fieldset>
          <div class="form-group">
            <fieldset class="scheduler-border">
              <legend class="scheduler-border">{{ trans('tela_inscricao.colaboradores') }}</legend>
              <p><b>{{ trans('tela_inscricao.separa_nomes') }}</b></p>
              <p>{{ trans('tela_inscricao.lista_colaboradores') }} <a href="http://www.mat.unb.br/pagina/pesquisa-projetos" target="_blank">http://www.mat.unb.br/pagina/pesquisa-projetos</a></p>
                {!! Form::textarea('colaboradores', null, ['class' => 'form-control', 'required' => '']) !!}
            </fieldset>
          </div>
          <fieldset class="scheduler-border">
            <legend class="scheduler-border">{{ trans('tela_inscricao.recomendantes_1').$numero_cartas.trans('tela_inscricao.recomendantes_2') }}</legend>
          @for ($i = 1; $i <= $numero_cartas ; $i++)
            <div class="form-row">
              <div class="form-group col-md-6">
              <input id="nome_recomendante_{{ $i }}" name="nome_recomendante[]" placeholder="{{ trans('tela_inscricao.nome_recomendante') }}" type="text" class="form-control" required="required">
              </div>
              <div class="form-group col-md-6">
                <input id="email_recomendante_{{ $i }}" name="email_recomendante[]" placeholder="{{ trans('tela_inscricao.email_recomendante') }}" type="text" class="form-control" data-parsley-type='email' required="required">
              </div>
            </div>
          @endfor
        </fieldset>
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">{{ trans('tela_inscricao.documentos') }}</legend>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="">{{ trans('tela_inscricao.curriculo') }}</label>
              <div class="custom-file">
                <input type="file" accept="application/pdf" class="custom-file-input" id="customFile1" name="curriculo">
                <label class="custom-file-label" for="customFile">{{ trans('tela_inscricao.escolha') }}</label>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="">{{ trans('tela_inscricao.projeto') }}</label>
              <div class="custom-file">
                <input type="file" accept="application/pdf" class="custom-file-input" id="customFile1" name="projeto">
                <label class="custom-file-label" for="customFile">{{ trans('tela_inscricao.escolha') }}</label>
              </div>
            </div>
          </div>
        </fieldset>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary">{{ trans('tela_inscricao.enviar') }}</button>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  {!! Html::script( asset('js/parsley.min.js') ) !!}
  {!! Html::script( asset('js/pt-br.js') ) !!}
  {!! Html::script( asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js')) !!}
  {!! Html::script( asset('js/datepicker.js') ) !!}
@endsection
