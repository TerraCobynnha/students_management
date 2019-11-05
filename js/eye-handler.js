$(function(){
  //Eye icon handler
  $(".glyphicon-eye-open").on("click",function(){
    $(this).toggleClass("glyphicon-eye-close");

    let type = $("#pwd-login").attr("type");

    if (type == "text") {
      $("#pwd-login").attr("type","password");
    } else {
      $("#pwd-login").attr("type","text");
    }
  });
});
