<?php require_once('conexion.php'); $conexion=conectarDB();?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Incidentes de Movimientos Telúricos en Chile</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        
    </head>
    <body class="bg-light">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
            <div class="page-alerts">
                    <div class="alert alert-danger page-alert" style="display:none" id="alert-1">
                        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>:( !</strong> Debes marcar 2 opciones como minimo.
                    </div>
            </div>
            <div class="page-alerts">
                    <div class="alert alert-warning page-alert" style="display:none" id="alert-2">
                        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>:( !</strong> Alias ya ingresado, intenta con otro.
                    </div>
            </div>
            <div class="page-alerts">
                    <div class="alert alert-warning page-alert" style="display:none" id="alert-3">
                        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>:( !</strong> Rut ya ingresado, quizás ya votaste.
                    </div>
            </div>
            <div class="page-alerts">
                    <div class="alert alert-success page-alert" style="display:none" id="alert-4">
                        <button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>:) !</strong> Voto ingresado correctamente, esperemos que tu candidato gane.
                    </div>
            </div>
            <div class="py-5 text-center">
                <h5>Formulario de Votación</h5>
            </div>
            <div>
                <div class="elem-demo col-md-12 order-md-1">
                </div>
            </div>
            <div class="form-row-sm">
                <div class="col-md-12">
                    <div class="row justify-content-md-center">
                        <form id="form_incidencia" class="needs-validation" validate>
                            <div class="col-md-12 mb-5">

                                <div class="form-group-sm">
                                    <label for="nombreyapellido">Nombre y Apellido</label>
                                    <input class="form-control" type="text" id="nombreyapellido" name="nombreyapellido" placeholder="Nombre y Apellido" required>
                                </div>

                                <div class="form-group-sm">
                                    <label for="alias">Alias</label>
                                    <!--<input class="form-control" type="text" id="alias" name="alias" placeholder="Alias" required minlength=5 pattern="^[0-9a-zA-Z]+$">-->
                                    <input class="form-control" type="text" id="alias" name="alias" placeholder="Alias" required minlength=5 pattern="(?=.*\d)(?=.*[a-zA-Z])(?=.*[0-9]).{5,}">
                                </div>

                                <div class="form-group-sm">
                                    <label for="rut">RUT</label>
                                    <input class="form-control" type="text" id="rut" name="rut" oninput="checkRut(this)" placeholder="" required>
                                </div>

                                <div class="form-group-sm">
                                    <label for="mail">Email</label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="" required>
                                </div>

                                <!--                                    Combobox Region                                                -->
                                <div class="form-group-sm">
                                    <label for="region">Region</label>
                                    <select class="form-control" id="region" name="region" required onchange="cargacomuna()">
                                    </select>
                                </div>
                                <div class="form-group-sm">
                                    <label for="comuna">Comuna</label>
                                    <select class="form-control" id="comuna" name="comuna" required >
                                    <option value="" disabled selected>Selecciona una Comuna </option>
                                    </select>
                                </div>
                                <!--                        Fin de Combobox Regiones                                        --> 
                                <!--                        Combobox Candidatos                                             --> 
                                <div class="form-group-sm">
                                    <label for="candidatos">Candidatos</label>
                                    <select class="form-control" id="candidatos" name="candidatos" required >
                                        <option value="" disabled selected>Selecciona un Candidato</option>
                                        <option value="Candidato 1">Candidato 1</option>
                                        <option value="Candidato 2">Candidato 2</option>
                                    </select>
                                </div>
                                <!--                        Fin Combobox Candidatos                                         --> 

                                <!--                        Opciones del Checkbox                                           -->
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="inlineCheckbox1" value="Web">
                                        <label class="form-check-label" for="inlineCheckbox1">Web</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="inlineCheckbox2" value="TV">
                                        <label class="form-check-label" for="inlineCheckbox2">TV</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="inlineCheckbox3" value="Redes Sociales">
                                        <label class="form-check-label" for="inlineCheckbox2">Redes Sociales</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="inlineCheckbox4" value="Amigo">
                                        <label class="form-check-label" for="inlineCheckbox2">Amigo</label>
                                    </div>
                                </div>
                                <!--          Fin opciones del Checkbox                                              -->
                                
                                <input type="submit" id="form" name="botonsub" class="btn btn-primary btn-lg btn-block"  value="Enviar">
                                <!-- onclick="CheckBoxCount();" -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="app.js"></script>                            

    </body>
    <style>
        .page-alerts {
            margin-bottom: 10px;
        }

        .page-alerts .page-alert {
            border-radius: 0;
            margin-bottom: 0;
        }
    </style>

</html>
