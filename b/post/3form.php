<?php
$listPrice = file_get_contents('../../precos.json');
$pricePlan = json_decode($listPrice, true);
$countListPrice = count($pricePlan);

if($_POST['selectPlano'] == 6){
    $mVidas = 2;
} else {
    $mVidas = 1;
}

for ($i = 0; $i < $countListPrice; $i++){
    if ($pricePlan[$i]['codigo'] == $_POST['selectPlano'] && $pricePlan[$i]['minimo_vidas'] == $mVidas){
        $listPlan = file_get_contents('../../planos.json');
        $getPlan = json_decode($listPlan, true);
        $countListPlan = count($getPlan);

        for ($u = 0; $u < $countListPlan; $u++){
            if($_POST['selectPlano'] == $getPlan[$u]['codigo']){
                if ($_POST['idade'] >= 0 && $_POST['idade'] <= 17) {
                    $price1 = number_format($pricePlan[$i]['faixa1'], 2, '.', '');
                } else if ($_POST['idade'] >= 18 && $_POST['idade'] <= 40) {
                    $price1 = number_format($pricePlan[$i]['faixa2'], 2, '.', '');
                } else {
                    $price1 = number_format($pricePlan[$i]['faixa3'], 2, '.', '');
                }

                if ($_POST['idade2'] >= 0 && $_POST['idade2'] <= 17) {
                    $price2 = number_format($pricePlan[$i]['faixa1'], 2, '.', '');
                } else if ($_POST['idade2'] >= 18 && $_POST['idade2'] <= 40) {
                    $price2 = number_format($pricePlan[$i]['faixa2'], 2, '.', '');
                } else {
                    $price2 = number_format($pricePlan[$i]['faixa3'], 2, '.', '');
                }

                if ($_POST['idade3'] >= 0 && $_POST['idade3'] <= 17) {
                    $price3 = number_format($pricePlan[$i]['faixa1'], 2, '.', '');
                } else if ($_POST['idade3'] >= 18 && $_POST['idade3'] <= 40) {
                    $price3 = number_format($pricePlan[$i]['faixa2'], 2, '.', '');
                } else {
                    $price3 = number_format($pricePlan[$i]['faixa3'], 2, '.', '');
                }

                $priceTotal = $price1+$price2+$price3;

                $result = array(
                    'nome'          => $_POST["nome"],
                    'idade'         => $_POST["idade"],
                    'price'         => $price1,
                    'nome2'         => $_POST["nome2"],
                    'idade2'        => $_POST["idade2"],
                    'price2'        => $price2,
                    'nome3'         => $_POST["nome3"],
                    'idade3'        => $_POST["idade3"],
                    'price3'        => $price3,
                    'plano'         => $getPlan[$u]["nome"],
                    'total'         => number_format($priceTotal, 2, ".", "")
                );

                echo json_encode($result);
            }
        }

    }
}
?>