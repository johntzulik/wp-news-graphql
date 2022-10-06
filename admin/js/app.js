/**
 * Archivo js de la parte de la administración
 */

$ = jQuery.noConflict();

$(document).ready(function () {
  $("#login").on("click", function (e) {
    e.preventDefault();
    console.log(" logueandome ");
    var endpoint = $("#endpoint").val(),
      numeroExpediente = $("#expediente").val(),
      password = $("#password").val();

    $.ajax({
      method: "POST",
      url: endpoint,
      contentType: "application/json",
      data: JSON.stringify({
        query: `mutation Login($numeroExpediente: String!, $password: String!) {
                login(numeroExpediente: $numeroExpediente, password: $password)
              }`,
        variables: {
          numeroExpediente: numeroExpediente,
          password: password,
        },
      }),
      success: function(res){
        console.log(res)
        console.log("-------------")
        console.log(res.data.login)
        console.log("-------------")
        $("#token").val(res.data.login);
        $.ajax({
          url: setepSaveData.url,
          type: 'post',
          dataType: 'json',
          data: {
              action: 'setep_save_data_config',
              nonce: setepSaveData.nonce,
              endpoint: endpoint,
              numeroExpediente: numeroExpediente,
              password: password,
              token: res.data.login,
              tipo: 'save'
            },
          success: function(res){
              console.log(res.data);
              console.log(res.object);
              console.log("segunda respuesta");
              location.href = "?page=setep_news_config";
              
          }
      })
      }
    });
  });
  $("#newsrefresh").on("click", function () {
    console.log(" refrescando noticias");
    var token = $("#token").val(),
    endpoint = $("#endpoint").val()

    $.ajax({
      method: "POST",
      url: endpoint,
      contentType: "application/json",
      headers: {
        Authorization: "bearer " + token,
      },
      data: JSON.stringify({
        query: `query NoticiasPublicadas {noticiasPublicadas {id title body image status fechayhora}}`,
      }),
      success: function(res){
        console.log('respuesta on success')
        console.log(res)
        res.data.noticiasPublicadas
        $.ajax({
          url: setepSaveData.url,
          type: 'post',
          dataType: 'json',
          data: {
              action: 'setep_save_news_post',
              nonce: setepSaveData.nonce,
              news: res.data.noticiasPublicadas,
              tipo: 'refresh'
            },
          success: function(res){
              console.log(res.data);
              console.log(res.object);
              console.log("segunda respuesta");
              location.href = "?page=setep_news";
          }
      })

      }
    });
  });
});
