@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
@endsection

@section('editar_inscricao')
  <div class="container h-100">
      <div class="row h-100 justify-content-center align-items-center">
          <legend class="text-center">Formulário de Inscrição</legend>
          <div class="col-10 col-md-8 col-lg-6">
            {!! Form::open(array('route' => 'processa.inscricao','data-parsley-validate' => '' ,'enctype' => 'multipart/form-data')) !!}
              <div class="form-group">
                  <label for="nome"></label>
                  <input id="nome" name="nome" placeholder="Nome Completo" type="nome" required="required" class="form-control">
              </div>
            <div class="form-group">
              <label for="cpf"></label>
              <input id="cpf" name="cpf" placeholder="CPF" type="text" required="required" class="form-control">
            </div>
            <div class="form-row">
              <div class="form-group col-md-10">
                <label for="instituicao">Instituição de obtenção do doutorado</label>
                <input id="instituicao" name="instituicao" type="text" required="required" class="form-control">
              </div>
              <div class="form-group col-md-2">
                <label for="ano_doutorado">Ano</label>
                <input id="ano_doutorado" name="ano_doutorado" type="text" required="required" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label>Membros do Programa com quem pode colaborar</label>
              <div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input name="checkbox" id="checkbox_0" type="checkbox" checked="checked" required="required" class="custom-control-input" value="rabbit">
                  <label for="checkbox_0" class="custom-control-label">Rabbit</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input name="checkbox" id="checkbox_1" type="checkbox" required="required" class="custom-control-input" value="duck">
                  <label for="checkbox_1" class="custom-control-label">Duck</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input name="checkbox" id="checkbox_2" type="checkbox" required="required" class="custom-control-input" value="fish">
                  <label for="checkbox_2" class="custom-control-label">Fish</label>
                </div>
              </div>
            </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <input id="nome_recomendante_1" name="nome_recomendante_1" placeholder="Nome do Recomendante" type="text" class="form-control" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <input id="email_recomendante_1" name="email_recomendante_1" placeholder="E-mail do Recomendante" type="text" class="form-control" required="required">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <input id="nome_recomendante_2" name="nome_recomendante_2" placeholder="Nome do Recomendante" type="text" class="form-control" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <input id="email_recomendante_2" name="email_recomendante_2" placeholder="E-mail do Recomendante" type="text" class="form-control" required="required">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="">Currículo</label>
                    <div class="custom-file">
                      <input type="file" accept="application/pdf" class="custom-file-input" id="customFile1" name="curriculo">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="">Projeto</label>
                    <div class="custom-file">
                      <input type="file" accept="application/pdf" class="custom-file-input" id="customFile1" name="projeto">
                      <label class="custom-file-label" for="customFile">Choose file</label>
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
  </div>
@endsection

@section('scripts')
  {!! Html::script( asset('js/parsley.min.js') ) !!}
  {!! Html::script( asset('js/pt-br.js') ) !!}
  {!! Html::script( asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js')) !!}
  {!! Html::script( asset('js/datepicker.js') ) !!}
@endsection
