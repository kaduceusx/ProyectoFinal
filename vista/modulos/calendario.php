<?php
//session_start();
?>
<script>

    $(document).ready(function () {

        $("#calendarioWeb").fullCalendar({

            header:{

                left: "today,prev,next",
                center:"title",
                right:"month,basicWeek,basicDay, agendaWeek,agendaDay"

            },

            /*customButtons:{

                miBoton:{
                    text:"Boton 1",
                    click: function(){

                        alert("accion del boton");

                    }
                }
            },*/

            dayClick: function(date, jsEvent, view){

                //alert("valor seleccionado: " + date.format()); //fecha Y-m-d

                //alert("vista actual: " + view.name); //month

            // $(this).css("background-color", "red");



                $("#btnAgregar").prop("disabled", false);
                $("#btnModificar").prop("disabled", true);
                $("#btnBorrar").prop("disabled", true);

                limpiarFormulario();

                $("#txtFecha").val(date.format());

                $("#modalEventos").modal(); //muestra el modal sin necesidad de boton.
            },



            /*events:[

                {

                    id: 1,
                    title: "Evento 1, llegamos a los 1000subcriptores",
                    descripcion: "descirpcion del evento 1....",
                    start: "2020-09-01",
                    color: "#FF0F0",
                    textColor: "#FFF"

                },

                {

                    id: 2,
                    title: "Evento 2, llegamos a 1001 subcriptores",
                    descripcion: "descripcion del evento 2....",
                    start: "2020-09-07",
                    end: "2020-09-09"

                },


                {

                    id: 3,
                    title: "Evento 3, saludos",
                    descripcion: "descripcion del evento 3....",
                    start: "2020-09-11T12:30:00",
                    allDay: false,
                    color: "black",
                    textColor: "pink"
                }

            ],*/

            events: "http://fesergry.ddns.net/Proyecto_final/modelo/conexion_eventos.modelo.php",
            
            //events: "https://geriatrysalut.com/Proyecto_final/modelo/conexion_eventos.modelo.php",

            eventClick:function (calEvent, jsEvent, view){



                $("#btnAgregar").prop("disabled", true);
                $("#btnModificar").prop("disabled", false);
                $("#btnBorrar").prop("disabled", false);

                //H4
                $("#tituloEvento").html(calEvent.title);//calEvent obtiene informacio d title

                //Mostrar info del event en los inputs
                $("#txtDescripcion").val(calEvent.descripcion);
                $("#txtId").val(calEvent.id);
                $("#txtTitulo").val(calEvent.title);
                $("#txtColor").val(calEvent.color);

                fechaHora = calEvent.start._i.split(" ");
                $("#txtFecha").val(fechaHora[0]);
                $("#txtHora").val(fechaHora[1]);

                $("#txtNombre").val(calEvent.nombre_usuario);
                $("#txtPerfil").val(calEvent.perfil_usuario);

                $("#modalEventos").modal();

            },

            editable: true,
            eventDrop: function(calEvent){

                $("#txtId").val(calEvent.id);
                $("#txtTitulo").val(calEvent.title);
                $("#txtColor").val(calEvent.color);
                $("#txtDescripcion").val(calEvent.descripcion);

                var fecha_Hora = calEvent.start.format().split("T");
                $("#txtFecha").val(fecha_Hora[0]);
                $("#txtHora").val(fecha_Hora[1]);

                $("#txtNombre").val(calEvent.nombre_usuario);
                $("#txtPerfil").val(calEvent.perfil_usuario);

                recolectarDatos_GUI();
                enviarInformacion("modificar", nuevoEvento, true);



            }

        });


    });

</script>


<style>

    .fc th{
        padding:10px 0px;
        vertical-align: middle;
        background: #04163e;
        color: white;
    }

</style>







<div class="content-wrapper" >

    <section class="content-header">

        <h1>Agenda/Calendario</h1>

    </section>


    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarUsuario">boton prueba</button> -->

            </div>


            <div class="box-body">

                <div id='calendarioWeb'></div>

            </div>

        </div>

    </section>







    <!-- Modal para agredar, modificar y eliminar eventos -->
    <!-- Para que el modal no se pueda dar click fuera de él o pulsando la letra esc, se han usado lso atributos data-backdrop y data-keyboard -->
    <div class="modal fade" id="modalEventos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ejemploEventosLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <strong><h4 class="modal-title" id="tituloEvento"></h4></strong>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- Este span es la X de cierre -->
                    <!-- <span aria-hidden="true">&times;</span> -->
                    </button>

                </div>


                <div class="modal-body" id="modal4">

                    <label for="txtId"></label>
                    <input type="hidden" id="txtId" name="txtId">

                    <label for="txtFecha"></label>
                    <input type="hidden" id="txtFecha" name="txtFecha" />

                    <div class="form-row">

                        <div class="form-group col-md-8">

                            <label for="txtNombre">Nombre: </label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION['nombre']; ?>" id="txtNombre" readonly >

                        </div>

                    </div>



                        <div class="form-group col-md-4">

                            <label for="txtPerfil">Perfil: </label>
                            <input class="form-control" type="text" value="<?php echo $_SESSION['perfil']; ?>" id="txtPerfil" readonly >

                        </div>




                        <div class="form-group col-md-8">

                            <label for="txtTitulo">Título:</label>
                            <input class="form-control" type="text" id="txtTitulo" placeholder="Título del evento">

                        </div>

                        <div class="form-group col-md-4">

                            <label for="txtHora">Hora del evento:</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input class="form-control" type="text" id="txtHora" value="10:30">
                            </div>

                        </div>



                    <div class="form-group col-md-12">

                        <label for="txtDescripcion">Descripción:</label>
                        <textarea class="form-control" id="txtDescripcion" rows="3"></textarea>

                    </div>


                    <div class="form-group col-md-12">

                        <label for="txtColor">Color:</label>
                        <input class="form-control" type="color" id="txtColor" value="#ff0000" style="height:36px">

                    </div>




                </div>




            <div class="modal-footer">

                        <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>

                        <button type="button" id="btnModificar" class="btn btn-warning">Modificar</button>

                        <button type="button" id="btnBorrar" class="btn btn-danger">Borrar</button>

                        <button type="button" id="btnCancelar" class="btn btn-default" data-dismiss="modal">Cancelar</button>



               </div>



            </div>

        </div>

    </div>

    <script>

        var nuevoEvento;

        $("#btnAgregar").click(function (){

            recolectarDatos_GUI();

            enviarInformacion("agregar", nuevoEvento);

            //$("#calendarioWeb").fullCalendar("renderEvent", nuevoEvento); //cambia full calendar
            //$("#modalEventos").modal("toggle"); //carga de nuevo full calendar

        });



        $("#btnBorrar").click(function (){

            recolectarDatos_GUI();

            enviarInformacion("eliminar", nuevoEvento);

        });


        $("#btnModificar").click(function (){

            recolectarDatos_GUI();

            enviarInformacion("modificar", nuevoEvento);

        });

        $("#btnCancelar").click(function (){

            location.reload();
        })


        //funcion que sirve para recoger los valores de los inputs
        function recolectarDatos_GUI (){

            nuevoEvento = {

                id: $("#txtId").val(),
                title: $("#txtTitulo").val(),
                start: $("#txtFecha").val() + " " + $("#txtHora").val(),
                color: $("#txtColor").val(),
                descripcion: $("#txtDescripcion").val(),
                textColor: "#FFF", //obligatorio en hexadecimal por el input type color
                end: $("#txtFecha").val() + " " + $("#txtHora").val(),
                nombre_usuario: $("#txtNombre").val(),
                perfil_usuario: $("#txtPerfil").val()
            };

        }


        function enviarInformacion (accion, objEvento, modal){

            $.ajax({

                type: "POST",
                url: "modelo/conexion_eventos.modelo.php?accion="+accion,
                data: objEvento,
                success: function (msg){

                    swal({

                            type: "info",
                            title: "Recordatorio",
                            text: "Recuerda que solo puedes borrar o editar tus propios eventos.",
                            confirmButtonText: "Cerrar",

                        }).then((result)=>{

                            if(result.value){

                                window.location = "calendario";
                            }

                        });
                    if(msg){

                        $("#calendarioWeb").fullCalendar("refetchEvents");

                        if(!modal){

                            $("#modalEventos").modal("toggle");

                        }

                    }
                },

                error: function (){


                    alert("Hay algun error..");


                }

            });

        }

        $(".clockpicker").clockpicker();

        function limpiarFormulario(){


            $("#tituloEvento").val("");
            //$("#txtNombre").val("");
            //$("#txtPerfil").val("");
            $("#txtId").val("");
            $("#txtTitulo").val("");
            $("#txtHora").val();
            $("#txtColor").val("");
            $("#txtDescripcion").val("");


        }

    </script>




</div>


