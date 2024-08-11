<?php
// Configuration des informations de paiement
$payee_account = 'U43777394';
$payee_name = 'NTI';
$payment_id = 'NTI deposit payment';
$payment_amount = '10'; // Valeur par défaut, peut être modifiée dynamiquement
$payment_units = 'USD';
$status_url = 'https://votre-domaine.com/payment_status.php'; // URL où Perfect Money enverra les notifications de statut
$payment_url = 'https://form.jotform.com/241574574574062';
$nopayment_url = 'https://form.jotform.com/241574771836567';
$payment_url_method = 'LINK';
$nopayment_url_method = 'LINK';
$suggested_memo = '';
$baggage_fields = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfect Money Payment</title>
    <link rel="stylesheet" href="<% options.links.appCSS %>">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.3"></script>
    <style>
        /* Styles ici */
    </style>
</head>
<body>
    <div class="container">
        <h1>No Trade Investment Payment Form</h1>
        <form action="https://perfectmoney.com/api/step1.asp" method="POST">
            <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo htmlspecialchars($payee_account); ?>">
            <input type="hidden" name="PAYEE_NAME" value="<?php echo htmlspecialchars($payee_name); ?>">
            <input type="hidden" name="PAYMENT_ID" value="<?php echo htmlspecialchars($payment_id); ?>">
            <label for="amount">Payment Amount (USD):</label>
            <input type="text" id="amount" name="PAYMENT_AMOUNT" value="<?php echo htmlspecialchars($payment_amount); ?>"><br>
            <input type="hidden" name="PAYMENT_UNITS" value="<?php echo htmlspecialchars($payment_units); ?>">
            <input type="hidden" name="STATUS_URL" value="<?php echo htmlspecialchars($status_url); ?>">
            <input type="hidden" name="PAYMENT_URL" value="<?php echo htmlspecialchars($payment_url); ?>">
            <input type="hidden" name="PAYMENT_URL_METHOD" value="<?php echo htmlspecialchars($payment_url_method); ?>">
            <input type="hidden" name="NOPAYMENT_URL" value="<?php echo htmlspecialchars($nopayment_url); ?>">
            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="<?php echo htmlspecialchars($nopayment_url_method); ?>">
            <input type="hidden" name="SUGGESTED_MEMO" value="<?php echo htmlspecialchars($suggested_memo); ?>">
            <input type="hidden" name="BAGGAGE_FIELDS" value="<?php echo htmlspecialchars($baggage_fields); ?>">
            <input type="submit" name="PAYMENT_METHOD" value="Pay Now!">
        </form>
        <script src="https://telegram.org/js/telegram-web-app.js"></script>
        <script type="text/javascript" src="<% options.links.appJS %>"></script>
    </div>
</body>
</html>
