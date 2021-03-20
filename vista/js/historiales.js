

/* -------------------------------------------------------------------------- */
/*                        EDITAR HISTORIAL                                      */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_editarHistorial", function (){

    var idHistorial = $(this).attr("idHistorial");

    var datos = new FormData();

    datos.append("idHistorial", idHistorial);

    $.ajax({

        url : "ajax/historiales.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            console.log("respuesta" , respuesta);

            $("#editarId_historial").val(respuesta["id"]);

            $("#editarId_paciente").val(respuesta["id_paciente"]);
          
           

            $("#editarCirugias").val(respuesta["cirugias"]);
            $("#editarResonancias").val(respuesta["resonancias"]);
          
           


        }

    });

})









