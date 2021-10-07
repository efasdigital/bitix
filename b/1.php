<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../images/favicon.webp" sizes="32x32" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <title>Bitix</title>
  </head>

  <body>
  	<div class="row m-3">
  		<div class="col-12 text-center">
  			<img src="../images/logo.webp" class="img-fluid">
        <h4 class="text-info">Simulador de Plano de Saúde</h4>
  		</div>
  	</div>
    <form id="form">
    <div class="row m-3">
          <label><strong>Beneficiário</strong></label>
            <div class="col-lg-6 col-sm-12 mb-2">
              <input type="text" name="nome" id="nome" placeholder="Nome do beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-12 mb-2">
              <input type="number" name="idade" id="idade" min="0" max="120" step="1" placeholder="Idade do beneficiário" class="form-control" required="">
            </div>
          <div class="col-12 mb-2">
            <select class="form-control" name="selectPlano" id="selectPlano" required="">
              <option value="">SELECIONE UM PLANO</option>
            </select>
          </div>
          <div id="rconsulta" style="display: none;">
            <div class="col-12 mb-2 bg-success text-white text-center">
                  <strong>Resultado da Consulta</strong>
            </div>
            <hr class="bg-primary">
            <p id="resultado"></p>
            <hr class="bg-primary">
          </div>
          <div class="col-12 d-grid gap-2 mb-2">
            <button class="btn btn-success" id="consulta" type="submit">Consultar</button>
            <a href="../index.php" class="btn btn-default">Voltar</a>
          </div> 
    </div>
    </form>   

    <footer class="text-center mt-5">
      <small>Todos os Direitos Reservados à Bitix © 2021</small>
    </footer>

    <script>
      $(document).ready(function() {

        function planosJson() {
            $.getJSON('../planos.json', function(getPlanos) {
              var selectPlano = document.getElementById('selectPlano');
              for (var i = 0; i < getPlanos.length; i++) {
                  selectPlano.innerHTML = selectPlano.innerHTML +
                    '<option value="' + getPlanos[i]['codigo'] + '">' + getPlanos[i]['nome'] + '</option>';
              }
            });
        }

        var request;

        $("#form").submit(function(event){
            event.preventDefault();

            if (request) {
                request.abort();
            }

            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "post/1form.php",
                type: "post",
                data: serializedData
            });

            request.done(function (response, textStatus, jqXHR){
                $('#resultado').text(response);
                $('#rconsulta').show();
            });

            request.fail(function (jqXHR, textStatus, errorThrown){
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });

            request.always(function () {
                $inputs.prop("disabled", false);
            });

        });
        planosJson();
      });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>