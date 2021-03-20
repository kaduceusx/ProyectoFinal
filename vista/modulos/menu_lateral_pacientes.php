<aside class="main-sidebar">

    <section class="sidebar"> 
        
    <!-- style="margin-top:50px" -->
        <ul class="sidebar-menu" >


            <li>
                
                <a href="inicio">

                    <i class="fa fa-home"></i>

                    <span>Inicio</span>

                </a>
            </li>

            <?php
                if($_SESSION["perfil"] == "Administrativo"){

                    echo '<li>
                        <a href="pacientes">
        
                            <i class="fa fa-user"></i>
        
                            <span>Pacientes</span>
        
                        </a>
                    </li>';


                   

                }else if($_SESSION["perfil"] == "Medico"){

                    echo '<li>
                        <a href="pacientes_medico">
        
                            <i class="fa fa-user"></i>
        
                            <span>Pacientes</span>
        
                        </a>
                    </li>';

                }else if($_SESSION["perfil"] == "Psicologo"){

                    echo '<li>
                        <a href="pacientes_psicologo">
        
                            <i class="fa fa-user"></i>
        
                            <span>Pacientes</span>
        
                        </a>
                    </li>';

                }else if($_SESSION["perfil"] == "Enfermero"){

                    echo '<li>
                        <a href="pacientes_enfermero">
        
                            <i class="fa fa-user"></i>
        
                            <span>Pacientes</span>
        
                        </a>
                    </li>';

                }else if($_SESSION["perfil"] == "Auxiliar"){

                    echo '<li>
                        <a href="pacientes_auxiliar">
        
                            <i class="fa fa-user"></i>
        
                            <span>Pacientes</span>
        
                        </a>
                    </li>';

                }

            ?>

           


            <li>
                <a href="calendario">

                    <i class="fa fa-calendar"></i>

                    <span>Calendario</span>

                </a>
            </li>


            <li>
                <a href="incidencias">

                    <i class="fa fa-warning"></i>

                    <span>Incidencia</span>

                </a>
            </li>

            
        </ul>
    </section>



</aside>