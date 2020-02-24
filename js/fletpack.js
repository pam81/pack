$(document).ready(function() {

  $(".desbloquea").bind("click", function(){
    var url = $(this).data("url");
    $.ajax({
      url: url,
    })
    .done(function( response ) {
      var data = $.parseJSON(response);
      if(data.status == 'ok'){
        window.location=window.location;
      }else{
        swal(data.msg);
      }
    })
    .fail(function(){
      swal("Error al intentar desbloquear.");
    });

  });

  $(window).bind('beforeunload', function(){
    var dir = $(document.body).data("url");
    if (dir){
      $.ajax({
        url: dir,
      });
    }
   
  });

});