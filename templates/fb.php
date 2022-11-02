<?php if ($pixelActive == 1){ ?>
<!-- Meta Pixel Code --> 
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');

<?php if(isset($_SESSION['loggedIn'])){ ?>
fbq('init', '1129329811027858', {
em: '<?php echo $_SESSION['email']; ?>',        
fn: '<?php echo $_SESSION['fname']; ?>',    
ln: '<?php echo $_SESSION['lname']; ?>',
bd: '<?php echo $_SESSION['FBdob']; ?>',
ge: '<?php echo $_SESSION['FBgender']; ?>',
external_id: '<?php echo $_SESSION['userID']; ?>'
});
<?php }else{ ?>
fbq('init', '1129329811027858');
<?php } ?>
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1129329811027858&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<?php } ?>