<?php
/*
 * Menu navbar, just an unordered list
 */
?>
<ul class="nav navbar-nav" >
    <li><a href="/" style="padding-top: 10px; padding-bottom: 5px; padding-left: 25px;"><img src="/assets/plane.png" style="height: 32px; margin: 0px;" /></a>
    </li>
    {menudata}
    <li><a href="{link}">{name}</a></li>
    {/menudata}
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">User Role<b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                  <li><a href="/roles/actor/Guest">Guest</a></li>
                  <li><a href="/roles/actor/Owner">Owner</a></li>
      </ul>
    </li>   
</ul>