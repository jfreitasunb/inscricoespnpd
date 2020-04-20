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
                <input id="inicio_inscricao" name="inicio_inscricao" type="text" required="required" class="form-control"> 
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
                <input id="fim_inscricao" name="fim_inscricao" type="text" class="form-control" required="required"> 
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
                <input id="prazo_carta" name="prazo_carta" type="text" required="required" class="form-control"> 
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
                <input id="data_homologacao" name="data_homologacao" type="text" class="form-control" required="required"> 
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
                <input id="data_divulgacao_resultado" name="data_divulgacao_resultado" type="text" class="form-control" required="required"> 
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
              <input id="edital" name="edital" type="text" class="form-control">
            </div>
          </div> --}}
          <div class="form-group row">
            {!! Form::label('recomendante', 'Necessita de Recomendante?', ['class' => 'col-4 col-form-label']); !!}
            <div class="col-8">
              <div class="custom-control custom-radio custom-control-inline">
                <input name="necessita_recomendante" id="necessita_recomendante_0" type="radio" required="required" class="custom-control-input" value="1"> 
                <label for="necessita_recomendante_0" class="custom-control-label">Sim</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input name="necessita_recomendante" id="necessita_recomendante_1" type="radio" required="required" class="custom-control-input" value="0"> 
                <label for="necessita_recomendante_1" class="custom-control-label">Não</label>
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