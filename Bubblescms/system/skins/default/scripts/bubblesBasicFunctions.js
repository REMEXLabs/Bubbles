/**
 * @author Patrick Münster
 *
 * Basic functions of Bubbles
 */

/**
 * Adding blur effect to the wrapper 
 */
function addBlurBackground() {
    $("#wrapper").addClass('blurBackground');
}

/**
 * Remove blur effect from the wrapper 
 */
function removeBlurBackground(){
    $('#wrapper').removeClass('blurBackground');
} 

$(function () {
    
    ////////////////////////
    //// EVENT LISTENER ////
    ////////////////////////
    
    //## Sign in button ##// 
    $("#btn_signin").click(function(event) {
        event.preventDefault();
        console.log("open signin dialog");
        
        //open dialog
        $("#dbx_signin").dialog("open");
        addBlurBackground();
    }); 
    
    //## Sign out button ##//
    $("#btn_signout").click(function(event) {
        event.preventDefault();
        console.log("signout");
        window.location.href = window.location.href + '?bubblemaster=logout';
    }); 
 
    
    
    // Add Stack Overflow project
    $("#btn_addStackOverflow").click(function() {
       console.log("add a new project");
       
       //open Editor / create Editor
       $("#dbx_addProject").dialog("open");
       addBlurBackground();
       
        //moved to delcaration
        // $("#dbx_addProject").dialog({
            // close : function(event, ui) {
                // removeBlurBackground();
            // }
        // }); 

       // clear userinputs
       $("#projectTitle").val('');
       $("#dbx_addProject textarea").val('');
    });
    
    
    //////////////////////
    //// INIT DIALOGS ////
    //////////////////////
    
    // Initialize dialog boxes from component-templates.php
    
    $("#dbx_signin").dialog({
       autoOpen : false,
       modal : true,
       resizeable : false,
       draggable : false,
       width: 'auto',
       maxWidth: 600,
       fluid: true,
       close : function(event, ui) {
            removeBlurBackground();
       }
    });
    
    
    
    
    // delcare new dialogbox
    $("#dbx_addProject").dialog({
       autoOpen : false,
       modal : true,
       resizeable : false,
       draggable : false,
       width: 'auto',
       maxWidth: 600,
       fluid: true,
       close : function(event, ui) {
                removeBlurBackground();
       },
       buttons: {
           "OK": function() {
               addNewProject($("#projectTitle").val(), $("#dbx_addProject textarea").val());
               $(this).dialog("close");            
           }
       }
    });
    
    function addNewProject(projecTitle, projectDescription) {     
        
        $("#acc_projects-stackoverflow").append("<h3>"+ projecTitle + "</h3><div>" + projectDescription +"</div>");      
    }
    

    
    
});
