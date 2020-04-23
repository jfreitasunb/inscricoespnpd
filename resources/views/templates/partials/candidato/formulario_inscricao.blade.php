@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
@endsection

@section('formulario_inscricao')
  <div class="container h-100">
      <div class="row h-100 justify-content-center align-items-center">
          <legend class="text-center">{{ trans('tela_inscricao.menu_principal') }}</legend>
          <div class="col-10 col-md-8 col-lg-6">
            {!! Form::open(array('route' => 'candidato.inscricao','data-parsley-validate' => '' ,'enctype' => 'multipart/form-data')) !!}
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
            <div class="form-group">
              <label>{{ trans('tela_inscricao.colobaradores') }}</label>
              <div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input name="colaboradores" id="checkbox_0" type="checkbox" class="custom-control-input" value="rabbit">
                  <label for="colaboradores" class="custom-control-label">Rabbit</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input name="checkbox" id="checkbox_1" type="checkbox" class="custom-control-input" value="duck">
                  <label for="checkbox_1" class="custom-control-label">Duck</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input name="checkbox" id="checkbox_2" type="checkbox" class="custom-control-input" value="fish">
                  <label for="checkbox_2" class="custom-control-label">Fish</label>
                </div>
              </div>
            </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <input id="nome_recomendante_1" name="nome_recomendante_1" placeholder="{{ trans('tela_inscricao.nome_recomendante') }}" type="text" class="form-control" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <input id="email_recomendante_1" name="email_recomendante_1" placeholder="{{ trans('tela_inscricao.email_recomendante') }}" type="text" class="form-control" required="required">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <input id="nome_recomendante_2" name="nome_recomendante_2" placeholder="{{ trans('tela_inscricao.nome_recomendante') }}" type="text" class="form-control" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <input id="email_recomendante_2" name="email_recomendante_2" placeholder="{{ trans('tela_inscricao.email_recomendante') }}" type="text" class="form-control" required="required">
                  </div>
                </div>
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
