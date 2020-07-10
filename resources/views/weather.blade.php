<!DOCTYPE html>
<html>

<head>
    <title>RainViewer API Example</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
    <style type="text/css">
        li {
            list-style: none;
            display: inline-block;
        }
    </style>
</head>

<body>

    <ul style="text-align:center; position: absolute;top: 0; left: 0; right: 0; height: 50px;">
        <li><input type="button" onclick="stop(); showFrame(animationPosition - 1); return;" value="&lt;" /></li>
        <li><input type="button" onclick="playStop();" value="Play / Stop" /></li>
        <li><input type="button" onclick="stop(); showFrame(animationPosition + 1); return;" value="&gt;" /></li>
    </ul>

    <div id="timestamp" style="text-align:center; position: absolute;top: 50px; left: 0; right: 0; height: 80px;">FRAME
        TIME</div>

    <div id="mapid" style="position: absolute; top: 80px; left: 0; bottom: 0; right: 0;"></div>

    <script>
        var map = L.map('mapid').setView([1.390270, 103.851959], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attributions: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);


        /**
         * RainViewer radar animation part
         * @type {number[]}
         */
        var timestamps = [];
        var radarLayers = [];

        var animationPosition = 0;
        var animationTimer = false;

        /**
         * Load actual radar animation frames timestamps from RainViewer API
         */
        var apiRequest = new XMLHttpRequest();
        apiRequest.open("GET", "https://api.rainviewer.com/public/maps.json", true);
        apiRequest.onload = function (e) {

            // save available timestamps and show the latest frame: "-1" means "timestamp.lenght - 1"
            timestamps = JSON.parse(apiRequest.response);
            showFrame(-1);
        };
        apiRequest.send();

        /**
         * Animation functions
         * @param ts
         */
        function addLayer(ts) {
            if (!radarLayers[ts]) {
                radarLayers[ts] = new L.TileLayer('https://tilecache.rainviewer.com/v2/radar/' + ts + '/256/{z}/{x}/{y}/2/1_1.png', {
                    tileSize: 256,
                    opacity: 0.001,
                    zIndex: ts
                });
            }
            if (!map.hasLayer(radarLayers[ts])) {
                map.addLayer(radarLayers[ts]);
            }
        }

        /**
         * Display particular frame of animation for the @position
         * If preloadOnly parameter is set to true, the frame layer only adds for the tiles preloading purpose
         * @param position
         * @param preloadOnly
         */
        function changeRadarPosition(position, preloadOnly) {
            while (position >= timestamps.length) {
                position -= timestamps.length;
            }
            while (position < 0) {
                position += timestamps.length;
            }

            var currentTimestamp = timestamps[animationPosition];
            var nextTimestamp = timestamps[position];

            addLayer(nextTimestamp);

            if (preloadOnly) {
                return;
            }

            animationPosition = position;

            if (radarLayers[currentTimestamp]) {
                radarLayers[currentTimestamp].setOpacity(0);
            }
            radarLayers[nextTimestamp].setOpacity(100);

            document.getElementById("timestamp").innerHTML = (new Date(nextTimestamp * 1000)).toString();
        }

        /**
         * Check avialability and show particular frame position from the timestamps list
         */
        function showFrame(nextPosition) {
            var preloadingDirection = nextPosition - animationPosition > 0 ? 1 : -1;

            changeRadarPosition(nextPosition);

            // preload next next frame (typically, +1 frame)
            // if don't do that, the animation will be blinking at the first loop
            changeRadarPosition(nextPosition + preloadingDirection, true);
        }

        /**
         * Stop the animation
         * Check if the animation timeout is set and clear it.
         */
        function stop() {
            if (animationTimer) {
                clearTimeout(animationTimer);
                animationTimer = false;
                return true;
            }
            return false;
        }

        function play() {
            showFrame(animationPosition + 1);

            // Main animation driver. Run this function every 500 ms
            animationTimer = setTimeout(play, 500);
        }

        function playStop() {
            if (!stop()) {
                play();
            }
        }
    </script>

</body>

</html>