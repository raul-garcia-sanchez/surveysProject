function removeById(textId) {
  let elementToRemove = $("#" + textId);
  elementToRemove.remove();
}

function formAddQuestion() {
  removeById("divToRemove");
  $(".page-poll #divListSurveys").css("display", "none");
  $(".page-poll #divListQuestions").css("display", "none");
  let initialDiv = $("<div>", {
    id: "divToRemove",
  }).append(
    $("<form>", {
      method: "POST",
    })
      .append(
        $("<h1>", {
          text: "Premi el botó per afegir una pregunta",
          class: "titlePoll",
        })
      )
      .append(
        $("<input>", {
          class: "saveQuestion",
          value: "Guardar",
          type: "submit",
          name: "submitButtonSaveQuestion",
        }).append(
          $("<h1>", {
            text: "Guardar",
          })
        )
      )
  );
  $("#principalContent").append(initialDiv);
}

function formAddSurvey() {
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListSurveys").css("display", "none");
  $(".page-poll #divListQuestions").css("display", "none");
  let initialDiv = $("<div>", {
    id: "divToRemove",
  }).append(
    $("<form>", {
      method: "POST",
    })
      .append(
        $("<h1>", {
          text: "Premi el botó per afegir una enquesta",
          class: "titlePoll",
        })
      )
      .append(
        $("<input>", {
          class: "saveQuestion",
          value: "Guardar",
          type: "submit",
          name: "submitButtonSaveSurvey",
        }).append(
          $("<h1>", {
            text: "Guardar",
          })
        )
      )
  );
  $("#principalContent").append(initialDiv);
}

function printListQuestions() {
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListQuestions").css("display", "block");
  $(".page-poll #divListSurveys").css("display", "none");
  alertCss("S'ha carregat correctament el llistat de preguntes",'i');
}

function printListSurveys() {
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListQuestions").css("display", " none");
  $(".page-poll #divListSurveys").css("display", "block");
  alertCss("S'ha carregat correctament el llistat de enquestes",'i');
}

function alertCss(message,type){
 
  if(type == 'w'){
    backgroundColor = 'rgb(250, 250, 139)';
    borderColor = '3px solid yellow';
  }else if(type == 'e'){
    backgroundColor = 'rgb(255, 127, 127)';
    borderColor = '3px solid red';
  }else if(type == 'i'){
    backgroundColor = 'rgb(166, 166, 255)';
    borderColor = '3px solid blue';
  }else if(type == 's'){
    backgroundColor = 'rgb(96, 252, 96)';
    borderColor = '3px solid green';
  }else{
    backgroundColor = 'rgb(212, 212, 212)';
    borderColor = '3px solid grey';
  }

  $('#divAlertas').append(
    $("<div>", {
      class: 'divAlerta',
    }).css('background-color',backgroundColor).css('border',borderColor).append(
      $('<h4>',{
        text: message
      })
    ).append(
      $('<button>',{
        text: 'X',
        onclick: 'eliminarAlerta(event)'
      })
    ))
}

function eliminarAlerta(event){
  $(event.target).parent().remove()
}

