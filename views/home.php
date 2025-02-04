<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja Aplikacja</title>

    <script  type="module"  src="/js/main.js" ></script>
</head>
<body>

<a href="https://mapa.targeo.pl/" id="TargeoMapContainer" style="position:relative;margin:0 auto;top:0;width:980px;height:600px;" >Mapa Polski Targeo</a>

<script  src="https://mapa.targeo.pl/Targeo.html?vn=3_0&k=ZjlhMmU2Nzc5OGQwNjczMWZkYWE2MGRlZTY1ZjRkY2U3M2E1M2ZkYg==&f=TargeoMapInitialize&e=TargeoMapContainer&ln=pl" type="text/javascript" ></script>
</body>
</html>


<!--<!DOCTYPE html>-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<!--<head>-->
<!--    <title>Mapa Targeo</title>-->
<!--    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>-->
<!--    <link rel="shortcut icon" href="/i/targeo-favicon.ico"/>-->
<!--    <link rel="icon" href="/i/targeo-favicon.png" type="image/png"/>-->
<!--    <script type="text/javascript">-->
<!--        var Mapa;-->
<!---->
<!--        function TargeoMapInitialize() {-->
<!--            var mapOptions = {-->
<!--                container: 'TargeoMapContainer',-->
<!--                z: 22,-->
<!--                c: {x: 18.6477108001709, y: 54.3595085144043},-->
<!--                modArguments: {-->
<!--                    Ribbon: {controls: ['MapMenu', 'FTS', 'FindRoute']},-->
<!--                    Buildings3D: {disabled: false, on: true},-->
<!--                    POI: {disabled: false, submit: true, correct: true, visible: true},-->
<!--                    FTS: {disabled: false},-->
<!--                    FindRoute: {disabled: false},-->
<!--                    Traffic: {disabled: false, visible: false},-->
<!--                    Layers: {modes: ['map', 'satellite']}-->
<!--                }-->
<!--            };-->
<!--            Mapa = new Targeo.Map(mapOptions);-->
<!--            Mapa.initialize();-->
<!--            p1 = new Targeo.MapObject.Point(-->
<!--                {x: 18.6477108001709, y: 54.3595085144043},-->
<!--                {-->
<!--                    imageUrl: 'https://mapa.targeo.pl/i/icons/pins/pin-b.png',-->
<!--                    w: 27,-->
<!--                    h: 28,-->
<!--                    coordsAnchor: {x: 9, y: 25},-->
<!--                    z: {-->
<!--                        24: {-->
<!--                            imageUrl: 'https://mapa.targeo.pl/i/icons/pins/pinbig-b.png',-->
<!--                            w: 38,-->
<!--                            h: 39,-->
<!--                            coordsAnchor: {x: 12, y: 36}-->
<!--                        }-->
<!--                    }-->
<!--                },-->
<!--                null,-->
<!--            );-->
<!--            console.log(p1)-->
<!--            console.log(Mapa.UOAdd(p1));-->
<!--        }-->
<!--    </script>-->
<!--</head>-->
<!--<body>-->
<!--<a href="https://mapa.targeo.pl/" id="TargeoMapContainer"-->
<!--   style="position:relative;margin:0 auto;top:0;width:980px;height:600px;">Mapa Polski Targeo</a>-->
<!--<script src="https://mapa.targeo.pl/Targeo.html?vn=3_0&k=ZjlhMmU2Nzc5OGQwNjczMWZkYWE2MGRlZTY1ZjRkY2U3M2E1M2ZkYg==&f=TargeoMapInitialize&e=TargeoMapContainer&ln=pl"-->
<!--        type="text/javascript"></script>-->
<!--</body>-->
<!--</html>-->