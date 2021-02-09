import greet from "./test";

$(document).ready(function() {
    $("#demo").click(function() {
        $('body').prepend('<h1>' + greet('Quentin') + '</h1>');
        console.log('Quentin');
    });
});