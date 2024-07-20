<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'C:/Users/rodri/Desktop/discovery-portugal/vendor/autoload.php';

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

Stripe::setApiKey('sk_test_51PekHyRsGETv09ikDabpT81Kwxle0yKG5IrcGjE8VgnDZhp5iYLVRZ7it7oZMuG7Jpuhj5s0UnEQaAQXOY2zcX7F00dJSi7QSM'); // Substitua pela sua chave secreta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['stripeToken'];
    $email = $_POST['email'];
    $paymentType = $_POST['paymentType']; // Tipo de pagamento (opcional, pode não ser necessário)

    if (empty($token) || empty($email)) {
        echo 'Token ou email ausente.';
        exit;
    }

    try {
        $customer = Customer::create([
            'email' => $email,
            'source' => $token
        ]);

        $charge = Charge::create([
            'customer' => $customer->id,
            'amount' => 1000, // Valor em centavos (R$10.00)
            'currency' => 'brl',
            'description' => 'Teste de pagamento',
            // Se desejar algo específico para cartão de crédito ou débito, ajuste aqui
        ]);

        // Redireciona para a página de sucesso
        header('Location: success.php');
        exit;

    } catch (\Stripe\Exception\CardException $e) {
        echo 'Erro no cartão: ' . $e->getError()->message;
    } catch (\Stripe\Exception\RateLimitException $e) {
        echo 'Erro de limite de taxa: ' . $e->getError()->message;
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        echo 'Solicitação inválida: ' . $e->getError()->message;
    } catch (\Stripe\Exception\AuthenticationException $e) {
        echo 'Erro de autenticação: ' . $e->getError()->message;
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        echo 'Erro de conexão com a API: ' . $e->getError()->message;
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo 'Erro da API: ' . $e->getError()->message;
    } catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    echo 'Método de requisição inválido.';
}
?>
