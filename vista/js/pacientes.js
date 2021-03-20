/* -------------------------------------------------------------------------- */
/*                        SUBIENDO LA FOTO DEL PACIENTE                        */
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
/*                        EDITAR PACIENTE                                      */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_editarPaciente", function (){

    var idPaciente = $(this).attr("idPaciente");

    var datos = new FormData();

    datos.append("idPaciente", idPaciente);

    $.ajax({

        url : "ajax/pacientes.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            console.log("respuesta" , respuesta);

            $("#editarId").val(respuesta["id"]);
            $("#editarPaciente").val(respuesta["paciente"]);
            $("#editarSip").val(respuesta["sip"]);
            $("#editarDni").val(respuesta["dni"]);
            $("#editarNuss").val(respuesta["nuss"]);
            $("#editarFamiliar").val(respuesta["familiar"]);
            $("#editarNacimiento").val(respuesta["nacimiento"]);
            $("#editarProvincia").val(respuesta["provincia"]);
            $("#editarLocalidad").val(respuesta["localidad"]);
            $("#editarDomicilio").val(respuesta["domicilio"]);
            $("#editarCivil").html(respuesta["civil"]);
            $("#editarCivil").val(respuesta["civil"]);
            $("#editarGenero").html(respuesta["genero"]);
            $("#editarGenero").val(respuesta["genero"]);
            $("#editarIngreso").html(respuesta["ingreso"]);
            $("#editarIngreso").val(respuesta["ingreso"]);

            $("#editarDemencia").val(respuesta["demencia"]);
            $("#editarCronica").val(respuesta["cronica"]);
            $("#editarAlergias").val(respuesta["alergias"]);
            $("#editarSuplementos").val(respuesta["suplementos"]);

            $("#editarSituacion").html(respuesta["situacion"]);
            $("#editarSituacion").val(respuesta["situacion"]);


            $("#fotoActual").val(respuesta["foto"]);

           

            if(respuesta["foto"] != ""){

                $(".previsualizar").attr("src", respuesta["foto"]);

            }

        }

    });

})






/* -------------------------------------------------------------------------- */
/*                               ACTIVAR PACIENTE                              */
/* -------------------------------------------------------------------------- */
//$(".btnActivar").click(function (){ si se deja la clase asi, se dibuja antes del dom por eso hay que hacerlo al cargar el documento. 
$(document).on("click" , ".btnActivar", function (){


    var idPaciente = $(this).attr("idPaciente");
    var estadoPaciente = $(this).attr("estadoPaciente");

    var datos = new FormData();

    datos.append("activarId", idPaciente);
    datos.append("activarPaciente", estadoPaciente);

    $.ajax({

        url : "ajax/pacientes.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "El paciente ha sido actualizado",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "pacientes";
                    }
                });

            }
            

        }

    })

    if(estadoPaciente ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("Baja");
        $(this).attr("estadoPaciente", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Alta");
        $(this).attr("estadoPaciente", 0);

    }

})



/* -------------------------------------------------------------------------- */
/*                  REVISAR SI EL PACIENTE YA ESTA REGISTRADO                  */
/* -------------------------------------------------------------------------- */
// $("#nuevoPaciente").change(function (){

//     $(".alert").remove();

//     var paciente = $(this).val();

//     var datos = new FormData();

//     datos.append("validarPaciente", paciente);

//     $.ajax({

//         url : "ajax/pacientes.ajax.php",
//         method : "POST",
//         data : datos,
//         cache : false,
//         contentType : false,
//         processData : false,
//         dataType : "json",
//         success: function (respuesta){

//             if(respuesta){

//                 $("#nuevoPaciente").parent().after('<div class="alert alert-warning">Este paciente ya existe en la base de datos.</div>');

//                 $("#nuevoPaciente").val("");

//             }

//         }
//     })



// });





/* -------------------------------------------------------------------------- */
/*                              ELIMINAR PACIENTE                              */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_eliminarPaciente", function (){

    var idPaciente = $(this).attr("idPaciente");

    var fotoPaciente = $(this).attr("fotoPaciente");

    var nombrePaciente = $(this).attr("nombrePaciente");
    


    swal({
        
                                
        type: "warning",
        title: "Estas seguro de borrar el paciente?, Solo se podrá borrar si el paciente esta dado de baja por el médico.",
        text: "Si no lo estas puedes cancelar la opción.",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar paciente."

    }).then ((result)=>{

        if(result.value){

            window.location = "index.php?ruta=pacientes&idPaciente="+idPaciente+"&nombrePaciente="+nombrePaciente+"&fotoPaciente="+fotoPaciente;

        }

    })

});
