<html>

<head><title>sound</title></head>

<body>
<button type="button" onClick="play()">Play</button>
<button type="button" onClick="stop()">Stop</button>
</body>

<script>
var audio1 = document.createElement('audio');
audio1.setAttribute('src', 'somsan.mdi');
function play(){
    audio1.play();
}
function stop(){
    audio1.stop();
}
</script>

</html>