@extends('templates.default')

@section('stylesheets')
  {!! Html::style( asset('css/parsley.css') ) !!}
@endsection

@section('configura_inscricao')
<div class="row">
   <div class="col-md-8 col-md-offset-2">
      {!! Form::open(array('route' => 'configura.inscricao','data-parsley-validate' => '' ,'enctype' => 'multipart/form-data')) !!}
            <legend>Configurar período da abertura da inscrição</legend>
                <div class="input-group">
                    <input id="incio_inscricao" type="text" class="form-control"><span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
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