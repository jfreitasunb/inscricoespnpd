<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <legend class="text-center">Formulário de Inscrição</legend>
        <div class="col-10 col-md-8 col-lg-6">
          {!! Form::open(array('route' => 'configura.inscricao','data-parsley-validate' => '' ,'enctype' => 'multipart/form-data')) !!}
            <div class="form-group">
                <label for="text"></label> 
                <input id="text" name="text" placeholder="Nome Completo" type="text" required="required" class="form-control">
            </div>
          <div class="form-group">
            <label for="cpf"></label> 
            <input id="cpf" name="cpf" placeholder="CPF" type="text" required="required" class="form-control">
          </div>
          <div class="form-group">
            <label for="ano_doutorado">Ano de obtenção do doutorado</label> 
            <div>
              <select id="ano_doutorado" name="ano_doutorado" required="required" class="custom-select">
                <option value="rabbit">Rabbit</option>
                <option value="duck">Duck</option>
                <option value="fish">Fish</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="text2"></label> 
            <input id="text2" name="text2" placeholder="Instituição de Obtenção do Doutorado" type="text" required="required" class="form-control">
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
              <div class="form-group">
                <label for="nome_recomendante_1"></label> 
                <input id="nome_recomendante_1" name="nome_recomendante_1" placeholder="Nome do Recomendante" type="text" class="form-control" required="required">
              </div>
              <div class="form-group">
                <label for="text">Text Field</label> 
                <input id="text" name="text" type="text" class="form-control">
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