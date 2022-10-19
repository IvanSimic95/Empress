<?php 
if($page=="home"){
?>

<link rel="stylesheet" type="text/css" href="/assets/css/star-rating-svg.css">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/jquery.star-rating-svg.js"></script>
<script>

$(".my-rating1").starRating({
  starSize: 30,
  strokeWidth: 9,
  readOnly: true,
  strokeColor: 'black',
  initialRating: <?php echo $v['p1-avg-rating']; ?>,
  starGradient: {
      start: '#d130eb',
      end: '#2b216c'
  }
});

$(".my-rating2").starRating({
  starSize: 30,
  strokeWidth: 9,
  readOnly: true,
  strokeColor: 'black',
  initialRating: <?php echo $v['p2-avg-rating']; ?>,
  starGradient: {
      start: '#d130eb',
      end: '#2b216c'
  }
});

$(".my-rating3").starRating({
  starSize: 30,
  strokeWidth: 9,
  readOnly: true,
  strokeColor: 'black',
  initialRating: <?php echo $v['p3-avg-rating']; ?>,
  starGradient: {
      start: '#d130eb',
      end: '#2b216c'
  }
});



</script>


<?php
}