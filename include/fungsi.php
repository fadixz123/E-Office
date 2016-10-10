<?php

function daftarProvinsi($dipilih = ''){
	$q = mysql_query("select * from propinsi");
	$p = "";

	while ($k = mysql_fetch_object($q)) {
		$atribut = $dipilih && $dipilih ==  $k->Propinsi ? ' selected' : '';
		$p .= "<option$atribut>" . $k->Propinsi . "</option>";
	}

	return $p;
}



