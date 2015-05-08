/**
 * @author Patrick Münster
 *
 * jQuery UI Test
 */

function login(email, password) {
    if(email == "patrick" && password == "123") {
        return true;
    }
    else if (email == "andy" && password == "123") {
        return true;
    }
    else {
        return false;
    }
}

$(function() {

    //#### Accordion for projects ####
    
    // deactivate accordion because of dynamic functions for adding elements.
    
    // $("#acc_projects-stackoverflow").accordion({
        // active : 0,
        // animate : {
            // duration : 400,
            // easing : "swing",
        // }
    // });

    // $("#acc_projects-github").accordion({
        // active : 0,
        // animate : {
            // duration : 400,
            // easing : "swing",
        // }
    // });

    //#### Buttons ####

    $("#btn_signout").click( function(event) {
        event.preventDefault();
        window.location = "http://127.0.0.1:8020/Bubbles/anonymous-landingpage.html";
    });

    // $("#btn_signin").click( function(event){
    // event.preventDefault();
    // console.log("Signin button pressed");
    // });

    myButton = document.getElementById("btn_signin");
    myButton.addEventListener("click", function(e) {
        console.log("Signin button pressed");
        console.log(e.shiftKey);
        $("#dialog_signin").dialog("open");
    });

    //#### Dialogbox for signin ####

    $("#dialog_signin").dialog({
        autoOpen : false,
        modal : true,
        resizeable : false,
        draggable : false,
        buttons : {
            "Login" : function() {
               
               

                var email = $("#email").val();
                var password = $("#password").val();
                // Checking for blank fields.
                if (email == '' || password == '') {
                    $('#email,input[type="password"]').css("border", "2px solid red");
                    $('#email,input[type="password"]').css("box-shadow", "0 0 3px red");
                    alert("Please fill all fields...!!!!!!");
                } else {
                    // login demo
                    if (login($("#email").val(), $("#password").val())) {
                        $(this).dialog("close");
                        console.log("Signed in!");
                        window.location = "http://127.0.0.1:8020/Bubbles/authentificated-landingpage.html";
                    } else {
                        console.log("invalid login");
                    }
                    
                    // $.post("login.php", {
                        // email1 : email,
                        // password1 : password
                    // }, function(data) {
                        // if (data == 'Invalid Email.......') {
                            // $('input[type="text"]').css({
                                // "border" : "2px solid red",
                                // "box-shadow" : "0 0 3px red"
                            // });
                            // $('input[type="password"]').css({
                                // "border" : "2px solid #00F5FF",
                                // "box-shadow" : "0 0 5px #00F5FF"
                            // });
                            // alert(data);
                        // } else if (data == 'Email or Password is wrong...!!!!') {
                            // $('input[type="text"],input[type="password"]').css({
                                // "border" : "2px solid red",
                                // "box-shadow" : "0 0 3px red"
                            // });
                            // alert(data);
                        // } else if (data == 'Successfully Logged in...') {
                            // $("form")[0].reset();
                            // $('input[type="text"],input[type="password"]').css({
                                // "border" : "2px solid #00F5FF",
                                // "box-shadow" : "0 0 5px #00F5FF"
                            // });
                            // alert(data);
                        // } else {
                            // alert(data);
                        // }
                    // });
                }

            }
        }
    });

    ////////////////////
    // JQUERY UI TEST //
    ////////////////////

    //#### Accordion ####

    $("#accordion").accordion({
        active : 0,
        animate : {
            duration : 400,
            down : {
                easing : "easeOutBounce",
                duration : 1000
            }
        }
    });
    $("#meinLink").click(function(e) {
        e.preventDefault();
        // set option of accordion
        $("#accordion").accordion("option", "active", 1);
        // read Option of accordion.
        console.log("Active option: " + $("#accordion").accordion("option", "active"));
    });

    //#### Tabs ####

    // option object
    var myTabOptions = {
        active : 2,
        collapsible : true
    };

    $("#tabs").tabs(myTabOptions);

    //#### DIALOG ####

    $("#myDialog").dialog({
        autoOpen : false,
        // modal background is dark and dialog in foreground
        modal : true,
        resizable : false,
        buttons : {
            "Löschen" : function() {
                $("#output").text("Alles löschen");
                $(this).dialog("close");
            },
            "Abbrechen" : function() {
                $("#output").text("Vielleicht beim nächsten Mal");
                $(this).dialog("close");
            }
        }
    });
    $("#myButton").click(function() {
        $("#myDialog").dialog("open");
    });

});

