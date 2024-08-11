<?php
class PerfectMoneyGateway
{
    private $perfectmoney_url = 'https://perfectmoney.is/api/step1.asp';
    private $payee_account;
    private $payee_name;
    private $passphrase;
    private $currency;

    public function __construct($payee_account, $payee_name, $passphrase, $currency = 'USD')
    {
        $this->payee_account = $payee_account;
        $this->payee_name = $payee_name;
        $this->passphrase = $passphrase;
        $this->currency = $currency;
    }

    public function validatePayment($post)
    {
        $signature = $post['PAYMENT_ID'] . ':' .
            $post['PAYEE_ACCOUNT'] . ':' .
            $post['PAYMENT_AMOUNT'] . ':' .
            $post['PAYMENT_UNITS'] . ':' .
            $post['PAYMENT_BATCH_NUM'] . ':' .
            $post['PAYER_ACCOUNT'] . ':' .
            strtoupper(md5($this->passphrase)) . ':' .
            $post['TIMESTAMPGMT'];

        $v2_hash = strtoupper(md5($signature));

        if ($v2_hash === $post['V2_HASH'] && $post['PAYEE_ACCOUNT'] === $this->payee_account) {
            return [
                'status' => 'approved',
                'amount' => $post['PAYMENT_AMOUNT'],
                'currency' => $post['PAYMENT_UNITS'],
                'payment_id' => $post['PAYMENT_ID'],
                'transaction_id' => $post['PAYMENT_BATCH_NUM']
            ];
        } else {
            return ['status' => 'declined'];
        }
    }

    public function processPayment($post)
    {
        $paymentData = $this->validatePayment($post);

        if ($paymentData['status'] === 'approved') {
            // Payment is successful, proceed with actions like subtracting funds
            $this->subtractFunds($paymentData['amount'], $paymentData['payment_id']);
            return 'Payment successful!';
        } else {
            // Payment failed
            return 'Payment verification failed!';
        }
    }

    private function subtractFunds($amount, $payment_id)
    {
        // Logic to subtract funds from user's balance
        // Example: Update database record for user balance based on payment_id
        // Database::subtractBalance($user_id, $amount);
    }
}

// Configuration
$payee_account = 'U43777394';
$payee_name = 'NTI';
$passphrase = 'YOUR_SECURE_PASSPHRASE'; // Replace with your actual passphrase

$perfectmoney = new PerfectMoneyGateway($payee_account, $payee_name, $passphrase);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $perfectmoney->processPayment($_POST);
}
?>
