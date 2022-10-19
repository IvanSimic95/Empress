<style>
#phone-navbar{
  position: fixed;
  height: 50px;
    bottom: 0;
    width: 100%;
    z-index:99999;
    display:none;
    border-top-right-radius:0.375rem;
    border-top-left-radius:0.375rem;
    border-bottom-right-radius:0;
    border-bottom-left-radius:0;
    display:none;
}

.phone-navbar
{
background: #f9fafd;
}
#phone-navbar .nav-link{
color: #7303c0;
text-align:center;
background-color:#f6f9fc;
font-size:14px;
font-weight:bold;
}
#phone-navbar .nav-link.active{
color: #fff;
background-color:#7303c0;
border-top-right-radius:0.375rem;
    border-top-left-radius:0.375rem;
    border-bottom-right-radius:0;
    border-bottom-left-radius:0;
}
#phone-navbar .nav-item{
width:25%;
}
#phone-navbar .svg-inline--fa{
display:block;
margin:0 auto;
}
#phone-navbar .nav-link .menu-title{
display:block;
}
@media only screen and (min-width: 900px) {
  #phone-navbar{
display:none!important;
}
}

@media only screen and (max-width: 250px) {
#phone-navbar .nav-link .menu-title{
display:none;
}
#phone-navbar ul{
height:100%;
}
#phone-navbar .nav-link{
  height: 100%;
    padding-top: 15px;
}
}


</style>

<nav id="phone-navbar" class="navbar phone-navbar px-0 py-0" >
  <ul class="nav nav-pills d-flex justify-content-around flex-wrap align-content-stretch w-100">
    <li class="nav-item">
      <a class="nav-link" href="#purchase-product"><i class="fa fa-shopping-cart"></i> <span class="menu-title">Buy</span></a>
    </li>
  <!--
    <li class="nav-item">
      <a class="nav-link" href="#highlights"><i class="fa fa-sparkles"></i> <span class="menu-title">Hightlights</span></a>
    </li>-->
    <li class="nav-item">
      <a class="nav-link" href="#description"><i class="fa fa-circle-info"></i> <span class="menu-title">Info</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#reviews"><i class="fa fa-star-sharp"></i> <span class="menu-title">Reviews</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#faq"><i class="fa fa-circle-question"></i> <span class="menu-title">FAQ</span></a>
    </li>
  </ul>
</nav>