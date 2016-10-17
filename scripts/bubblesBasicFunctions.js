/**
 * @author Patrick Münster
 *
 * Basic functions of Bubbles
 */


$(function () {
    
    // Add Stack Overflow project
    $("#btn_addStackOverflow").click(function() {
       console.log("add a new project");
       
       //open Editor / create Editor
       $("#dbx_addProject").dialog("open");
       // clear userinputs
       $("#projectTitle").val('');
       $("#dbx_addProject textarea").val('');
    });
    
    $("#dbx_addProject").dialog({
       autoOpen : false,
       modal : true,
       resizeable : false,
       draggable : false,
       width: 400,
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
