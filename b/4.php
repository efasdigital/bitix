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
          <label><strong>Beneficiários</strong></label>
            <div class="col-lg-6 col-sm-12 mb-2">
              <input type="text" name="nome" id="nome" placeholder="Nome do primeiro beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-12 mb-2">
              <input type="number" name="idade" id="idade" min="0" max="120" step="1" placeholder="Idade do primeiro beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-sm-12 mb-2">
              <input type="text" name="nome2" id="nome2" placeholder="Nome do segundo beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-12 mb-2">
              <input type="number" name="idade2" id="idade2" min="0" max="120" step="1" placeholder="Idade do segundo beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-sm-12 mb-2">
              <input type="text" name="nome3" id="nome3" placeholder="Nome do terceiro beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-12 mb-2">
              <input type="number" name="idade3" id="idade3" min="0" max="120" step="1" placeholder="Idade do terceiro beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-sm-12 mb-2">
              <input type="text" name="nome4" id="nome4" placeholder="Nome do quarto beneficiário" class="form-control" required="">
            </div>
            <div class="col-lg-6 col-12 mb-2">
              <input type="number" name="idade4" id="idade4" min="0" max="120" step="1" placeholder="Idade do quarto beneficiário" class="form-control" required="">
            </div>
          <div class="col-12 mb-2">
            <select class="form-control" name="selectPlano" id="selectPlano" required="">
              <option value="0">SELECIONE UM PLANO</option>
            </select>
          </div>
          <div id="invalid" class="text-danger" style="display: none;">
            <p>Por favor preencha todos os campos e selecione um plano.</p>
          </div>
          <div id="rconsulta" style="display: none;">
            <div class="col-12 mb-2 bg-success text-center">
                  <strong class="text-white">Resultado da Consulta</strong>
            </div>
            <hr class="bg-primary">
            <p id="rbeneficiado1"></p>
            <p id="rbeneficiado2"></p>
            <p id="rbeneficiado3"></p>
            <p id="rbeneficiado4"></p>
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
                url: "post/4form.php",
                type: "post",
                data: serializedData
            });

            request.done(function (response, textStatus, jqXHR){
              var data = JSON.parse(response);
                $('#rbeneficiado1').html(data.nome+ ' de ' +data.idade+ ' anos, tem custo de R$'+data.price);
                $('#rbeneficiado2').html(data.nome2+ ' de ' +data.idade2+ ' anos, tem custo de R$'+ data.price2);
                $('#rbeneficiado3').html(data.nome3+ ' de ' +data.idade3+ ' anos, tem custo de R$'+ data.price3);
                $('#rbeneficiado4').html(data.nome4+ ' de ' +data.idade4+ ' anos, tem custo de R$'+ data.price4);
                $('#resultado').html('O '+data.plano+ ' para os <strong>4 beneficiários</strong> custa no total: <strong class="text-success">R$'+data.total+'</strong>');
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

        $( "#selectPlano" ).change(function() {
            if($('#selectPlano').val() == 0 || $('#nome').val() == '' || $('#idade').val() == '' || $('#nome2').val() == '' || $('#idade2').val() == '' || $('#nome3').val() == '' || $('#idade3').val() == '' || $('#nome4').val() == '' || $('#idade4').val() == ''){
              $('#invalid').show();
              $('#rconsulta').hide();
            } else {
              $('#invalid').hide();
            }
        });

        planosJson();
      });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>