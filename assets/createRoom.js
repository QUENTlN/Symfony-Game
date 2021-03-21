import './features/autocheck';
$('#config_enregistre_nameProfil').on('change',function (){
    var id = $('#config_enregistre_nameProfil option:selected').val();

    $.ajax({

            method:"POST",
            url: "/search_param",
            data: {id: id },
            success:function(data) {
                $("#config_enregistre_nbMaxPlayer").val(data.nbMaxPlayer);
                $("#config_enregistre_numberRound").val(data.nbRound);
                $("input:checkbox").prop( "checked", false );
                $.each( data.subCategories, function( index, subCategory ) {
                    $("#config_enregistre_subCategories_"+subCategory).prop( "checked", true )
                    let gameKey = $("#config_enregistre_subCategories_"+subCategory).parent().parent().attr('id').split("-")[0]
                    const categoryKey = $("#config_enregistre_subCategories_"+subCategory).parent().parent().attr('id').split("-")[1]
                    $("#"+gameKey+"-"+categoryKey).find(":checkbox").prop( "checked", true )
                    $("#"+gameKey).find(":checkbox").prop( "checked", true )
                });


            }

    });
})


