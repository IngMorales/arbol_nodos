<!DOCTYPE html>
<html>
<head>
    <title>Árbol de Líderes y Personas</title>
    <meta charset="utf-8">
    <script src="d3.min.js"></script> 
    <style>
        .node circle {
            fill: #fff;
            stroke: steelblue;
            stroke-width: 3px;
        }

        .node text {
            font: 12px sans-serif;
        }

        .link {
            fill: none;
            stroke: #ccc;
            stroke-width: 2px;
        }
    </style>
</head>
<body>
    <h1>Árbol de Líderes y Personas</h1>
    <div id="arbol"></div>
    <script src="arbol.js"></script>
</body>
</html>
