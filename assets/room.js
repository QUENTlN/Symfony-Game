// const url = new URL('https://localhost/.well-known/mercure')
// url.searchParams.append('topic', 'http://symfony-blog.fr/new/article')
// // console.log(url);
const eventSource = new EventSource('https://localhost/.well-known/mercure?topic=' + encodeURIComponent('http://example.com/books/1'));
eventSource.onmessage = event => {
    // Will be called every time an update is published by the server
    console.log(JSON.parse(event.data)); //['answer']
    // $("body").append("<h1>"+JSON.parse(event.data)['question']+"</h1>");
}
window.addEventListener('beforeunload', function(){
    if(eventSource != null){
        eventSource.close()
    }
})
