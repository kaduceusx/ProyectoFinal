
/* -------------------------------------------------------------------------- */
/*                               ACTIVAR ESCALA BARTHEL                         */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btnActivarEscala_barthel", function (){


    var idEscala_barthel = $(this).attr("idEscala_barthel");
    var estadoEscala_barthel = $(this).attr("estadoEscala_barthel");

    var datos = new FormData();

    datos.append("activarIdEscala_barthel", idEscala_barthel);
    datos.append("activarEscala_barthel", estadoEscala_barthel);

    $.ajax({

        url : "ajax/pacientes_psicologo.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

        

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "La Escala_barthel ha sido actualizada",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "pacientes_psicologo";
                    }
                });

            }
            

        }

    })

    if(estadoEscala_barthel ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("No Hecho");
        $(this).attr("estadoEscala_barthel", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Hecho");
        $(this).attr("estadoEscala_barthel", 0);

    }

})




/* -------------------------------------------------------------------------- */
/*                       ACTIVAR INDICE LAWTON Y BRODY                        */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btnActivarIndice_lawton_brody", function (){


    var idIndice_lawton_brody = $(this).attr("idIndice_lawton_brody");
    var estadoIndice_lawton_brody = $(this).attr("estadoIndice_lawton_brody");

    var datos = new FormData();

    datos.append("activarIdIndice_lawton_brody", idIndice_lawton_brody);
    datos.append("activarIndice_lawton_brody", estadoIndice_lawton_brody);

    $.ajax({

        url : "ajax/pacientes_psicologo.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

        

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "El Indice_lawton_brody ha sido actualizado",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "pacientes_psicologo";
                    }
                });

            }
            

        }

    })

 

    if(estadoIndice_lawton_brody ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("No Hecho");
        $(this).attr("estadoIndice_lawton_brody", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Hecho");
        $(this).attr("estadoIndice_lawton_brody", 0);

    }

})


/* -------------------------------------------------------------------------- */
/*                       ACTIVAR TEST RELOJ SHULMAN                           */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btnActivarTest_reloj_shulman", function (){


    var idTest_reloj_shulman = $(this).attr("idTest_reloj_shulman");
    var estadoTest_reloj_shulman = $(this).attr("estadoTest_reloj_shulman");

    var datos = new FormData();

    datos.append("activarIdTest_reloj_shulman", idTest_reloj_shulman);
    datos.append("activarTest_reloj_shulman", estadoTest_reloj_shulman);

    $.ajax({

        url : "ajax/pacientes_psicologo.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

        

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "El Test_reloj_shulman ha sido actualizado",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "pacientes_psicologo";
                    }
                });

            }
            

        }

    })

 

    if(estadoTest_reloj_shulman ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("No Hecho");
        $(this).attr("estadoTest_reloj_shulman", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Hecho");
        $(this).attr("estadoTest_reloj_shulman", 0);

    }

})




/* -------------------------------------------------------------------------- */
/*                       ACTIVAR ESCALA DEPRESION YESAVAGE                    */
/* -------------------------------------------------------------------------- */

$(document).on("click" , ".btnActivarEscala_depresion_yesavage", function (){


    var idEscala_depresion_yesavage = $(this).attr("idEscala_depresion_yesavage");
    var estadoEscala_depresion_yesavage = $(this).attr("estadoEscala_depresion_yesavage");

    var datos = new FormData();

    datos.append("activarIdEscala_depresion_yesavage", idEscala_depresion_yesavage);
    datos.append("activarEscala_depresion_yesavage", estadoEscala_depresion_yesavage);

    $.ajax({

        url : "ajax/pacientes_psicologo.ajax.php",
        method : "POST",
        data : datos,
        cache : false,
        contentType : false,
        processData : false,
        success: function(respuesta){

        

            if(
            window.matchMedia("(max-width:1165px)").matches)  {

                swal({

                    title: "La Escala De Depresion De Yesavage ha sido actualizada",
                    type: "success",
                    confirmButtonText: "Cerrar"

                }).then(function (result){

                    if(result.value){

                        window.location = "pacientes_psicologo";
                    }
                });

            }
            

        }

    })

 

    if(estadoEscala_depresion_yesavage ==0){

        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger ");
        $(this).html("No Hecho");
        $(this).attr("estadoEscala_depresion_yesavage", 1);

    }else{

        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger ");
        $(this).html("Hecho");
        $(this).attr("estadoEscala_depresion_yesavage", 0);

    }

})






