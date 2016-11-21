var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
    videoId: 'M7lc1UVf-VE',
    events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
        },
    playerVars: {
        autoplay: 0,    //autoplay
        controls: 1,    //buttons
        disablekb: 1,   //keyboard controls
        fs: 0,          //fullscreen
        iv_load_policy: 3,  //annotations
        rel: 0          //related videos
    }
    });
}

function setVolume(){
    var volume = player.getVolume();
    document.getElementById("volume").value = volume;
}

function onPlayerReady(event) {
//            event.target.playVideo();
    setVolume();
}

var done = false;
function onPlayerStateChange(event) {
//            if (event.data == YT.PlayerState.PLAYING && !done) {
//                
//            }
}

function muteVideo() {
    if(player.isMuted()){
        player.unMute();
    }
    else { player.mute();}
}

function playVideo() {
    var state = player.getPlayerState();
    if(state != 1){
        player.playVideo();
    }
    else {player.pauseVideo();}
}

function changeVideo(id) {
	console.log(id);
    player.loadVideoById(id);
}

function changeVolume(value) {
    player.setVolume(value);
}

//lähettää lisättävän videon tiedot php:lle            !vaihda oikea php-sivu!
function addVideo(){
	var http = new XMLHttpRequest();
	var url = "addVideo.php";
	var videotitle = encodeURIComponent(document.getElementById("videoTitle").innerHTML);
	var channeltitle = encodeURIComponent(document.getElementById("channelTitle").innerHTML);
	
	var videoUrl = document.getElementById("videoUrl").value;
	var index = videoUrl.indexOf("=");
	var videoid = videoUrl.substring(index+1, index+12);
	var addedBy = "test";
	
	if(videotitle == "" || channeltitle == "" || videoid == ""){
		alert("asd error");
		return;
	}
	
	var params = "videoTitle="+videotitle+"&channelTitle="+channeltitle+"&videoId="+videoid+"&addedBy="+addedBy;
	
	http.open("POST", url, true);

	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			alert(http.responseText);
		}
	}
	http.send(params);
}

//hakee videon tiedot YouTuben apista
function getData(videoUrl){
			var index = videoUrl.indexOf("=");
			var videoId = videoUrl.substring(index+1, index+12);
			
			var source = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id="+videoId+"&key=AIzaSyDFXxQriPkJht3z9x14DZMOIF8ntpOZw7k";
			$.ajax({
				type: 'GET',
				url: source,
				contentType: "application/json",
				dataType: 'json',
				success: function (json) {
					//alert(json.items[0].snippet.title +" "+ json.items[0].snippet.channelTitle); //title & channel
					try{
						document.getElementById("videoTitle").innerHTML = json.items[0].snippet.title;
						document.getElementById("channelTitle").innerHTML = json.items[0].snippet.channelTitle;
					}
					catch(error){
						document.getElementById("videoTitle").innerHTML = "";
						document.getElementById("channelTitle").innerHTML = "";
					}
				},
				error: function (e) {
					alert(e);
				}
		});
}
	
//css
//iframe:
//pointer-events: none;