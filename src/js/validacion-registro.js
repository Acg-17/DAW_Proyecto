/*---------------------------------------------------------------------------*/
/* ESTANDARES */
/*---------------------------------------------------------------------------*/

//Compruba si hay algun caracter en minuscula
function esMinuscula(caracter)
{
    const codigo = caracter.charCodeAt(0);
    return codigo >= 97 && codigo <= 122;
}

//Comprueba si hay mayusculas
function esMayuscula(caracter)
{
    const codigo = caracter.charCodeAt(0);
    return codigo >= 65 && codigo <= 90;
}

//Comprueba asi tiene letras
function esLetra(caracter)
{
    return esMayuscula(caracter) || esMinuscula(caracter);
}

//Comprueba si un caracter es un numero (0-9)
function esNumero(caracter)
{
    const codigo = caracter.charCodeAt(0);
    return codigo >= 48 && codigo <= 57;
}

/*---------------------------------------------------------------------------*/
/* USUARIO */
/*---------------------------------------------------------------------------*/

//Validacion nombre usuario
function validarNombreUsuario(nombre)
{
    if(nombre.length < 3 || nombre.length > 15)
    {
        return "El nombre debe tener entre 3 y 15 caracteres.";
    }

    if(esNumero(nombre.charAt(0)))
    {
        return "El nombre de usuario no puede comenzar por un numero.";
    }

    for (let i = 0; i < nombre.length; i++)
    {
        const c = nombre.charAt(i);
        if(!esLetra(c) && !esNumero(c))
        {
            return "El nombre solo puede contener letras y numeros.";
        }
    }

    //Acaba sin error
    return "";
}


/*---------------------------------------------------------------------------*/
/* CONTRASENYA */
/*---------------------------------------------------------------------------*/

//Validacion contraseña
function validarContrasena(pass)
{
    //Comprobamos si la contrasena tiene entre 6 y 15 caracteres
    if(pass.length < 6 || pass.length > 15)
    {
        return "La contrasena debe tener entre 6 y 15 caracteres.";
    }

    let tieneMayuscula = false;
    let tieneMinuscula = false;
    let tieneNumero = false;

    //Recorremos para ver si la contrasena cumple con su formato
    for (let i = 0; i < pass.length; i++)
    {
        const c = pass.charAt(i);

        if(esMayuscula(c))
        {
            tieneMayuscula = true;
        }
            else if(esMinuscula(c))
            {
                tieneMinuscula = true;
            }
            else if(esNumero(c))
            {
                tieneNumero = true;
            }
            else if(c == "-" || c == "_")
            {   
            }
        else
        {
            return "La contrasena contiene caracteres no permitidos.";
        }
    }

    //Verificamos si tiene los caracteres minimos necesarios
    if(!tieneMayuscula || !tieneMinuscula || !tieneNumero)
    {
        return "La contrasena debe tener por lo menos una mayuscula, un numero y una minuscula.";
    }

    return "";
}

//Validacion de si las contrasenas son iguales
function validarRepetirContrasena(pass, repPass)
{
    if(pass !== repPass)
    {
        return "Las contrasenas deben ser iguales.";
    }
    return "";
}


/*---------------------------------------------------------------------------*/
/* SEXO */
/*---------------------------------------------------------------------------*/

//Validacion seleccion sexo
function validarSexo(sexo)
{
   if(sexo === "" || sexo === null)
   {
        return "Debes seleccionar una opcion para el sexo.";
   } 

   return "";
}


/*---------------------------------------------------------------------------*/
/* FECHA NACIMIENTO */
/*---------------------------------------------------------------------------*/

//Validar Fecha de Nacimiento Correcta
function validarFechaNacimiento(fechaTexto)
{
    if(fechaTexto.trim() === "")
    {
        return "La fecha de nacimiento es obligatoria.";
    }

    //Division en secciones
    const partes = fechaTexto.split("-");
    if (partes.length !== 3)
    {
        return "El formacto de la fecha debe ser DD-MM-AAAA"
    }

    const anio = parseInt(partes[2], 10);
    const mes = parseInt(partes[1], 10);
    const dia = parseInt(partes[0], 10);

    //Comprobar si los valores son numeros
    if(isNaN(anio) || isNaN(mes) || isNaN(dia))
    {
        return "La fecha debe contener numeros validos.";
    }

    //Comprobamos si el mes esta dentro del rango correcto
    if(mes < 1 || mes > 12)
    {
        return "El mes de nacimiento no es valido.";
    }
    
    //Usamos Date para hacer comprobaciones especificas (saber si es una fecha real)
    const fechaObj = new Date(anio, mes - 1, dia);

    //Verificamos si la fecha es real
    if(fechaObj.getFullYear() !== anio || fechaObj.getMonth() !== (mes - 1) || fechaObj.getDate() !== dia)
    {
        return "La fecha introducida no existe en el calendario.";
    }

    //Definimos variables apra saber si tiene +18 anios
    const hoy = new Date();
    let edad = hoy.getFullYear() - anio;
    const diferenciaMes = hoy.getMonth() - (mes - 1);
    const diferenciaDia = hoy.getDate() - dia;

    //Si aun no es el mes y dia de su cumpleanios le restamos un anio
    if (diferenciaMes < 0 || (diferenciaMes === 0 && diferenciaDia < 0))
    {
        edad--;
    }

    if(edad < 18)
    {
        return "Debes tener 18 anios para poder ingresar.";
    }

    return "";
}


/*---------------------------------------------------------------------------*/
/* EMAIL */
/*---------------------------------------------------------------------------*/

//Validar Fecha de Nacimiento Correcta
function esCaracterEspecialEmail(character)
{
    const permitidos = "!#$%&'*+-/=?^_`{|}~";
    return permitidos.includes(character);
}

function validarEmail(email)
{
    //Comprueba si esta vacio
    if(email.trim() === "")
    {
        return "El correo no puede estar vacio";
    }

    //Verifica si es mas largo de 254 caracteres
    if(email.length > 254)
    {
        return "El correo no puede superar los 254 caracteres";
    }

    //Comprobamos si solo hay una arroba
    const partesArroba = email.split("@");

    if(partesArroba.length !== 2)
    {
        return "Debe haber solo una @rroba."
    }

    const parteLocal = partesArroba[0];
    const dominio = partesArroba[1];

    /* VALIDACION LOCAL */
    //Validamos que parte local tiene entre 1 y 64 caracteres
    if (parteLocal.length < 1 || parteLocal.length > 64) 
    {
        return "La parte local del correo debe tener entre 1 y 64 caracteres.";
    }

    //Verficamos que punto no esta entre inicio o final
    if (parteLocal.startsWith(".") || parteLocal.endsWith(".")) 
    {
        return "El punto no puede estar al inicio ni al final de la parte local del correo.";
    }

    //Verificamos parte local no tiene dos puntos seguidos
    if (parteLocal.includes("..")) 
    {
        return "La parte local del correo no puede tener dos puntos seguidos.";
    }

    //Verificamos si todos los caracteres son validos
    for (let i = 0; i < parteLocal.length; i++) 
    {
        const c = parteLocal.charAt(i);

        if (!esLetra(c) && !esNumero(c) && !esCaracterEspecialEmail(c) && c !== ".") 
        {
            return "La parte local del correo contiene caracteres no permitidos.";
        }
    }

    /* VALIDACION DOMINIO */
    //Validamos que parte dominio tiene entre 1 y 255 caracteres
    if (dominio.length < 1 || dominio.length > 255) 
    {
        return "El dominio del correo debe tener entre 1 y 255 caracteres.";
    }

    const subdominios = dominio.split(".");

    // Debe tener al menos dos partes separadas por punto
    if (subdominios.length < 2) 
    {
        return "El dominio debe contener al menos un punto separador.";
    }

    //Verificamos que los subdominios tambien son correctos
    for (let i = 0; i < subdominios.length; i++) 
    {
        const sub = subdominios[i];

        //Comprobamos subdominio tiene entre 1 y 63 caracteres
        if (sub.length < 1 || sub.length > 63) 
        {
            return "Cada subdominio debe tener entre 1 y 63 caracteres.";
        }

        //Verificamos no acaba ni empieza con guion
        if (sub.startsWith("-") || sub.endsWith("-")) 
        {
            return "Los subdominios no pueden empezar ni terminar con guion.";
        }

        //Comprobamos dominio no tiene caracteres especiales
        for (let j = 0; j < sub.length; j++) 
        {
            const c = sub.charAt(j);
            if (!esLetra(c) && !esNumero(c) && c !== "-") 
            {
                return "Los subdominios solo pueden contener letras, números y guiones.";
            }
        }
    }

    return "";
}


/*---------------------------------------------------------------------------*/
/* ERRORES FEEDBACK VISUAL */
/*---------------------------------------------------------------------------*/

// Quita los bordes rojos y los mensajes de error previos
function limpiarErrores() 
{
    const inputs = document.querySelectorAll(".campo-error");
    inputs.forEach(input => input.classList.remove("campo-error"));

    const mensajes = document.querySelectorAll(".texto-error");
    mensajes.forEach(msg => msg.remove());
}

// Marca el campo en rojo y crea un párrafo con el mensaje justo debajo
function mostrarError(idElemento, mensaje) 
{
    const elemento = document.getElementById(idElemento);
    elemento.classList.add("campo-error");

    const span = document.createElement("span");
    span.className = "texto-error";
    span.textContent = mensaje;

    // Se coloca justo después del campo con fallo
    elemento.after(span);
}

/*---------------------------------------------------------------------------*/
/* EVENTLISTENER */
/*---------------------------------------------------------------------------*/
document.addEventListener("DOMContentLoaded", function ()
{
    //Buscamos el elemento formRegistro en el HTML
    const form = document.getElementById("formRegistro");

    //Comprobamos si se ha accionado el boton de submit
    form.addEventListener("submit", function (evento)
    {
        //Borrarmos feedback errores 
        limpiarErrores();
        let errores = [];

        //Usamos trim quitar espacios erroneos (delante y detras)
        const valorUsuario = document.getElementById("usuario").value.trim();
        const valorPass = document.getElementById("password").value;
        const valorRepPass = document.getElementById("repPass").value;

        const valorEmail = document.getElementById("email").value.trim();

        const valorSexo = document.getElementById("sexo").value;

        const valorFecha = document.getElementById("birthdate").value.trim();


        //Validamos usuario
        const errorUsuario = validarNombreUsuario(valorUsuario);
        if (errorUsuario !== "")
        {
            errores.push(errorUsuario);
            mostrarError("usuario", errorUsuario);
        }

        //Validamos contrasena
        const errorPass = validarContrasena(valorPass);
        if (errorPass !== "")
        {
            errores.push(errorPass);
            mostrarError("password", errorPass);
        } 

        //Validamos segunda contrasena
        const errorRepPass = validarRepetirContrasena(valorPass, valorRepPass);
        if (errorRepPass !== "")
        {
            errores.push(errorRepPass);
            mostrarError("repPass", errorRepPass);
        }
       
        //Validamos email
        const errorEmail = validarEmail(valorEmail);
        if (errorEmail !== "")
        {
            errores.push(errorEmail);
            mostrarError("email", errorEmail);
        }
       
        //Validamos sexo
        const errorSexo = validarSexo(valorSexo);
        if (errorSexo !== "")
        {
            errores.push(errorSexo);
            mostrarError("sexo", errorSexo);
        }
       
        //Validamos fecha cumpleanios
        const errorFecha = validarFechaNacimiento(valorFecha);
        if (errorFecha !== "")
        {
            errores.push(errorFecha);
            mostrarError("birthdate", errorFecha);
        }

        //Si hay errores detenemos el envio
        if(errores.length > 0)
        {
            evento.preventDefault();
            console.log("Errores en el registro:", errores);
        }

        return "";

    });
});
