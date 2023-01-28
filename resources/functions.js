var usersDic = {};
var questionsDic = {};
var studentsDic = {};


function removeById(textId) {
  let elementToRemove = $("#" + textId);
  elementToRemove.remove();
}
var arrayOpciones = [];
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
  removeById("errorMessage");
  removeById("divToRemove");
  $(".page-poll #divListSurveys").css("display", "none");
  $(".page-poll #divListQuestions").css("display", "none");

  let initialDiv = $("<div>", {
    id: "divToRemove",
  }).append(
    $("<form>", {
      method: "POST",
      action: "poll.php"
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
      )
      .append(
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
        })
      )
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
      )
      .append(
        $("<input>",{
          type: "submit",
          name: "prueba"
        })
      )
  );
  $("#principalContent").append(initialDiv);

  //Nos permite decorar el calendario
  const datetimeInputs = $(".datetime");
  for (let i = 0; i < datetimeInputs.length; i++) {
      flatpickr(datetimeInputs[i], {
      enableTime: true,
      time_24hr: true,
      dateFormat: "Y-m-d H:i",
      defaultDate: new Date()
      });
  }

  

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
        style:'width:96%;'
      })))
  if($('.inpOption').length>0){
    $('.divOption:nth-last-child(2)').append(
      $('<button>',{
        text:'X',
        onclick:'eliminarDiv(event)',
        display:'inline',
        type:'button'
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

function addDbToDictionary(){
  //Recorremos el div donde estan los divs con los datos de usuarios
  $(".users").children().each(function(){
    var id = $(this).find("p#id").text();
    var name = $(this).find("p#name").text();
    var role = $(this).find("p#role").text();

    usersDic[id] = {"name":name,"role":role}
  })

  //Recorremos el div donde estan los divs con las preguntas
  $(".questions").children().each(function(){
    var id = $(this).find("p#id").text();
    var title = $(this).find("p#title").text();
    var active = $(this).find("p#active").text();
    var type = $(this).find("p#type").text();

    //Tranformando a booleano
    if(active == 1){
      active = true
    }else{
      active = false
    }

    questionsDic[id] = {"title":title,"active":active,"type":type}
  })

  //Recorremos el div donde estan los divs con los datos de alumnos
  $(".students").children().each(function(){
    var id = $(this).find("p#id").text();
    var name = $(this).find("p#name").text();

    studentsDic[id] = {"name":name}
  })

  //Eliminar el div con datos porque es innecesario que se quede ahi
  $("#DB").remove()
}

addDbToDictionary()