document.addEventListener("DOMContentLoaded", function () 
{
    //Buscamos el formulario de Login en el HTML
    const form = document.getElementById("formLogin");

    //Procedemos al hacer click en login
    form.addEventListener("submit", function (evento) 
    {

        //Obtenemos valores escritos en User y Password
        const inputUsuario = document.getElementById("username");
        const inputPass = document.getElementById("password");

        // Usamos trim() para quitar espacios erroneos
        const valorUsuario = inputUsuario.value.trim();
        const valorPass = inputPass.value.trim();

        let esValido = true;
        let mensajeError = "";

        //Verificamos si el usuario se ha quedado vacío
        if(valorUsuario == "")
        {
            esValido = false;
            mensajeError += "Debes introducir un nombre de usuario.\n"
        }

        //Verificamos si la contrasenya se ha quedado vacia
        if(valorPass == "")
        {
            esValido = false;
            mensajeError += "Debes introducir una contraseña.\n"
        }

        //Devuelve los errores y detiene la accion
        if(!esValido)
        {
            evento.preventDefault();
            console.log("Errores detectados:", mensajeError);
        }

    });
});