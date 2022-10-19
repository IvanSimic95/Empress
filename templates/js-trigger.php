<?php
class jsTrigger {
    // Properties
    public $code;
  
    // Methods
    function set_code($code) {
      $this->code = $code;
    }
    function get_code() {
      return $this->code;
    }
}

$customTrigger = <<<EOT
<script>
$(window).on('load', function(){
window.cp('identify', {
user_id: '$userID',
email: '$userEmail', 
name: '$userName', 
});
});
</script>
EOT;

$a = new jsTrigger();
$a->set_code($customTrigger);
if(isset($_GET['loggedin'])){
$CrowdPowerLogin = $a->get_code();
}else{
$CrowdPowerLogin = "";
}



$customTrigger2 = <<<EOT
<script>
$(window).on('load', function(){
    window.cp('event', {
        'action': 'purchase',
        'properties': {
          'product': 'soulmate',
          'cost': '29.99',
        }
      });
});
});
</script>
EOT;

$a2 = new jsTrigger();
$a2->set_code($customTrigger2);
if(isset($_GET['loggedin'])){
$CrowdPowerPurchase = $a2->get_code();
}else{
$CrowdPowerPurchase = "";
}

?>