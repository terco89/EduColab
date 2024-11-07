
function setBgOption(option) {
    document.getElementById('bgOption').value = option;
}

document.addEventListener('DOMContentLoaded', function() {
    const imagenes = [{
            nombre: "Fondo 1",
            archivo: "bg1.jpg"
        },
        {
            nombre: "Fondo 2",
            archivo: "bg2.jpg"
        },
        {
            nombre: "Fondo 3",
            archivo: "bg3.jpg"
        },
        {
            nombre: "Fondo 4",
            archivo: "bg4.jpg"
        },
        {
            nombre: "Fondo 5",
            archivo: "bg5.jpg"
        },
        {
            nombre: "Fondo 6",
            archivo: "bg6.jpg"
        },
        {
            nombre: "Fondo 7",
            archivo: "bg7.jpg"
        },
        {
            nombre: "Fondo 8",
            archivo: "bg8.jpg"
        },
        {
            nombre: "Fondo 9",
            archivo: "bg9.jpg"
        },
        {
            nombre: "Fondo 10",
            archivo: "bg10.jpg"
        }
    ];

    const dropdown = document.getElementById('bgDropdown');
    const preview = document.getElementById('bgPreview');
    const backgroundSelector = document.getElementById('backgroundSelector');
    const colorSelector = document.getElementById('colorSelector');
    const colorPicker = document.getElementById('colorPicker');
    const colorPreview = document.getElementById('colorPreview');

    imagenes.forEach(imagen => {
        const option = document.createElement('option');
        option.value = imagen.archivo;
        option.textContent = imagen.nombre;
        dropdown.appendChild(option);
    });

    let imagenSeleccionada = '';

    dropdown.addEventListener('change', function() {
        const archivoSeleccionado = this.value;
        imagenSeleccionada = archivoSeleccionado;
        preview.style.backgroundImage = `url('img/fondos/${archivoSeleccionado}')`;
        preview.style.backgroundSize = 'cover';
    });

    dropdown.addEventListener('mouseover', function(event) {
        const archivoSeleccionado = event.target.value;
        if (archivoSeleccionado) {
            preview.style.backgroundImage = `url('img/fondos/${archivoSeleccionado}')`;
            preview.style.backgroundSize = 'cover';
        }
    });

    dropdown.addEventListener('mouseout', function() {
        if (imagenSeleccionada) {
            preview.style.backgroundImage = `url('img/fondos/${imagenSeleccionada}')`;
            preview.style.backgroundSize = 'cover';
        } else {
            preview.style.backgroundImage = '';
        }
    });

    document.getElementById('background-tab').addEventListener('click', function() {
        backgroundSelector.style.display = 'block';
        colorSelector.style.display = 'none';
        setBgOption('background');
    });

    document.getElementById('color-tab').addEventListener('click', function() {
        backgroundSelector.style.display = 'none';
        colorSelector.style.display = 'block';
        setBgOption('color');
    });

    colorPicker.addEventListener('input', function() {
        const color = this.value;
        colorPreview.style.backgroundColor = color;
    });
});