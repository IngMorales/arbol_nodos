<!DOCTYPE html>
<html>

<head>
    <title>Árbol Multinivel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        #details {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h1 class="mb-3">Árbol Multinivel</h1>
        <div class="row">
            <div class="col-md-4">
                <div id="tree"></div>
            </div>
            <div class="col-md-8">
                <div id="details">
                    <div class="card mb-3">
                        <div class="card-header">
                            Detalles del Líder
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" id="leader-name"></h5>
                            <p class="card-text" id="leader-details"></p>
                        </div>
                    </div>
                    <h4>Personas Referidas:</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                            </tr>
                        </thead>
                        <tbody id="referidos">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            // Crear el árbol
            $('#tree').jstree({
                'core': {
                    'data': {
                        'url': 'get_tree_data.php',
                        'dataType': 'json'
                    },
                    'themes': {
                        'responsive': true,
                        'variant': 'small'
                    }
                }
            });

            // Manejar los eventos de selección del árbol
            $('#tree').on('select_node.jstree', function(e, data) {
                if (data.node.data.type === 'person') {
                    // Mostrar los detalles de la persona
                    $('#details').show();
                    $('#leader-name').text(data.node.data.name + ' ' + data.node.data.lastname);
                    $('#leader-details').text('Líder: ' + data.node.data.leader);
                    $('#referidos').empty();
                    $.get('get_referidos.php?id=' + data.node.id, function(data) {
                        // Rellenar la tabla con los referidos de la persona seleccionada
                        data.forEach(function(row) {
                            $('#referidos').append('<tr><td>' + row.name + '</td><td>' + row.lastname + '</td></tr>');
                        });
                    });
                } else {
                    // Ocultar los detalles de la persona si se selecciona un líder
                    $('#details').hide();
                }
            });
        });
    </script>
</body>

</html>