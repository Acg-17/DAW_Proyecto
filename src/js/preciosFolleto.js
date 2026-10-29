const fotosPP = 3;
const precioBase = 10;
const pocasPag = 2.0; //Menos de 5
const medioPag = 1.8; //5 a 10
const muchasPag = 1.6; //Mas de 10
const extraColor = 0.5; //Por foto
const extraAltaRes = 0.2; //Por foto

const local = 'es-ES';
const fractionDigits = {
    minimumFractionDigits: 2, 
    maximumFractionDigits: 2
};

const htmlElement = document.getElementById('tablaPrecios');
const boton = document.getElementById('botonTablaPrecios');

crearTabla();

boton.addEventListener('click', () => {
htmlElement.children[2].classList.toggle('oculto');
if(boton.textContent == "Mostrar")
    boton.textContent = "Ocultar"
else
    boton.textContent = "Mostrar"
});


function calcularFotos(nFotos, color, altaRes)
{
    var result = 0.0;
    if(color)
    {
        result += extraColor;
    }
    if(altaRes)
    {
        result += extraAltaRes;
    }
    result = result*nFotos;
    return result;
}

function crearTabla()
{
    const tabla = document.createElement("table");
    const encabezado = document.createElement("thead");
    const encabezado1 = document.createElement("tr");
    const encabezado2 = document.createElement("tr");

    //Celdas de la primera fila
    const vacio1 = document.createElement("th");
    const vacio2 = document.createElement("th");
    const bnTitulo = document.createElement("th");
    bnTitulo.textContent = "Blanco y negro";
    bnTitulo.setAttribute("colspan", "2");
    const colorTitulo = document.createElement("th");
    colorTitulo.textContent = "Color";
    colorTitulo.setAttribute("colspan", "2");

    encabezado1.appendChild(vacio1);
    encabezado1.appendChild(vacio2);
    encabezado1.appendChild(bnTitulo);
    encabezado1.appendChild(colorTitulo);

    //Celdas de la segunda fila
    const nPags = document.createElement("th");
    nPags.textContent = "Número de páginas";
    const nFotos = document.createElement("th");
    nFotos.textContent = "Número de fotos";
    const lowDPI = document.createElement("th");
    lowDPI.textContent = "150-300 dpi";
    const highDPI = document.createElement("th");
    highDPI.textContent = "450-900 dpi";

    encabezado2.appendChild(nPags);
    encabezado2.appendChild(nFotos);
    encabezado2.appendChild(lowDPI);
    encabezado2.appendChild(highDPI);
    encabezado2.appendChild(lowDPI.cloneNode(true));
    encabezado2.appendChild(highDPI.cloneNode(true));

    //Agrupar en el thead
    encabezado.appendChild(encabezado1);
    encabezado.appendChild(encabezado2);

    //Agregar a la tabla
    tabla.appendChild(encabezado);

    var acumulado = 0.0;

    for(var i=1; i < 16; i++)
    {
        var fotos = i*fotosPP;
        if(i < 5)
        {
            acumulado += pocasPag;
        } else if(i < 11)
        {
            acumulado += medioPag;
        } else
        {
            acumulado += muchasPag;
        }

        const fila = document.createElement("tr");

        const col1 = document.createElement("td");
        col1.textContent = `${i}`;
        const col2 = document.createElement("td");
        col2.textContent = `${fotos}`;
        const col3 = document.createElement("td");
        col3.textContent = `${(precioBase + acumulado + calcularFotos(fotos, false, false)).toLocaleString(local, fractionDigits)} €`;
        const col4 = document.createElement("td");
        col4.textContent = `${(precioBase + acumulado + calcularFotos(fotos, false, true)).toLocaleString(local, fractionDigits)} €`
        const col5 = document.createElement("td");
        col5.textContent = `${(precioBase + acumulado + calcularFotos(fotos, true, false)).toLocaleString(local, fractionDigits)} €`
        const col6 = document.createElement("td");
        col6.textContent = `${(precioBase + acumulado + calcularFotos(fotos, true, true)).toLocaleString(local, fractionDigits)} €`

        fila.appendChild(col1);
        fila.appendChild(col2);
        fila.appendChild(col3);
        fila.appendChild(col4);
        fila.appendChild(col5);
        fila.appendChild(col6);

        tabla.appendChild(fila);
    }


    htmlElement.appendChild(tabla);
}