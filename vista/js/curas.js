

/* -------------------------------------------------------------------------- */
/*                        EDITAR CURA                                      */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_editarCura", function (){

    var idCura = $(this).attr("idCura");

    var datos = new FormData();

    datos.append("idCura", idCura);

    $.ajax({

        url : "ajax/curas.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "json",
        success: function (respuesta){

            console.log("respuesta" , respuesta);

            $("#editarId_Seguimiento_cura").val(respuesta["id"]);

            $("#editarId_pacienteCura").val(respuesta["id_paciente"]);
          
            //$("#editarFechaCura").val(respuesta["fechaCura"]);

            $("#editarCura").val(respuesta["cura"]);
          
           


        }

    });

})








/* -------------------------------------------------------------------------- */
/*                              ELIMINAR CURA                              */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btn_eliminarCura", function (){

    var idCura = $(this).attr("idCura");

    var nombreCura = $(this).attr("nombreCura");


    swal({
                                
        type: "warning",
        title: "Estas seguro de quitar esta cura?",
        text: "Si no lo estas puedes cancelar la opción.",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, cura realizada."

    }).then ((result)=>{

        if(result.value){

            window.location = "index.php?ruta=pacientes_enfermero&idCura="+idCura+"&nombreCura="+nombreCura;

        }

    })

});











