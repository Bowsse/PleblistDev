<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="styles/style.css" type="text/css" rel=stylesheet>
	<script src="scripts/indexScript.js"></script> <!-- index.php soittolistan nappiscriptit -->
	<script src="scripts/YTPlayerScript.js"></script> <!-- index.php YouTube-soittimen scriptit -->
					      

<body>
<?php include_once("includes/nav.html"); ?> <!-- header ja navigointilinkit -->
<main>
	<!-- sivun vasen puoli -->
	<section>
		<!-- YouTube-soittimen div -->
			<div class="wrapper">
				<div id="player"></div>
			</div>
		<!-- YouTube-soittimen napit -->
			<article id=playerButtons>
				<button class="playerButton" id="play" onclick="playVideo()">Play</button><button class="playerButton" id="skip" onclick="skipVideo()">Skip</button><button class="playerButton" id="mute" onclick="muteVideo()">Mute</button><input id="volume" type=range min="0" max="100" value=100 oninput="changeVolume(this.value)">
			</article>
		<!-- Uuden kappaleen lisäyslomake -->
			<article>
				<h1>Lisää kappale</h1>
				<input type="text" id="videoUrl" name="videoUrl" placeholder="https://www.youtube.com/watch?v=1yhTaFQJukx" onInput="getData(this.value)"><button onclick="addVideo()">>></button>
				<br><p>Title: <span id=videoTitle name=videoTitle></span></p>
				<p>Channel: <span id=channelTitle name=channelTitle></span></p>
			</article>
	</section>
	<!-- sivun oikea puoli -->
	<!-- soittolista -->
		<aside id="playlist">
			
			<table>
				<?php printTable(); ?>
			</table>
		
		</aside>
	<button id="playlistButton" onclick="closeList()">Close</button> <!-- soittolistan nappi -->

		<!-- chat -->
		<aside id="chat">
			<div id="mastercontainer">
				<h1>HUUTOLOOTA >:DDD</h1>

				<p id='navbar'>Select Role: <a href='index.php?user_id=2'><span style='background-color: #ffc'>Admin</span></a>
				</p>    <div id="container"></div>

					<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
				    <script src="https://unpkg.com/react@15.3.2/dist/react.js"></script>
				    <script src="https://unpkg.com/react-dom@15.3.2/dist/react-dom.js"></script>
				    <script src="https://unpkg.com/babel-core@5.8.38/browser.min.js"></script>
				    <script type="text/babel" src="js/react-chat.js"></script>
</head>


			</div>
		</aside>
		<button id="chatButton" onclick="closeChat()">Close</button> <!-- chatin nappi -->

		
</main>

<?php include_once("includes/footer.php"); ?> <!-- footer -->
</body>

<?php
//soittolistan tulostusfunktio
function printTable(){
	$db = new SQLite3('/var/Databases/testdb.db'); //tietokanta
	
	$results = $db->prepare('SELECT * FROM Video'); //... WHERE id = :id' //tietokantahaun alustus
	//$results->bindValue(':id',$id);
	$result = $results->execute(); //tietokantahaku
	
	//soittolistataulukon tulostus
	while($row = $result->fetchArray()) {
		echo	"<tr><td><img class='thumbnail' src='https://i.ytimg.com/vi/".$row[3]."/mqdefault.jpg' onclick=changeVideo('".$row[3]."')></td>
				<td>
					<ul class='test'>
						<li><strong>".$row[1]."</strong></li>
						<li>".$row[2]."</li>
						<li><i>".$row[4]."</i></li>
					</ul>
				</td>
				</tr>";
	}
}
?>