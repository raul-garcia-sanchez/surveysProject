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
}

function printListSurveys() {
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListQuestions").css("display", " none");
  $(".page-poll #divListSurveys").css("display", "block");
}
