<?php
$listPrice = file_get_contents('../../precos.json');
$pricePlan = json_decode($listPrice, true);
$countListPrice = count($pricePlan);

for ($i = 0; $i < $countListPrice; $i++){
    if ($pricePlan[$i]['codigo'] == $_POST['selectPlano'] && $pricePlan[$i]['minimo_vidas'] == 1){
        $listPlan = file_get_contents('../../planos.json');
        $getPlan = json_decode($listPlan, true);
        $countListPlan = count($getPlan);

        for ($u = 0; $u < $countListPlan; $u++){
            if($_POST['selectPlano'] == $getPlan[$u]['codigo']){
                if ($_POST['idade'] >= 0 && $_POST['idade'] <= 17) {
                    echo 'O '.$getPlan[$u]['nome'].' para '.$_POST['nome'].' de '.$_POST['idade']. ' anos custa R$'.number_format($pricePlan[$i]['faixa1'], 2, '.', '');
                } else if ($_POST['idade'] >= 18 && $_POST['idade'] <= 40) {
                    echo 'O '.$getPlan[$u]['nome'].' para '.$_POST['nome'].' de '.$_POST['idade']. ' anos custa R$'.number_format($pricePlan[$i]['faixa2'], 2, '.', '');
                } else {
                    echo 'O '.$getPlan[$u]['nome'].' para '.$_POST['nome'].' de '.$_POST['idade']. ' anos custa R$'.number_format($pricePlan[$i]['faixa3'], 2, '.', '');
                }
            }
        }
        
    }
}
?>