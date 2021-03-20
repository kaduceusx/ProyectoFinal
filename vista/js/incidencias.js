/* -------------------------------------------------------------------------- */
/*                        SUBIENDO LA FOTO DEL USUARIO                        */
/* -------------------------------------------------------------------------- */

$(".nuevaFoto").change(function() {

    var imagen = this.files[0];

    //Validamos el formato de imagen para jpeg jpg y png

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaFoto").val("");

        swal({
                                
            type: "error",
            title: "Error al subir la imagen",
            text: "La imagen debe estar en formato JPEG O PNG.",
            confirmButtonText: "Cerrar",

        });


    }else if (imagen["size"] > 2000000){

        $(".nuevaFoto").val("");

        swal({
                                
            type: "error",
            title: "Error al subir la imagen",
            text: "La imagen debe pesar más de 2MB.",
            confirmButtonText: "Cerrar",

        });

    }else {

        var datosImagen = new FileReader;

        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);

        })

    }


    

})



/* -------------------------------------------------------------------------- */
/*                        EDITAR USUARIO                                      */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_editarUsuario", function (){

    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();

    datos.append("idUsuario", idUsuario);

    $.ajax({

        url : "ajax/usuarios.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            console.log("respuesta" , respuesta);

            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarDni").val(respuesta["dni"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#editarNacimiento").val(respuesta["nacimiento"]);
            $("#editarProvincia").val(respuesta["provincia"]);
            $("#editarLocalidad").val(respuesta["localidad"]);
            $("#editarDomicilio").val(respuesta["domicilio"]);
            $("#editarCivil").html(respuesta["civil"]);
            $("#editarCivil").val(respuesta["civil"]);
            $("#fotoActual").val(respuesta["foto"]);

            $("#passwordActual").val(respuesta["password"]);

            if(respuesta["foto"] != ""){

                $(".previsualizar").attr("src", respuesta["foto"]);

            }

        }

    });

})



/* -------------------------------------------------------------------------- */
/*                               ACTIVAR USUARIO                              */
/* -------------------------------------------------------------------------- */
//$(".btnActivar").click(function (){ si se deja la clase asi, se dibuja antes del dom por eso hay que hacerlo al cargar el documento. 
$(document).on("click" , ".btnActivar", function (){


    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();

    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

        url : "ajax/usuarios.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "El usuario ha sido actualizado",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "usuarios";
                    }
                });

            }
            

        }

    })

    if(estadoUsuario ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("Baja");
        $(this).attr("estadoUsuario", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Alta");
        $(this).attr("estadoUsuario", 0);

    }

})



/* -------------------------------------------------------------------------- */
/*                  REVISAR SI EL USUARIO YA ESTA REGISTRADO                  */
/* -------------------------------------------------------------------------- */
$("#nuevoUsuario").change(function (){

    //$(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();

    datos.append("validarUsuario", usuario);

    $.ajax({

        url : "ajax/usuarios.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            //console.log(respuesta);
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos.</div>');

                $("#nuevoUsuario").val("");

            }

        }
    })



});


/* -------------------------------------------------------------------------- */
/*                              ELIMINAR USUARIO                              */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_eliminarUsuario", function (){

    var idUsuario = $(this).attr("idUsuario");

    var fotoUsuario = $(this).attr("fotoUsuario");

    var nombreUsuario = $(this).attr("nombreUsuario");


    swal({
                                
        type: "warning",
        title: "Estas seguro de borrar el usuario?",
        text: "Si no lo estas puedes cancelar la opción.",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar usuario."

    }).then ((result)=>{

        if(result.value){

            window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&nombreUsuario="+nombreUsuario+"&fotoUsuario="+fotoUsuario;

        }

    })

});





