<?php
    session_start();
    error_reporting(0);
    
    if($_SESSION['tipo'] != 1){
        header("location: index.html");
    }
    $p_correocuenta = $_SESSION['p_correocuenta'];
    $p_clavecuenta = $_SESSION['p_clavecuenta'];
    $p_token = $_SESSION['token'];
    $codigo_ipress = $_SESSION['codigo_ipress'];

    if($p_correocuenta == null || $p_clavecuenta == '' || $p_token == '' || $p_token == null || $_SESSION['tipo'] == '' || $_SESSION['tipo'] == null){
        header("location: index.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador Ipress</title> 
    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../js/ipresspanel.js"></script>
    <link href="../css/panelweb.css" rel="stylesheet">
</head>
    <body>
                <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">Panel IPRESS</div>
                <div class="list-group list-group-flush">
                    <a href="PanelIpress.php" class="list-group-item list-group-item-action bg-light">Datos Generales</a>
                    <a href="PanelIpressEspMed.php" class="list-group-item list-group-item-action bg-light">Especialidades M&oacute;vil</a>
                    <a href="PanelIpressMedico.php" class="list-group-item list-group-item-action bg-light">M&eacute;dicos</a>
                    <a href="PanelIpressHorarios.php" class="list-group-item list-group-item-action bg-light">Horarios</a>
                    <a href="" class="list-group-item list-group-item-action bg-light">Reservas M&eacute;dicas</a>
                    <a href="" class="list-group-item list-group-item-action bg-light">Esta&iacute;sticas</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light-cab border-bottom" style="margin-bottom:10px">
                    <button class="btn btn-primary" id="menu-toggle">≡</button>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['p_correocuenta']; ?></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Mi Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../ws/web/sesion.cerrar.php">Cerrar Sesión</a>
                            </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <h4>Especialides brindades por aplicaci&oacute;n M&oacute;vil</h4> 
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-light">Unidades Prestadoras de Salud</p>
                            <div class="row">
                                <div class="col">
                                    <div id="vercomboups"></div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" id="agregarups" class="btn btn-success" onclick="agregartablaupss()">+</button>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            <div class="p-2">Tabla UPS</div>
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" onclick="registrarupsmovil()">Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="tablaups">
                                      <thead>
                                        <tr>
                                          <th>C&oacute;digo</th>
                                          <th>UPSS</th>
                                          <th>Borrar</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-center">
                                        <div class="p-2">Tabla UPS mostrados en dispositivos m&oacute;vil</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="tablamovil1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <footer class="mojFooter">
            <font face="Roboto Condensed"> 
                <div class="footer">
                    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Sistema Web</a>.</strong> Todos los derechos reservados.
                </div>
            </font> 
        </footer>
    
    <script>
		ipressupsmovil1listar();
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    
    </body>
</html>
