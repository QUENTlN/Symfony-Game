
import './styles/room.scss';
import './styles/fonts/ionicons.min.css';
import './styles/fonts/fontawesome-all.min.css';

const eventSource = new EventSource('http://127.0.0.1:2700/.well-known/mercure?topic=' + encodeURIComponent('http://example.com/books/1'));
eventSource.onmessage = event => {
    // Will be called every time an update is published by the server
    console.log(JSON.parse(event.data)); //['answer']
    // $("body").append("<h1>"+JSON.parse(event.data)['question']+"</h1>");
}

// window.addEventListener('beforeunload', function(){
//     if(eventSource != null){
//         eventSource.close()
//     }
// })

(function($) {
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    });
})(jQuery);
