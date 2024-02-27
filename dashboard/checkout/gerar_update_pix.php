<?php
include('config/conecta.php');
if(isset($_GET['id'])){
    if($status == 'pendente'){
        if($codigo_transacao === null){
            $curl = curl_init();
            $caracteres = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
            $filtrado   = str_shuffle($caracteres);
            $codigoKey  = substr($filtrado, 0, 5).'-'.substr($filtrado, 0, 8).'-'.substr($filtrado, 0, 4);
            $dados["transaction_amount"]                    = floatval($valor);
            $dados["description"]                           = $desc;
            $dados["external_reference"]                    = $ref;
            $dados["payment_method_id"]                     = "pix";
            $dados["notification_url"]                      = "https://".$hostnotification;
        //    $dados["payer"]["email"]                        = $email;
            $dados["payer"]["email"]                        = "email@center.com";
            $dados["payer"]["first_name"]                   = "Daniel";
            $dados["payer"]["last_name"]                    = "Correia Tertulino";
            
            $dados["payer"]["identification"]["type"]       = $type;
            $dados["payer"]["identification"]["number"]     = $doc;
            //$dados["payer"]["address"]["zip_code"]          = "06233200";
            //$dados["payer"]["address"]["street_name"]       = "Av. das Nações Unidas";
            //$dados["payer"]["address"]["street_number"]     = "3003";
            //$dados["payer"]["address"]["neighborhood"]      = "Bonfim";
            //$dados["payer"]["address"]["city"]              = "Osasco";
            //$dados["payer"]["address"]["federal_unit"]      = "SP";
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($dados),
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'content-type: application/json',
                'X-Idempotency-Key: '.$codigoKey,
                'Authorization: Bearer '.$access_token
            ),
            ));
            $response = curl_exec($curl);
            $resultado = json_decode($response);
        curl_close($curl);
            mysqli_query($conexao, "UPDATE pkg_checkout SET qrcode = '".$resultado->point_of_interaction->transaction_data->qr_code_base64."' WHERE id = '".$_GET['id']."'");
            mysqli_query($conexao, "UPDATE pkg_checkout SET linha = '".$resultado->point_of_interaction->transaction_data->qr_code."' WHERE id = '".$_GET['id']."'");
            mysqli_query($conexao, "UPDATE pkg_checkout SET codigo_transacao = '".$resultado->id."' WHERE id = '".$_GET['id']."'");
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/pagamento.php?id=".$id."'>";
        }
        else{
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$codigo_transacao,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json', 
                'content-type: application/json',
                'Authorization: Bearer '.$access_token
            ),
            ));
            $response = curl_exec($curl);
            $resultado = json_decode($response);
        curl_close($curl);
        if($resultado->status == "cancelled"){
            $curl = curl_init();
            $caracteres = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
            $filtrado   = str_shuffle($caracteres);
            $codigoKey  = substr($filtrado, 0, 5).'-'.substr($filtrado, 0, 8).'-'.substr($filtrado, 0, 4);
            $dados["transaction_amount"]                    = floatval($valor);
            $dados["description"]                           = $desc;
            $dados["external_reference"]                    = $ref;
            $dados["payment_method_id"]                     = "pix";
            $dados["notification_url"]                      = "https://".$hostnotification;
        //    $dados["payer"]["email"]                        = $email;
            $dados["payer"]["email"]                        = "email@center.com";
            $dados["payer"]["first_name"]                   = "Daniel";
            $dados["payer"]["last_name"]                    = "Correia Tertulino";
            
            $dados["payer"]["identification"]["type"]       = $type;
            $dados["payer"]["identification"]["number"]     = $doc;
            //$dados["payer"]["address"]["zip_code"]          = "06233200";
            //$dados["payer"]["address"]["street_name"]       = "Av. das Nações Unidas";
            //$dados["payer"]["address"]["street_number"]     = "3003";
            //$dados["payer"]["address"]["neighborhood"]      = "Bonfim";
            //$dados["payer"]["address"]["city"]              = "Osasco";
            //$dados["payer"]["address"]["federal_unit"]      = "SP";
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($dados),
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                'content-type: application/json',
                'X-Idempotency-Key: '.$codigoKey,
                'Authorization: Bearer '.$access_token
            ),
            ));
            $response = curl_exec($curl);
            $resultado = json_decode($response);
        curl_close($curl);
            mysqli_query($conexao, "UPDATE pkg_checkout SET qrcode = '".$resultado->point_of_interaction->transaction_data->qr_code_base64."' WHERE id = '".$_GET['id']."'");
            mysqli_query($conexao, "UPDATE pkg_checkout SET linha = '".$resultado->point_of_interaction->transaction_data->qr_code."' WHERE id = '".$_GET['id']."'");
            mysqli_query($conexao, "UPDATE pkg_checkout SET codigo_transacao = '".$resultado->id."' WHERE id = '".$_GET['id']."'");
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/pagamento.php?id=".$id."'>";
        }
        else{
            echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/pagamento.php?id=".$id."'>";
        }

    

            
        }
    }
}
?>