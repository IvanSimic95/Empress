<style>
#main-phone-nav{
  position: fixed;
  height: 50px;
    top: 0;
    width: 100%;
    z-index:99999;
    display:none;
    border-bottom-right-radius:0.375rem;
    border-bottom-left-radius:0.375rem;
    border-top-right-radius:0;
    border-top-left-radius:0;
    display:none;
}

.phone-navbar
{
background: #f9fafd;
}
#main-phone-nav .nav-link{
color: #7303c0;
text-align:center;
background-color:#f6f9fc;
font-size:14px;
font-weight:bold;
}
#main-phone-nav .nav-link.active{
color: #fff;
background-color:#7303c0;
border-bottom-right-radius:0.375rem;
    border-bottom-left-radius:0.375rem;
    border-top-right-radius:0;
    border-top-left-radius:0;
}
#main-phone-nav .nav-item{
width:25%;
}
#main-phone-nav .svg-inline--fa{
display:block;
margin:0 auto;
}
#main-phone-nav .nav-link .menu-title{
display:block;
}

</style>
<div id ="main-phone-nav">
<?php include $_SERVER['DOCUMENT_ROOT'].'/templates/navbar/menuv3.php'; ?>
</div>