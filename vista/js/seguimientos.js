

/* -------------------------------------------------------------------------- */
/*                        EDITAR SEGUIMIENTO                                      */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_editarSeguimiento", function (){

    var idSeguimiento = $(this).attr("idSeguimiento");

    var datos = new FormData();

    datos.append("idSeguimiento", idSeguimiento);

    $.ajax({

        url : "ajax/seguimientos.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            console.log("respuesta" , respuesta);

            $("#editarId_Seguimiento").val(respuesta["id"]);
            $("#editarId_paciente").val(respuesta["id_paciente"]);
            $("#editarIngesta").val(respuesta["ingesta"]);
            $("#editarMiccion").val(respuesta["miccion"]);
            $("#editarDefecacion").val(respuesta["defecacion"]);
          
           


        }

    });

})









