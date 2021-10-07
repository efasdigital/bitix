<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.webp" sizes="32x32" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <title>Bitix</title>
  </head>

  <body>
  	<div class="row m-3">
  		<div class="col-12 text-center">
  			<img src="images/logo.webp" class="img-fluid">
        <h4 class="text-info">Simulador de Plano de Saúde</h4>
  		</div>
  	</div>
    <div class="row m-3">
      <label>Selecione a quantidade de beneficiário(s):</label>
        <div class="col-lg-9 col-sm-12 mb-2">
          <select class="form-control" id="beneficiario" required="">
            <option value="1">1 Beneficíario</option>
            <option value="2">2 Beneficíarios</option>
            <option value="3">3 Beneficíarios</option>
            <option value="4">4 Beneficíarios</option>
          </select>
        </div>             
          
        <div class="col-lg-3 col-sm-12 d-grid gap-2 mb-2">    
          <button id="next" class="btn btn-success" type="button">Avançar</button>
        </div>     
    </div>
    <footer class="text-center mt-5">
      <small >Todos os Direitos Reservados à Bitix © 2021</small>
    </footer>

    <script>
      $("#next").click(function(){
        var selectBeneficiario = $('#beneficiario').val();
        window.location.href = "b/"+selectBeneficiario+".php"
      });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>