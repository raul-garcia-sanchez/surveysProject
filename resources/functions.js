function eliminarPorId(textoId){
    let elementoEliminar = $("#"+textoId)
    elementoEliminar.remove();
};

function crearListadoPreguntas(){
    eliminarPorId('divRemovible')
};

function crearListadoEnquestas(){
    eliminarPorId('divRemovible')
};

function crearQuestionarioPregunta(){
    eliminarPorId('divRemovible')
    let divInicial = $("<div>", {
        'id': 'divRemovible'
    }).append(
        $("<h1>", {
            'text': 'Crear Pregunta',
            'class': 'titlePoll'
        }
        )
    ).append(
        $("<button>", {
            'class': 'saveQuestion',
        }).append(
            $("<h1>", {
                'text': 'Guardar'
            })
        )
    )
    $('#contenidoPrincipal').append(divInicial)
};

function crearQuestionarioEncuesta(){
    eliminarPorId('divRemovible')
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