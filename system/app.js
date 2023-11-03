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


// Obtener referencias a los elementos de filtro
const brandFilter = document.getElementById("brand-filter");
const sizeFilter = document.getElementById("size-filter");
const modelFilter = document.getElementById("model-filter");
const categoryFilter = document.getElementById("category-filter");
const searchInput = document.getElementById("search-input");

// Obtener todas las tarjetas de zapatillas
const sneakerCards = document.querySelectorAll(".sneaker-card");

// Función de filtro
function filterSneakers() {
    const brandValue = brandFilter.value;
    const sizeValue = sizeFilter.value;
    const modelValue = modelFilter.value;
    const categoryValue = categoryFilter.value;
    const searchValue = searchInput.value.toLowerCase();

    sneakerCards.forEach((card) => {
        const sneakerInfo = card.querySelector(".sneaker-info").textContent.toLowerCase();

        const shouldShow = (
            (brandValue === "" || sneakerInfo.includes(brandValue)) &&
            (sizeValue === "" || sneakerInfo.includes(sizeValue)) &&
            (modelValue === "" || sneakerInfo includes(modelValue)) &&
            (categoryValue === "" || sneakerInfo.includes(categoryValue)) &&
            (searchValue === "" || sneakerInfo.includes(searchValue))
        );

        card.style.display = shouldShow ? "block" : "none";
    });
}

// Agregar event listeners para los cambios en los filtros
brandFilter.addEventListener("change", filterSneakers);
sizeFilter.addEventListener("change", filterSneakers);
modelFilter.addEventListener("change", filterSneakers);
categoryFilter.addEventListener("change", filterSneakers);
searchInput.addEventListener("input", filterSneakers);

// Llama a la función de filtro inicialmente para mostrar todas las zapatillas
filterSneakers();

