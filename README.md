$(document).ready(function(){
cargaregion();

document.getElementById('form_incidencia')
    .addEventListener('submit',function(e){
        e.preventDefault();
        let nombreyapellido = document.getElementById('nombreyapellido').value;
        let alias = document.getElementById('alias').value;
        let rut = document.getElementById('rut').value;
        let email = document.getElementById('email').value;
        let region = document.getElementById('region').value;
        let comuna = document.getElementById('comuna').value;
        let candidatos = document.getElementById('candidatos').value;

        if(CheckBoxCount() == true)
        {
            var check = document.forms[0];
            var txt = "";
            var i;
            for (i = 0; i < check.length; i++) {
                if (check[i].checked) {
                txt = txt + check[i].value + " ";
                }
            }
            let checkbox = txt;
            $.ajax({
                url:    'insertardatos.php',
                type:   'POST',
                data: {nombreyapellido,
                        alias,
                        rut,
                        email,
                        region,
                        comuna,
                        candidatos,
                        checkbox
                },
                success:function(response){
                    //console.log(response);
                    if(response==2)
                    {
                        alertas(2,5000);
                    }
                    if(response==3)
                    {
                        alertas(3,5000);
                    }
                    if(response==4)
                    {
                        alertas(4,5000);
                        document.getElementById("form_incidencia").reset(); 
                    }
                }
    
    
            });
        }
    });
   
});

    function cargaregion(){
        $.ajax({
            url:    'cargadatos.php',
            type:   'GET',
            contentType: "charset=utf-8", 
            success:function(response){
                let respuesta = JSON.parse(response);
                let template = `<option value="" disabled selected>Selecciona una Región </option>`;
                respuesta.forEach(respuesta => {
                    template += `
                    <option value="${respuesta.cod_region}" >${respuesta.nombre_region}</option> 
                    `
                    
                });
                $('#region').html(template);
            }


        });
    }


    function cargacomuna(){
    $cod_region = document.getElementById("region").value;
    //console.log($comuna);
        $.ajax({
            url:    'cargadatos2.php',
            type:   'GET',
            contentType: "charset=utf-8",
            data: {cod_region : $cod_region},
            success:function(response){
                let respuesta = JSON.parse(response);
                let template = `<option value="" disabled selected>Selecciona una Comuna </option>`;
                respuesta.forEach(respuesta => {
                    template += `
                    <option value="${respuesta.cod_comuna}" >${respuesta.nombre_comuna}</option> 
                    `
                    
                });
                $('#comuna').html(template);
            }


        });
    }

    function CheckBoxCount() {
        var inputList = document.getElementsByClassName("form-check-input");
        var numChecked = 0;

        for (var i = 0; i < inputList.length; i++) {
            if (inputList[i].type == "checkbox" && inputList[i].checked) {
                numChecked = numChecked + 1;
            }
        }
        if (numChecked < 2) {
            alertas(1,5000);
            return false;
        }
        else return true;
    }

    function alertas(id,delay){

        var alert = $('#alert-' + id);
        var timeOut;
        alert.appendTo('.page-alerts');
        alert.slideDown();
        //Autocerrado de Alerta
        var delay = delay;
        if(delay != undefined)
        {
            delay = parseInt(delay);
            clearTimeout(timeOut);
            timeOut = window.setTimeout(function() {
                    alert.slideUp();
                }, delay);
        }
        //Cerrando Alerta Manual
        $('.page-alert .close').click(function(e) {
            e.preventDefault();
            $(this).closest('.page-alert').slideUp();
        });
    }



    function checkRut(rut) {
        // Despejar Puntos
        var valor = rut.value.replace('.','');
        // Despejar Guión
        valor = valor.replace('-','');
        
        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor.slice(0,-1);
        dv = valor.slice(-1).toUpperCase();
        
        // Formatear RUN
        rut.value = cuerpo + '-'+ dv
        
        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
        if(cuerpo.length > 9) { rut.setCustomValidity("RUT No Existe"); return false;}
        
        // Calcular Dígito Verificador
        suma = 0;
        multiplo = 2;
        
        // Para cada dígito del Cuerpo
        for(i=1;i<=cuerpo.length;i++) {
        
            // Obtener su Producto con el Múltiplo Correspondiente
            index = multiplo * valor.charAt(cuerpo.length - i);
            
            // Sumar al Contador General
            suma = suma + index;
            
            // Consolidar Múltiplo dentro del rango [2,7]
            if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

        }
        
        // Calcular Dígito Verificador en base al Módulo 11
        dvEsperado = 11 - (suma % 11);
        
        // Casos Especiales (0 y K)
        dv = (dv == 'K')?10:dv;
        dv = (dv == 0)?11:dv;
        
        // Validar que el Cuerpo coincide con su Dígito Verificador
        if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
        
        // Si todo sale bien, eliminar errores (decretar que es válido)
        rut.setCustomValidity('');
    }
