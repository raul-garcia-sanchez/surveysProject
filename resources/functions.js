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
    let divInicial = $("<div>",{
        'id':'divRemovible'
    }).append(
        $("<h3>",{
            'text':'Crear Pregunta'}
        )
    ).append(
        $("<div>",{
            'class':'itemPregunta'
        }).append(
            $("<h4>",{
                'text':'pregunta 1'
            }) 
        )
    ).append(
        $("<h4>",{
            'text':'pregunta 2'
        })
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