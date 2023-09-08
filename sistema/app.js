let menu = document.getElementById("menu");
let sideMenu = document.getElementById("side-menu");
let x = document.getElementById("x");
menu.addEventListener("click", function() {
   sideMenu.style.left ="0px";

});
x.addEventListener("click",function(){
    sideMenu.style.left= "-250px";
});

let userTable = document.getElementById("userTable");

// Función para agregar una nueva fila con botones de Editar y Borrar
function agregarFila(id, rol, nombre) {
    let newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>${id}</td>
        <td>${rol}</td>
        <td>${nombre}</td>
        <td><button class="EditarBtn">Editar</button></td>
        <td><button class="EliminarBtn">Eliminar</button></td>
    `;
    userTable.appendChild(newRow);
}

// Llamada a la función para agregar una fila de ejemplo
agregarFila("1", "Admin", "Juan Pérez");

// Event listener para botones de Editar y Borrar (puedes manejar la lógica según tus necesidades)
userTable.addEventListener("click", function(event) {
    if (event.target.classList.contains("EditarBtn")) {
        // Lógica para editar
        console.log("Editar fila");
    } else if (event.target.classList.contains("EliminarBtn")) {
        // Lógica para borrar
        console.log("Borrar fila");
    }
});
