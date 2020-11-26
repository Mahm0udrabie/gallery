
$(document).ready(function(){

    $("#login-form").click(function(){
        $(".col-md-4").show();
        $(".register").hide();
        $(".login").show();
        $(".reset").hide();
        $(".contact-us").hide();
    });
    $("#sign-up-form").click(function(){
        $(".col-md-4").show();
        $(".login").hide();
        $(".register").show();
        $(".reset").hide();
        $(".contact-us").hide();
    });
     $(".contact").click(function(){
        $(".col-md-4").show();
        $(".contact-us").show();
        $(".login").hide();
        $(".reset").hide();
        $(".register").hide();
    });
    


    // $(".reg").click(function(){
    //     $(".login").hide();
    //     $(".register").show();
    //     $(".reset").hide();
    // });
    $(".forget").click(function(){
        $(".login").hide();
        $(".register").hide();
        $(".reset").show();
        $(".contact-us").hide();
    });
});


