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

function removeById(textId) {
  let elementToRemove = $("#" + textId);
  elementToRemove.remove();
}
var arrayOpciones = [];
function formAddQuestion() {
  displayNoneForm();
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
          placeholder:'Titol de la pregunta'
        }
        )).append(
            $("<select>", {
                id: "selectTypeQuestion",
                onChange: createButtonSubmit(),
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
        ).append(
          $("<option>", {
              text: "Opcio Simple",
              value: 'opcioSimple',
          }
          )
        )
        ))           
  ;
  $("#principalContent").append(initialDiv);
  $('#selectTypeQuestion').change(function(){
    arrayOpciones = [];
    if($('#selectTypeQuestion option:selected').text()=='Opcio Simple'){
      $('#formQuestion').append(
        $('<div>',{
          id:'divOptions'
        })
      )
      $('#submitButtonSaveQuestion').remove()
      createButtonAddOption();
    }else{
      $('#buttonAddOption').remove()
      $('#divOptions').remove()
      createButtonSubmit()
    }
})
    $('#questionInput').on('keyup',function(){
      if($('#selectTypeQuestion option:selected').text()=='Opcio Simple'){
        createButtonAddOption();
        createButtonSubmit()
      }else{
        createButtonSubmit()
      }
    })
}

function formAddSurvey() {
  displayNoneForm();
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListSurveys").css("display", "none");
  $(".page-poll #divListQuestions").css("display", "none");
  
  let initialDiv = $("<div>", {
    id: "divToRemove",
  }).append(
    $("<form>", {
      method: "POST",
      action: "poll.php",
      id:"formSurvey"
    })
      .append(
        $("<h1>", {
          text: "Premi el botó per afegir una enquesta",
          class: "titlePoll",
        })
      )
      .append(
        $("<label>",{
          for: "inputSurveyText",
          text: "Títol de l'enquesta"
        })
      )
      .append(
        $("<input>",{
          id: "inputSurveyText",
          type: "text",
          name: "inputSurveyText"
        })
      ).append(
        $('<div>',{
          id:'divDates'
        }).append(
          $("<div>",{
            id:'divStartDate'
          }).append(
            $("<label>",{
              for: "inputStartDate",
              text: "Data Inici Enquesta"
            })
          )
          .append(
            $("<input>",{
              class: "datetime",
              type: "datetime-local",
              name: "inputStartDate",
              id: "inputStartDate"
            }))
        ).append(
          $("<div>",{
            id:'divFinishDate'
          })
        .append(
          $("<label>",{
            for: "inputEndDate",
            text: "Data Final Enquesta"
          })
        )
        .append(
          $("<input>",{
            class: "datetime",
            type: "datetime-local",
            name: "inputEndDate",
            id: "inputEndDate"
          })
        ))
      )//Teachers
      .append(
        $("<div>",{
          id: "divTeachers",
        }).append(
          $("<div>",{
            id: "inputTeachersForAdd",
          }).append(
            $('<label>',{
              text:"Professors disponibles"
            })
          )
        )
        .append(
          $("<div>",{
            id: "inputTeachersAdded"
          }).append(
            $('<label>',{
              text:"Professors a l'enquesta"
            })
          )
        )
      )
      //QUESTIONS
      .append(
        $("<div>",{
          id: "divQuestions",
        }).append(
          $("<div>",{
            id: "inputQuestionsForAdd",
          }).append(
            $('<label>',{
              text:"Preguntes per l'enquesta"
            })
          )
        )
        .append(
          $("<div>",{
            id: "inputQuestionsAdded"
          }).append(
            $('<label>',{
              text:"Preguntes de l'enquesta"
            })
          )
        )
      )
      //STUDENTS
      .append(
        $("<div>",{
          id: "divStudents"
        }).append(
          $("<div>",{
            id: "inputStudentsForAdd",
          }).append(
            $('<label>',{
              text:"Alumnes disponibles"
            })
          )
        )
        .append(
          $("<div>",{
            id: "inputStudentsAdded"
          }).append(
            $('<label>',{
              text:"Alumnes a l'enquesta"
            })
          )
        )
      )
      
  );
  
  $("#principalContent").append(initialDiv);
  

  //Calendar decoration
  const datetimeInputs = $(".datetime");
  for (let i = 0; i < datetimeInputs.length; i++) {
      flatpickr(datetimeInputs[i], {
      enableTime: true,
      time_24hr: true,
      dateFormat: "Y-m-d H:i",
      defaultDate: new Date()
      });
  }

  //Create options teachers,questions and students
  createDivTeachers()
  createDivQuestions()
  createDivStudents()

  //Move options (event is for not submit)
  $(".inputTeacher").click(function(event){
    event.preventDefault();

    if($(this).hasClass("added")){
      $("#inputTeachersForAdd").append($(this))
      $(this).removeClass("added").addClass("notAdded")
      $(this).children().remove()
    }else{
      let key = $(this).attr("id")
      $("#inputTeachersAdded").append($(this))
      $(this).removeClass("notAdded").addClass("added")
      $(this).append(
        $("<input>",{
          type: "text",
          name: "teach"+key,
          value: questionsDic[key]["title"],
          hidden: "true"
        })
      )
    }
    buttonSubmit()
  });

  $(".inputQuestion").click(function(event){
    event.preventDefault();

    if($(this).hasClass("added")){
      $("#inputQuestionsForAdd").append($(this))
      $(this).removeClass("added").addClass("notAdded")
      $(this).children().remove()
    }else{
      let key = $(this).attr("id")
      $("#inputQuestionsAdded").append($(this))
      $(this).removeClass("notAdded").addClass("added")
      $(this).append(
        $("<input>",{
          type: "text",
          name: "quest"+key,
          value: questionsDic[key]["title"],
          hidden: "true"
        })
      )
      
    }
    buttonSubmit()
  });

  $(".inputStudent").click(function(event){
    event.preventDefault();
    if($(this).hasClass("added")){
      $("#inputStudentsForAdd").append($(this))
      $(this).removeClass("added").addClass("notAdded")
      $(this).children().remove()
    }else{
      let key = $(this).attr("id")
      $("#inputStudentsAdded").append($(this))
      $(this).removeClass("notAdded").addClass("added")
      $(this).append(
        $("<input>",{
          type: "text",
          name: "studn"+key,
          value: questionsDic[key]["title"],
          hidden: "true"
        })
      )
    }
  });
  
  //Check when the user is writting the survey title
  $("#inputSurveyText").on("input", function() {
    buttonSubmit()
  });
}

function printListQuestions() {
  displayNoneForm();
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListQuestions").css("display", "block");
  $(".page-poll #divListSurveys").css("display", "none");
}

function printListSurveys() {
  displayNoneForm();
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListQuestions").css("display", " none");
  $(".page-poll #divListSurveys").css("display", "block");
}

function createButtonSubmit(){
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

function createButtonAddOption(){
  if(($('#questionInput').val()=="")|| $('#selectTypeQuestion option:selected').text()=='Tipus de pregunta'){
    $('#buttonAddOption').remove()
  }else{
    $('#buttonAddOption').remove()
    $('#formQuestion').append(
        $("<button>", {
          class: "buttonAddOption",
          value: "buttonAddOption",
          id: "buttonAddOption"
        }).append(
          $("<h1>", {
            text: "+",
          })
        ))
    $('#buttonAddOption').on('click',crearInputPregunta)
  }
}

function crearInputPregunta(){
  $('#buttonAddOption').remove()
  $('#submitButtonSaveQuestion').remove()
  $('.inpOption:last').attr('readonly',true)
  $('.inpOption:last').attr('onmousedown','return false')
  $('#divOptions').append(
    $('<div>',{
      class:'divOption',
    }).append
    (
      $('<input>',{
        class:'inpOption',
      })))
  if($('.inpOption').length>0){
    $('.divOption:nth-last-child(2)').append(
      $('<button>',{
        text:'X',
        onclick:'eliminarDiv(event)',
        display:'inline',
        type:'button',
        class:'buttonRemoveOption'
      })
    )
  }
  $('.inpOption:last').on('keyup',function(){
    if($('.inpOption:last').val() != ""){
      createButtonAddOption();
    }else{
      $('#buttonAddOption').remove()
    }
    if($('.inpOption').length<2){
      $('#submitButtonSaveQuestion').remove()
    }else{
      $('#submitButtonSaveQuestion').remove()
      $('.inpOption:last').on('keyup',function(){
        if($('.inpOption:last').val()!=""&&$('.inpOption').length>1){
          createButtonSubmit()
          addNameInputs()
        }
        })
    }
  })
}

function eliminarDiv(event){
  $(event.target).parent().remove()
  addNameInputs()
  if($('.inpOption').length<=2){
    $('#submitButtonSaveQuestion').remove()
  }
}

function addNameInputs(){
  $(".inpOption").each(function(index){
    $(this).attr("name",index)
  })
}

function eliminarAlerta(event){
  $(event.target).parent().remove()
}

function deleteById(id, type){
  let str = id+","+type
  $('#inpDeleteId').val(str)
  $('#divEliminar').css('display','block')
  
}

function displayNoneForm(){
  $('#divEliminar').css('display','none')
}

function createDivTeachers(){
  for(var key in usersDic){
    $("#inputTeachersForAdd").append(
      $("<button>",{
        text:usersDic[key]["name"],
        class: "inputTeacher notAdded",
        id: key
      })
    )
  }
}

function createDivQuestions(){
  for(var key in questionsDic){
    $("#inputQuestionsForAdd").append(
      $("<button>",{
        text:questionsDic[key]["title"],
        class: "inputQuestion notAdded",
        id: key
      })
    )
  }
}

function createDivStudents(){
  for(var key in studentsDic){
    $("#inputStudentsForAdd").append(
      $("<button>",{
        text:studentsDic[key]["name"],
        class: "inputStudent notAdded",
        id: key
      })
    )
  }
}
function createOrRemoveSubmitButton(remove=false){
  if(remove){
    $("#inputSubmitSurvey").remove()
  }else{
    if($("#inputSubmitSurvey").val() == undefined){
      $("#formSurvey").append(
        $("<input>",{
          type:"submit",
          id:"inputSubmitSurvey",
          value:"Guardar Enquesta",
          name:"surveySubmit"
        })
      )
    }
  }
}

function checkToCreateSubmitButton(){
  if($("#inputSurveyText").val() == ""){
    return false
  }else if($("#inputStartDate").val() == undefined){
    return false
  }else if($("#inputEndDate").val() == undefined){
    return false
  }else if($("#inputTeachersAdded").children().length == 1){
    return false
  }else if($("#inputQuestionsAdded").children().length == 1){
    return false
  }else{
    return true
  }
}

function buttonSubmit(){
  if(checkToCreateSubmitButton()){
    createOrRemoveSubmitButton()
  }else{
    createOrRemoveSubmitButton(remove=true)
  }
}