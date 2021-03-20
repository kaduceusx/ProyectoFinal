

/* -------------------------------------------------------------------------- */
/*                        EDITAR MEDICAMENTO                                      */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_editarMedicamento", function (){

    var idMedicamento = $(this).attr("idMedicamento");

    var datos = new FormData();

    datos.append("idMedicamento", idMedicamento);

    $.ajax({

        url : "ajax/medicamentos.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            console.log("respuesta" , respuesta);

            $("#editarId_medicamento").val(respuesta["id"]);
            $("#editarId_paciente_medicamento").val(respuesta["id_paciente"]);
            $("#editarDesayuno").val(respuesta["desayuno"]);
            $("#editarComida").val(respuesta["comida"]);
            $("#editarMerienda").val(respuesta["merienda"]);
            $("#editarCena").val(respuesta["cena"]);
            $("#editarNoche").val(respuesta["noche"]);
          
           


        }

    });

})










