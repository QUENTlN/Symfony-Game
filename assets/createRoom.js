// $(".config-enregistre").change(function() {
//
// });
// const numberPlayer = $( ".numberPlayer" ).val();
// console.log(numberPlayer);
// console.log('jdjdjd');
// $( ".numberPlayer" ).val( 5 );
// // $(".numberPlayer").find(":input").replaceWith('6');
// let numberPlayer = $( ".numberPlayer" ).val();
// console.log(numberPlayer);

// function displayVals() {
//     var singleValues = $( "#single" ).val();
//     var multipleValues = $( "#multiple" ).val() || [];
//     // When using jQuery 3:
//     // var multipleValues = $( "#multiple" ).val();
//     $( "p" ).html( "<b>Single:</b> " + singleValues +
//     " <b>Multiple:</b> " + multipleValues.join( ", " ) );
// }
// function displayVals() {
//     var numberPlayer = $( ".numberPlayer" ).val();
//     // $(".numberPlayer").find(":input").replaceWith(6);
//
//    // var multipleValues = $( ".numbRound" ).val() || [];
//     // When using jQuery 3:
//     // var multipleValues = $( "#multiple" ).val();
//
// }
//
//     $( ".config-enregistre " ).change( displayVals );
//     displayVals();
$(document).on('change','.config-enregistre',function (){
//     // let $field = $(this)
//     // let $form = $field.closest('form')
//     // let data  = {}
//     // data[$field.attr('nameProfil')] = $field.val()
//     // debugger
//
    var id = $('.config-enregistre option:selected').val();
    console.log(id);
    var np = $(".config-enregistre option:selected" ).text();
    console.log(np);

    // $.ajax({
    //     url: "http://127.0.0.1:8000/create_room",
    //     type: 'POST',
    //     data: {id: id },
    //     success:function(data) {
    //         // var info = eval(data);
    //         // console.log(data);
    //         console.log(id);
    //     }
    //
    // });

    $.ajax({

            method:"GET",
            url: "http://127.0.0.1:8000/create_room",
            // url: "{{ path('createRoom')}}",
            data: {id: id },
            // type: 'POST',
            success:function(data) {
                    // var info = eval(data);
                    // console.log(data);
                    console.log(id);
            }

    });


//     // console.log(room.roomSettings);
//
})

// $.ajax({    //create an ajax request to display.php
//     type: "GET",
//     url: "RoomSettings.php",
//     dataType: "json",   //expect html to be returned
//     success: function(response){
//         // $("#responsecontainer").html(response);
//         alert(response);
//
//     }
//
// });


