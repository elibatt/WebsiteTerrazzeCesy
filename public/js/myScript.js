$(document).ready(function(){
   
    
    var idUtente= $("#profiloNav").attr('value');
   if ($(document).width() <= 1000) {
        $("#logoutNav").show();
        $("#profiloNav").attr('class','nav-item');
        $("#profiloNav a").attr('href',"/anagrafica/"+idUtente);
        $("#frecciaBassa").hide();
        $("#ordiniNav").show();
        $("#profiloDropdown").hide();
        $("#logoutDropdown").hide();
        $("#ordiniDropdown").hide();
    }else{
        $("#logoutNav").hide();
        $("#ordiniNav").hide();
        $("#profiloNav").attr('class','dropdown');
        $("#profiloNav a").attr('href',"#");
        $("#profiloDropdown").show();
        $("#frecciaBassa").show();
        $("#logoutDropdown").show();
        $("#ordiniDropdown").show();
        $("#profiloDropdown").attr('href',"/anagrafica/"+idUtente);
        $("#logoutDropdown").attr('href',"/user/logout");
        $("#ordiniDropdown").attr('href',"/ordini");
    }

    
    $("#formRegistrazione").submit(function(){
        var password=$('#password').val();
        var conferma=$('#confirm-password').val();
        var email=$('#email').val();
        var cellulare=$('#cellulare').val();
        var username=$('#username').val();
        var esito=true;
        var lingua= "it";
        var arrMail = {
            "it": 'Formato email non valido!',
            "en": "Email format not valid",
            "es": "Non ci siamo senorita",
        };
        var arrPassword = {
            "it": 'La password deve contenere almeno 8 caratteri',
            "en": "The password must contain at least 8 characters",
            "es": "La password debe contener al menos 8 caracteres",
        };
      
        var arrConfermaPassword = {
            "it": '  Le due password non corrispondono',
            "en": "The two passwords do not match",
            "es": "Las dos password no coinciden",
        };

        var arrCellulare = {
            "it": '  Il numero di cellulare inserito non è valido',
            "en": "The cellphone number is not valid",
            "es": "El número de móvil ingresado no es válido",
        };
        var arrMailGiaPresente = {
            "it": '  Questo indirizzo mail è già stato precedentemente inserito',
            "en": "This email address has already been entered previously",
            "es": "Esta dirección de correo electrónico ya se ha introducido anteriormente",
        };

        var arrUsernameGiaPresente = {
            "it": '  Questo username è già stato precedentemente inserito',
            "en": "This username has already been entered previously",
            "es": "Esto username ya se ha introducido anteriormente",
        };

        $.ajaxSetup({async: false});
        $.post('http://localhost:8000/checkLanguage',
            {
                "email": email,
                "_token": $('input[name=_token]').val()
            },
            function(data){
                lingua=data;
            }
        );

        const regex_email = /^([\-\.0-9a-zA-Z]+)@([\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;

            if(!regex_email.test($("#email").val())){
                $("#messaggioEmailFormato").html(arrMail[lingua]).css('color', 'red');
                esito = false;
            }else{
                $("#messaggioEmailFormato").html('');
            }
            
            if(password.length<8){
             
                    $("#messageFormatoPw").html(arrPassword[lingua]).css('color', 'red');
                    esito=false;
            }else{
                $("#messageFormatoPw").html('');
            }

            if ( conferma!==password) {
                $('#messagePassword').html(arrConfermaPassword[lingua]).css('color', 'red'); 
                esito=false;
                
                
            } else{
                $("#messagePassword").html('');
            }
        
        
            if ( cellulare.length!=10 ) {
                $('#messageCellulare').html(arrCellulare[lingua]).css('color', 'red');
                esito=false;
         
            } else{
                $("#messageCellulare").html('');
            }
            
            //var base_url = window.location.origin;
            var base_url = "http://localhost:8000";
            
            $.ajaxSetup({async: false});
            $.post(base_url+'/verificaEmail',
                {
                    "email": email,
                    "_token": $('input[name=_token]').val()
                },
                function(data){
                    if(data > 0){
                        $('#messageEmail').html(arrMailGiaPresente[lingua]).css('color', 'red');
                        esito = false;
                        
                    }else{
                        $('#messageEmail').html('');
                    }
                }
            );
           

            $.ajaxSetup({async: false});
            $.post(base_url+'/verificaUsername',
                {
                    "username": username,
                    "_token": $('input[name=_token]').val()
                },
                function(data){
                    if(data > 0){
                        $('#messageUsername').html(arrUsernameGiaPresente[lingua]).css('color', 'red');
                        esito = false;
                        
                    }else{
                            $("#messageUsername").html('');
                        
                    }
                }
            );

            return esito;
    
    });
    $("#formCreazione").submit(function(){
        var prezzo=$("#prezzo").val();
        //alert(prezzo);
        var risultato=true;
        if(!$.isNumeric(prezzo)){
            risultato=false;
            $("#messagePrezzo").html('Attenzione, inserire valore numerico').css('color','red');
        }
        return risultato;
        
    });
    $("#formEdit").submit(function(){
        var prezzo=$("#prezzo").val();
        //alert(prezzo);
        var risultato=true;
        if(!$.isNumeric(prezzo)){
            risultato=false;
            $("#messagePrezzo").html('Attenzione, inserire valore numerico').css('color','red');
        }
        return risultato;
        
    });
    $("#bottoneCarrello").click(function(){
        var base_url = window.location.origin;
        var idProdotto=$("#bottoneCarrello").attr("value");
        var quantitaProdotto= $("#scegliQuantita").val();
        
       
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.post(base_url+'/aggiungiCarrello',
            {
                "idProdotto":idProdotto,
                "quantitaProdotto":quantitaProdotto,
            },
            function(data){
                $("#messageBottone").html(data);
         
            }
        );
        
    });
    $(".quantity-box-singola").click(function(){
        settaQuantita();
        
       

    });
    $('.quantity-box-singola').change(function() {
        settaQuantita(); 
     });
   
     $("#bottoneCodiceSconto").click(function(){

        var id_utente = $(this).attr("data-utente");
        var testo_codice_sconto = $("#inputCodiceSconto").val()

        $.ajaxSetup({async: false});
        $.post('http://localhost:8000/verificaCodiceSconto',
            {
                "id_utente": id_utente,
                "testo_codice_sconto": testo_codice_sconto,
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            function(data){
                if(data['esito']){
                    $("#sconto").html(data['percentuale_sconto']+" %");
                    $("#erroreCodiceSconto").html(data['messaggio']).css('color','green');
                    cambiaTotale();
                    $("#codiceScontoHidden").val(data['percentuale_sconto']+"%");
                }else{
                    $("#erroreCodiceSconto").html(data['messaggio']).css('color','red');
                }
            }
        );
    });

    $(".buttonRemove").click(function(){
        //cambio riga
        var base_url = window.location.origin;
        var idcompleto=$(this).attr("id");
        var myArray = idcompleto.split("_");
        var idsingolo=myArray[1];
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        $.post(base_url+'/rimuoviDaCarrello',
            {
                "idsingolo":idsingolo,
            },
            function(data){
               //console.log(data);
               location.reload(true);
               
            }
        );



        
    });

    $(".buttonRemove").hover(function(){
        $(this).css('cursor','pointer');
    }, function(){
        $(this).css('cursor','auto');
    });


    $("#inputProdotto").on("keyup",function(){
        $("#listaRicerca").show();
        var value = $(this).val().toLowerCase();
        //console.log(value);
        $(".doveCercare li").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });

    });
    
    $("#inputOrdine").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#passwordCambiata").keyup(function(){
        var lingua= "it";
        var arrPassword = {
            "it": 'La password deve contenere almeno 8 caratteri',
            "en": "The password must contain at least 8 characters",
            "es": "La password debe contener al menos 8 caracteres",
        };
        var giustaPassword = {
            "it": 'Perfetto!',
            "en": "Perfect!",
            "es": "Perfecto!",
        };
        var booleano=true;
        var passwordCambiata=$('#passwordCambiata').val();
        $.ajaxSetup({async: false});
        $.post('http://localhost:8000/checkLanguage',
            {
                "lingua": lingua,
                "_token": $('input[name=_token]').val()
            },
            function(data){
                lingua=data;
            }
        );
        if(passwordCambiata.length<8){
            $('#messagePasswordNuova').html(arrPassword[lingua]).css('color', 'red'); 
            booleano=false;
        }
        else{
            $('#messagePasswordNuova').html(giustaPassword[lingua]).css('color', 'green'); 
        }
        return booleano;
    });
  /*  $("#tastoReset").click(function(){
        $("#inputProdotto").val('');
        $("#tuttiProdotti").addClass("active");
        $("#tastoCosmesi").removeClass("active");
        $("#tastoUsoAlimentare").removeClass("active");

    });
    $("#provaCoupon").click(function(){
        $("#myModal").css("display","block");
    });*/
    $(".closePop").click(function(){
        $("#myModal").css("display","none");
    });
    $(document).click(function(event){
     
        if (event.target.id == "myModal") {
            $("#myModal").css("display","none");
          }
    });
   $("#bottoneCambioPw").click(function(){
        var lingua= "it";
        var passwordCambiata=$('#passwordCambiata').val();
        var confermaCambiata=$('#confermaPasswordCambiata').val();
        var esitoCambio=true;

        var arrPassword = {
            "it": 'La password deve contenere almeno 8 caratteri',
            "en": "The password must contain at least 8 characters",
            "es": "La password debe contener al menos 8 caracteres",
        };
      
        var arrConfermaPassword = {
            "it": '  Le due password non corrispondono',
            "en": "The two passwords do not match",
            "es": "Las dos password no coinciden",
        };
        var arrFeedbackPassword = {
            "it": '  La password è stata cambiata correttamente. Clicca OK',
            "en": "Password has been changed succesfully. Click OK",
            "es": "La contraseña ha sido cambiada con éxito. Haga clic OK",

        };

        $.ajaxSetup({async: false});
        $.post('http://localhost:8000/checkLanguage',
            {
                "lingua": lingua,
                "_token": $('input[name=_token]').val()
            },
            function(data){
                lingua=data;
            }
        );
        
        if ( confermaCambiata!==passwordCambiata) {
            $('#messagePasswordCambiata').html(arrConfermaPassword[lingua]).css('color', 'red'); 
            esitoCambio=false;
            
            
        }
        else if (passwordCambiata.length<8) {
            $('#messagePasswordCambiata').html(arrPassword[lingua]).css('color', 'red'); 
            esitoCambio=false;
            
        } 
        else {
            $('#messagePasswordCambiata').html('');
            var testo= arrFeedbackPassword[lingua];
           alert(testo);

        }
        return esitoCambio;

   });
  
   $("#tabellaSorting").tablesorter({dateFormat: "ddmmyyyy"});
   $("#tabellaSortingCliente").tablesorter({dateFormat: "ddmmyyyy"});




    cambiaTotale();
    settaQuantita();

 
   
});
    $(window).on('load', function () {
        $('#loading').hide();
        $('.image').show();
    });
    
    $(window).on('resize', function(){
        var idUtente= $("#profiloNav").attr('value');
       if ($(document).width() <= 1000) {
        $("#logoutNav").show();
        $("#profiloNav").attr('class','nav-item');
        $("#profiloNav a").attr('href',"/anagrafica/"+idUtente);
        $("#frecciaBassa").hide();
        $("#ordiniNav").show();
        $("#profiloDropdown").hide();
        $("#logoutDropdown").hide();
        $("#ordiniDropdown").hide();
    }else{
        $("#logoutNav").hide();
        $("#ordiniNav").hide();
        $("#profiloNav").attr('class','dropdown');
        $("#profiloNav a").attr('href',"#");
        $("#profiloDropdown").show();
        $("#frecciaBassa").show();
        $("#logoutDropdown").show();
        $("#ordiniDropdown").show();
        $("#profiloDropdown").attr('href',"/anagrafica/"+idUtente);
        $("#logoutDropdown").attr('href',"/user/logout");
        $("#ordiniDropdown").attr('href',"/ordini");
    }

    });

 function cambiaTotale(){
    var somma = getTotale();
    var totale=calcolaSconto(somma);
     $("#totaleCarrello").html(totale.toFixed(2)+" €");
     $("#totaleHidden").val(totale.toFixed(2));
}
function getTotale(){
    var tuttiTotali=$(".singolototale").text();
     var arrayTuttiTotali=tuttiTotali.split(" €");
     var i;
     var somma=0;
     for (i = 0; i < arrayTuttiTotali.length-1; ++i) {
         arrayTuttiTotali[i]=parseFloat(arrayTuttiTotali[i]);
         somma=somma+arrayTuttiTotali[i];
     }
     return somma;
}

function calcolaSconto(somma){
 if($("#sconto").text() != ""){
    var arraysconto=$("#sconto").text().split(" %");
    var sconto=arraysconto[0];
    var scontoInt=parseInt(sconto);
    somma=somma-(scontoInt/100*somma);
    return somma;
 }else{
    return somma;
 }


}

function settaQuantita(){

    var lingua="it";
    var arrQuantitaMinima = {
        "it": '  La quantità minima richiesta è 1.',
        "en": "The minimum quantity required is 1.",
        "es": "La cantidad mínima requerida es 1.",
    };
    var arrQuantitaMassima = {
        "it": '  La quantità massima richiesta è 10.',
        "en": "The maximum quantity required is 10.",
        "es": "La cantidad maxima requerida es 10.",
    };

    $.ajaxSetup({async: false});
    $.post('http://localhost:8000/checkLanguage',
        {
            "lingua": lingua,
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        function(data){
            lingua=data;
        }
    );




    //cambio riga del carrello
    $(".quantity-box-singola").each(function(){
   var idcompleto=$(this).attr("id");
   

    var myArray = idcompleto.split("_");
    var idsingolo=myArray[1];
    var prezzocompleto = $("#prezzo_"+idsingolo).text();
    var newArray=prezzocompleto.split(" ");
    var prezzo=newArray[0];
    //alert(prezzo);
    var quantita=$("#quantity_"+idsingolo).val();
    //alert(quantita);
    quantitaConvertita=parseInt(quantita);
    prezzoConvertito=parseFloat(prezzo);
    
    if (quantitaConvertita < 1 || isNaN(quantitaConvertita)){
       $("#erroreCarrello").html(arrQuantitaMinima[lingua]).css("color","red");
       
       quantitaConvertita=1;
       $("#quantity_"+idsingolo).val("1");
       $("#quantity_"+idsingolo).css("color","red");
    }

   else if(quantitaConvertita > 10){
       $("#erroreCarrello").html(arrQuantitaMassima[lingua]).css("color","red");
       quantitaConvertita=10;
       $("#quantity_"+idsingolo).val("10");
       $("#quantity_"+idsingolo).css("color","red");
    }else{
       $("#erroreCarrello").html("");
       $("#quantity_"+idsingolo).css("color","black");
    }
    
    var totaleRiga= quantitaConvertita*prezzoConvertito;
    //alert(totale);
    $("#total_"+idsingolo).html(totaleRiga.toFixed(2)+" €");

    var base_url = window.location.origin;
    //ajax per cambiare quantità: quantitaConvertita, idsingolo --> troverò chiave con quell'id e setterò
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $.post(base_url+'/modificaCarrello',
        {
            "idsingolo":idsingolo,
            "nuovaquantita":quantitaConvertita,
        },
        function(data){
           console.log(data);
           //location.reload(true);
           
        }
    );
    cambiaTotale();

    });
    
}






