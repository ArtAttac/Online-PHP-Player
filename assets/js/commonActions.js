//Will run once page loaded
$(document).ready(function(){
    //Making the button onClick do something
    $(".showHideSideBar").on("click", function(){
       var main = $("#mainSectionContainer");
       var nav = $("#sideNavContainer");

       //if the main container has class with padding, when button is clicked, hide it
       if(main.hasClass("leftPadding")){
           nav.hide();
       }
       else{
           nav.show();
       }

       //Toggles the class on the div element
       main.toggleClass("leftPadding");
    });
});