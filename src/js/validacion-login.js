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

// Marca el campo en rojo y crea un span con el mensaje justo debajo
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
    //Buscamos el formulario de Login en el HTML
    const form = document.getElementById("formLogin");

    //Procedemos al hacer click en login
    form.addEventListener("submit", function (evento) 
    {
        //Borrarmos feedback errores previos
        limpiarErrores();

        //Obtenemos valores escritos en User y Password
        const inputUsuario = document.getElementById("username");
        const inputPass = document.getElementById("password");

        // Usamos trim() para quitar espacios erroneos (blancos y tabuladores)
        const valorUsuario = inputUsuario.value.trim();
        const valorPass = inputPass.value.trim();

        let esValido = true;
        let mensajeError = "";

        //Verificamos si el usuario se ha quedado vacío
        if(valorUsuario === "")
        {
            esValido = false;
            const err = "Debes introducir un nombre de usuario.";
            mensajeError += err + "\n";
            mostrarError("username", err);
        }

        //Verificamos si la contrasenya se ha quedado vacia
        if(valorPass === "")
        {
            esValido = false;
            const err = "Debes introducir una contraseña.";
            mensajeError += err + "\n";
            mostrarError("password", err);
        }

        //Devuelve los errores y detiene la accion
        if(!esValido)
        {
            evento.preventDefault();
            console.log("Errores detectados:", mensajeError);
        }

    });
});
