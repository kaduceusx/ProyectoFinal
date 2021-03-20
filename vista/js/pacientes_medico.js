
/* -------------------------------------------------------------------------- */
/*                               ACTIVAR PACIENTE                              */
/* -------------------------------------------------------------------------- */
//$(".btnActivar").click(function (){ si se deja la clase asi, se dibuja antes del dom por eso hay que hacerlo al cargar el documento. 
$(document).on("click" , ".btnActivar_ingreso", function (){


    var idIngreso = $(this).attr("idIngreso");
    var estadoIngreso = $(this).attr("estadoIngreso");

    var datos = new FormData();

    datos.append("activarId", idIngreso);
    datos.append("activarIngreso", estadoIngreso);

    $.ajax({

        url : "ajax/pacientes_medico.ajax.php",
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

                        window.location = "pacientes_medico";
                    }
                });

            }
            

        }

    })

    if(estadoIngreso ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("No Ingresado");
        $(this).attr("estadoIngreso", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Ingresado");
        $(this).attr("estadoIngreso", 0);

    }

})






