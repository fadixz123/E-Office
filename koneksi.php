<?php
try{
	$db=new PDO("mysql:host=localhost;dbname=e_office;charset=utf8mb4","root","");
	function tampilID($prefiks, $row_id, $time, $maksdigit = 5) {
    return $prefiks.date('Ym', $time).str_repeat("0", $maksdigit-strlen($row_id)).$row_id;
}

function buatID($tabel, $prefiks) {
    $db->query("SELECT MAX(ID) as id from $tabel limit 1");
   return tampilID($prefiks, mysql_fetch_object($q)->id+1, time());
    
}

function ambil_ID($id, $maksdigit = 6) {
	if ($split) {
		if (preg_match("!^K([0-9]{4})([0-9]{2})([0-9]{5})$!i", $_GET['q'], $_)) {
			return $_[3];
		}		
	}
	return 0;
}
function sql_build_data($entry, $style = 0, $delim1 = ',', $delim2 = '='){
	if( !is_array($entry) ){
		return $entry;
	}

	$delim1 = " $delim1 ";
	foreach( $entry as $k => $v ){
		$v = "'".addslashes($v)."'";
		if( 1 === $style ){ $v = "$k $delim2 $v"; }
		$entry[$k] = $v;
	}

	return 2===$style ? array(
		implode($delim1, array_keys($entry)), implode($delim1, $entry)
	) : implode($delim1, $entry);
}
}catch(PDOException $ex){
	exit("Tidak dapat menyambungkan dengan database! ".$e->getMessage());
}

