
/* -------------------------------------------------------------------------- */
/*                             ACTIVAR INCIDENCIA ADMIN                         */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btnActivarIncidencia", function (){


    var idEstadoIncidencia = $(this).attr("idEstadoIncidencia");
    var estadoIncidencia = $(this).attr("estadoIncidencia");

    var datos = new FormData();

    datos.append("activarIdEstadoIncidencia", idEstadoIncidencia);
    datos.append("activarEstadoIncidencia", estadoIncidencia);

    $.ajax({

        url : "ajax/incidencias_admin.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

        

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "La Incidencia ha sido actualizada",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "incidencias_admin";
                    }
                });

            }
            

        }

    })

    if(estadoIncidencia ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("Pendiente");
        $(this).attr("estadoIncidencia", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Realizada");
        $(this).attr("estadoIncidencia", 0);

    }

})









