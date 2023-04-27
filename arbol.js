// Configurar tamaño del contenedor y márgenes
var width = 500;
var height = 500;
var margin = {top: 10, right: 120, bottom: 10, left: 120};

// Crear el contenedor SVG y ajustar el tamaño y los márgenes
var svg = d3.select("body").append("svg")
    .attr("width", width + margin.right + margin.left)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Crear un layout de árbol y establecer el tamaño del área de dibujo
var tree = d3.tree()
    .size([height, width - 200]);

// Cargar los datos del archivo PHP y crear la estructura del árbol
d3.json("arbol.php", function(error, data) {
    if (error) throw error;

    // Establecer la raíz del árbol
    var root = d3.hierarchy(data);

    // Calcular la posición de cada nodo
    tree(root);

    // Añadir los enlaces entre los nodos
    svg.selectAll(".link")
        .data(root.descendants().slice(1))
        .enter().append("path")
        .attr("class", "link")
        .attr("d", function(d) {
            return "M" + d.y + "," + d.x
                + "C" + (d.parent.y + 50) + "," + d.x
                + " " + (d.parent.y + 50) + "," + d.parent.x
                + " " + d.parent.y + "," + d.parent.x;
        });

    // Añadir los nodos
    var node = svg.selectAll(".node")
        .data(root.descendants())
        .enter().append("g")
        .attr("class", "node")
        .attr("transform", function(d) {
            return "translate(" + d.y + "," + d.x + ")";
        });

    // Añadir el círculo a cada nodo
    node.append("circle")
        .attr("r", 10);

    // Añadir el texto a cada nodo
    node.append("text")
        .attr("dy", 3)
        .attr("x", function(d) { return d.children ? -13 : 13; })
        .style("text-anchor", function(d) { return d.children ? "end" : "start"; })
        .text(function(d) { return d.data.name; });
});
