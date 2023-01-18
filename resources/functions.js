function eliminarPorId(textoId){
    let elementoEliminar = $("#"+textoId)
    elementoEliminar.remove();
};

function crearQuestionarioPregunta(){
    eliminarPorId('divRemovible')
    $('.page-poll #divListSurveys').css('display', 'none')
    $('.page-poll #divListQuestions').css('display', 'none')
    let divInicial = $("<div>",{
        'id':'divRemovible'
    }).append(
        $("<form>", {
            'method': 'POST'
        }).append(
            $("<h1>", {
                'text': 'Premi el botó per afegir una pregunta',
                'class': 'titlePoll'
            }
            )
        ).append(
            $("<input>", {
                'class': 'saveQuestion',
                'value': 'Guardar',
                'type': 'submit',
                'name': 'submitButtonSaveQuestion'
            }).append(
                $("<h1>", {
                    'text': 'Guardar'
                })
            )
        )
    )
    $('#contenidoPrincipal').append(divInicial)
};

function crearQuestionarioEncuesta(){
    eliminarPorId('divRemovible')
    $('.page-poll #divListSurveys').css('display', 'none')
    $('.page-poll #divListQuestions').css('display', 'none')
    let divInicial = $("<div>",{
        'id':'divRemovible'
    }).append(
        $("<h3>",{
            'text':'Crear Enquesta'}
        )
    ).append(
        $("<div>",{
            'class':'itemPregunta'
        }).append(
            $("<h4>",{
                'text':'Encuesta 1'
            }) 
        )
    ).append(
        $("<h4>",{
            'text':'Encuesta 2'
        })
    )
    $('#contenidoPrincipal').append(divInicial)
};

function crearListadoPreguntas(){
    eliminarPorId('divRemovible');
    $('.page-poll #divListQuestions').css('display',' none')
    $('.page-poll #divListSurveys').css('display', 'block')
}

function crearListadoEnquestas(){
    eliminarPorId('divRemovible');
    $('.page-poll #divListQuestions').css('display', 'block')
    $('.page-poll #divListSurveys').css('display', 'none')
}