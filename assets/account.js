$(".checkbox-parent").change(function() {
    if( $(this).is(':checked') ) {
        $(this).parent().parent().find(':checkbox').prop( "checked", true )
    }else{
        $(this).parent().parent().find(':checkbox').prop( "checked", false )
    }
});

$(".checkbox-child").change(function() {
    if( $(this).is(':checked') ) {
        let gameKey=0
        if (typeof $(this).parent().parent().attr('id') === 'undefined'){
            gameKey = $(this).parent().attr('id').split("-")[0]
        }else{
            gameKey = $(this).parent().parent().attr('id').split("-")[0]
            const categoryKey = $(this).parent().parent().attr('id').split("-")[1]
            $("#"+gameKey+"-"+categoryKey).find(":checkbox").prop( "checked", true )
        }
        $("#"+gameKey).find(":checkbox").prop( "checked", true )
    }else{
        if( $(this).parent().parent().parent().find('input:checked').length === 0){
            let gameKey=0
            if (typeof $(this).parent().parent().attr('id') === 'undefined'){
                gameKey = $(this).parent().attr('id').split("-")[0]
                $("#"+gameKey).find(":checkbox").prop( "checked", false )
            }else{
                gameKey = $(this).parent().parent().attr('id').split("-")[0]
                const categoryKey = $(this).parent().parent().attr('id').split("-")[1]
                $("#"+gameKey+"-"+categoryKey).find(":checkbox").prop( "checked", false )
                if ($(this).parent().parent().parent().parent().parent().find('input:checked').length === 0){
                    $("#"+gameKey).find(":checkbox").prop( "checked", false )
                }
            }
        }
    }
});
