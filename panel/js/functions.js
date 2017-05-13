function onLoadFunctions() {
    var timer = 2;
    $('#timer').html(timer);
    setInterval(function() {
        if(timer > 0) {
            $('#timer').html(--timer);
        }
        else {
            $(".myalert").hide("slow");
        }
    }, 1000);
}

function generatePassword() {
    $('#password_input').val('haslo123');
}

function insertUrl(){
    var data = $('#opis').val();
    var url = prompt("Wklej link");
    var tag = prompt("Opis");
    var a = '<a href="' + url + '">' + tag + '<a/>';
    $('#opis').val(data + "\n" + a);
}


function validateForm() {
    var name = $("#name").val();
    var surname = $("#surname").val();
    var email = $("#email").val();
    var brand_name = $("#brand_name").val();

    if(name){
        if(name.length <3) {
            $( "#validateRequest" ).append( "Zbyt krótkie imie!" );
            return false;
        }
    }
    if(surname){
        if(surname.length <3) {
            $( "#validateRequest" ).append( "Zbyt krótkie nazwisko!" );
            return false;
        }
    }
    if(email){
        if(email.length <3) {
            $( "#validateRequest" ).append( "Zbyt krótki email!" );
            return false;
        }
        if(!email.indexOf("@")){
            $( "#validateRequest" ).append( "Błędny adres mail!" );
            return false;
        }
    }
    return true;
}
