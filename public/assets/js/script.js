$(function(){
    $(".search_link").on("click", function(){
        $(this).hide(400);
        $(".my-link").hide(400);
        $(".common-link").hide(400);
        $(".hide_search_link").show(400);
        $("#search").show();
    });

    $(".hide_search_link").on("click", function(){
        $(this).hide(400);
        $(".my-link").show(400);
        $(".common-link").show(400);
        $(".search_link").show(400);
        $("#search").hide();
    });

    $(".add_link").on("click", function(){
        $(this).hide(200);
        $(".add_form").slideDown(300);
    });

    $("#submit").on("click", function(){
        $(".add_form").css("display", "block");
        $(".add_link").hide();
    });

    $(".hide_link").on("click", function(){
        $(".add_link").show(200);
        $(".add_form").slideUp(200);
    });

    $(".settings_link").on("click", function(){
        $(this).hide(200);
        $(".settings_image").slideDown(300);
    });

    $(".hide_settings_link").on("click", function(){
        $(".settings_link").show(200);
        $(".settings_image").slideUp(200);
    });
});