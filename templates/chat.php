<?php
$name = "Ivan";
$email = "email@isimic.com";
$created = time();

$hash = hash_hmac(
    'sha256', // hash function
    $email, // user's email address
    'ATaACZdcv10DL08vJA9TFDQKLuHs7sWdTkf-nCs_' // secret key (keep safe!)
  );

?>
<script>
  window.intercomSettings = {
    app_id: "iwsccfli",
    name: "<?php echo $name; ?>", // Full name
    email: "<?php echo $email ?>", // Email address
    created_at: "<?php echo $created; ?>", // Signup date as a Unix timestamp
    user_hash: "<?php echo $hash; ?>",
    user_status: "Customer",
    user_ltv: "39.99",
  };
</script>

<script>
// We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/iwsccfli'
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/iwsccfli';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>

