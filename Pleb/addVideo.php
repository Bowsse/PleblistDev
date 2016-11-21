<?php

/*
Lisää videon tiedot tietokantaan			!muokkaa error viestit!
											!vaihda oikea tietokanta!
*/


if(isset($_POST['videoTitle']) && isset($_POST['channelTitle']) && isset($_POST['videoId']) && isset($_POST['addedBy'])){
	try{
	$db = new SQLite3('/var/Databases/testdb.db'); //tietokanta

	$results = $db->prepare('INSERT INTO Video (nimi,kanava,YTid,lisaaja,lisatty) VALUES (:videoTitle, :channelTitle, :videoId, :addedBy, :Date)'); //... WHERE id = :id' //tietokantahaun alustus
	$results->bindValue(':videoTitle',$_POST['videoTitle']);
	$results->bindValue(':channelTitle',$_POST['channelTitle']);
	$results->bindValue(':videoId',$_POST['videoId']);
	$results->bindValue(':addedBy',$_POST['addedBy']);
	$results->bindValue(':Date', date("Y-m-d H:i:s"));
	$result = $results->execute(); //lisää
	echo "Lisätty";
	}
	catch(Exception $e){
		echo "db error";
	}
}
else{
	echo "error";
}
?>