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
        $("<h1>", {
          text: "Creació de pregunta",
          class: "titlePoll",
        }))
        .append(
            $("<form>", {
              method: "POST",
              id:"formQuestion"
            }).append(
        $("<input>", {
          id: "questionInput",
          type: "text",
          name: "questionInput",
        }
        )).append(
            $("<select>", {
                id: "selectTypeQuestion",
                onChange: createButton(),
                name: 'selectTypeQuestion',
            }
        ).append(
            $("<option>", {
                text: "Tipus de pregunta",
                disabled: 'disabled',
                selected:'selected',
            }
        )
        ).append(
            $("<option>", {
                text: "Pregunta oberta",
                value: 'text',
            }
            )
        ).append(
            $("<option>", {
                text: "Pregunta numerica",
                value: 'number',
            }
            )
        )))           
  ;
  $("#principalContent").append(initialDiv);
  $('#selectTypeQuestion').change(function(){
    createButton()
})
    $('#questionInput').on('keyup',function(){
        createButton()
    })
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
}

function printListSurveys() {
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListQuestions").css("display", " none");
  $(".page-poll #divListSurveys").css("display", "block");
}

function createButton(){
    if(($('#questionInput').val()=="")|| $('#selectTypeQuestion option:selected').text()=='Tipus de pregunta'){
        $('#submitButtonSaveQuestion').remove()
    }else{
        $('#submitButtonSaveQuestion').remove()
        $('#formQuestion').append(
            $("<input>", {
              class: "saveQuestion",
              value: "Guardar",
              type: "submit",
              name: "submitButtonSaveQuestion",
              id: "submitButtonSaveQuestion"
            }).append(
              $("<h1>", {
                text: "Guardar",
              })
            ))
    }
    }
