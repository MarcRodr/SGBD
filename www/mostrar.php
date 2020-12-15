<?php
function mostrar($o){
	echo '<br>
<div class="w3-container">

  <div class="w3-card-4" style="width:70%">
    <header class="w3-container w3-light-grey">
      <h3>' . $o['name'] . '</h3>
    </header>
    <div class="w3-container">
      <p>Contacte: <b>' . $o['contact'] .'</b></p>
      <hr>
      <img src="' . $o['photo'] . '" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
      <p>"' . $o['description'] . '"</p><br>
    </div>
  </div>
</div>';

}