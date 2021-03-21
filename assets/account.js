import './features/autocheck';
$(document).ready(function() {
    $(this).find('input:checked').each(function(){
        let gameKey = $(this).parent().parent().attr('id').split("-")[0]
        const categoryKey = $(this).parent().parent().attr('id').split("-")[1]
        $("#"+gameKey+"-"+categoryKey).find(":checkbox").prop( "checked", true )
        $("#"+gameKey).find(":checkbox").prop( "checked", true )
    })
});
