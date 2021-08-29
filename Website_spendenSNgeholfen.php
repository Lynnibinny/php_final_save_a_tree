<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"> -->
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
<style>
    /*
    :root {
      --tamaro-primary-color: #6d78b9;
      --tamaro-primary-color__hover: #545d92;
      --tamaro-primary-bg-color: #f2f2fb;
    }
    */
    .rnw-widget-container {
      width: 100%;
      margin: 0 auto;
    }
    #tamaro-widget.tamaro-widget {
      padding: 2rem;
      box-shadow: 0 0.125rem 0.25rem 0 rgba(0, 0, 0, 0.1);
    }
    #tamaro-widget.tamaro-widget .error-widget,
    body.tamaro-widget-overlay-inner.tamaro-widget-overlay-shown #tamaro-widget.tamaro-widget .overlay-block-wrapper {
    }

    #tamaro-widget.tamaro-widget .payment-amounts>.main .amounts .amount .main .value {
     font-weight: 200;
     transform: translateX(0rem);
    }
  </style>


<div class="rnw-widget-container"></div>
<script src="https://tamaro.raisenow.com/sagit-c6ac/latest/widget.js"></script> 
<script>
window.rnw.tamaro.events["paymentComplete"].subscribe(function(event) {
   console.log("transaction info object ", event.data.api.transactionInfo.amount);
   console.log("transaction info object ", event.data.api.transactionInfo.created);
   console.log("transaction is identified by the epp_transaction_id ", event.data.api.transactionInfo.epp_transaction_id);
   console.log("transaction status is defined as follows: ", event.data.api.transactionInfo.epayment_status);
   console.log("transaction status is defined as follows: ", event.data.api.transactionInfo.epayment_status);
   console.log("halllooooo");
   let data = new FormData()
   data.append('amount', event.data.api.transactionInfo.amount)
   data.append('created', event.data.api.transactionInfo.created)
   data.append('transaction_id', event.data.api.transactionInfo.epp_transaction_id)
   data.append('status', event.data.api.transactionInfo.epayment_status)
	fetch('https://i-kf.ch/SaveATree/spenden.php', {
	   method: 'POST',
	   body: data,
	}).then(response => {
	   if (!response.ok) {
		throw new Error('Network response was not ok.')
		}
	}).catch(console.error) 
})
window.rnw.tamaro.runWidget('.rnw-widget-container', {language: 'de'})
</script>
