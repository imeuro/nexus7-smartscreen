<html>

	<head>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/clappr/latest/clappr.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="https://cdn.jsdelivr.net/clappr.chromecast-plugin/latest/clappr-chromecast-plugin.min.js"></script>
		<style>
			html,body {
				font-size: 16px;
				font-family: 'Fira Sans Extra Condensed', sans-serif;
				margin: 0;
				padding: 0;
				background: #212121;
				color: #333;
			}
		</style>
	</head>

	<body>

		<div id="player"></div>

		<script>
			var player=new Clappr.Player({
				source:"http://skyianywhere2-i.akamaihd.net/hls/live/200275/tg24/playlist.m3u8",
				autoPlay:true,
				width:"100%",
				height:"540",
				parentId:"#player",
				plugins: [ChromecastPlugin],
				chromecast: {
				  appId: '9DFB77C0',
				  media: {
				    title: 'Blog CoolStreaming',
				    subtitle: 'Blog CoolStreaming'
				  }
				}
			});
		</script>

	</body>
</html>
