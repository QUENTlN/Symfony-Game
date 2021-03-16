import './styles/room.scss';
import './styles/fonts/ionicons.min.css';
import './styles/fonts/fontawesome-all.min.css';


const playerId = $('#js-get-id-player').data('playerId');
const username = $('#js-get-username').data('username');
const roomId = $('#js-get-id-room').data('roomId');
const hostId = $('#js-get-id-host').data('hostId');
const nbRound = $('#js-get-nb-round').data('nbRound');

// console.log(playerId);
// console.log(username);
// console.log(roomId);

//
// const eventSource = new EventSource('http://127.0.0.1:2700/.well-known/mercure?topic=' + encodeURIComponent('http://example.com/books/1'));
// eventSource.onmessage = event => {
//     // Will be called every time an update is published by the server
//     console.log(JSON.parse(event.data)); //['answer']
//     // $("body").append("<h1>"+JSON.parse(event.data)['question']+"</h1>");
// }

// window.addEventListener('beforeunload', function(){
//     if(eventSource != null){
//         eventSource.close()
//     }
// })

(function ($) {
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    });
})(jQuery);

const _receiver = document.getElementById('mercure-content-receiver');
const _messageInput = document.getElementById('mercure-message-input');
const _sendForm = document.getElementById('mercure-message-form');
const _startForm = document.getElementById('start-game-form');
const _nextQuestionForm = document.getElementById('next-question-form');
const _answerForm = document.getElementById('answer-form');
const _callAnswerForm = document.getElementById('call-answer-form');


if (hostId === playerId && _startForm !== null) {

    _startForm.onsubmit = event => {
        sendMessage('startGame', 'start');
        event.preventDefault();
        fetch(_startForm.action, {
            method: _startForm.method
        }).then(() => {
            $('#start-game-form').hide()
        });
        return false;
    }
}

const sendMessage = (typeMsg, message) => {
    fetch(_sendForm.action, {
        method: _sendForm.method,
        body: 'type=' + typeMsg + '&message=' + message + '&idUser=' + playerId + '&idRoom=' + roomId + '&username=' + username,
        headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        })
    }).then(() => {
        _messageInput.value = '';
    });
};

_sendForm.onsubmit = (evt) => {
    sendMessage(_messageInput.value);

    evt.preventDefault();
    return false;
};

const nextQuestion = () => {
    let currentRound = $('#current-round').val();
    if (currentRound <= nbRound) {
        fetch(_nextQuestionForm.action, {
            method: _nextQuestionForm.method,
            body: 'current=' + currentRound + '&room=' + roomId,
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            })
        }).then(() => {
            $('#current-round').val(parseInt(currentRound) + 1)
        });
    } else {
        // fetch(_nextQuestionForm.action, {
        //     method: _nextQuestionForm.method,
        //     body: "mes",
        //     headers: new Headers({
        //         'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        //     })
        // }).then(() => {
        //     $('#current-round').value().counter++;
        // });
    }
}

const startQuestionChrono = () => {
    var timeleft = 15;
    var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("time-addon").innerHTML = "0";
        } else {
            document.getElementById("time-addon").innerHTML = timeleft;
        }
        timeleft -= 1;
    }, 1000);
}

const url = new URL('http://127.0.0.1:2700/.well-known/mercure');
url.searchParams.append('topic', 'http://mercure.hub/room/'.concat(roomId));
const eventSource = new EventSource(url);
eventSource.onmessage = event => {
    const data = JSON.parse(event.data);
    console.log(data)
    switch (data.type) {
        case 'answer':
            if (data.isCorrect === true) {
                $('#score-user-' + data.idUser).html(parseInt($('#score-user-' + data.idUser).html()) + data.newPoints);
            } else {

            }
            break;
        case 'join':
            if ($("#div-user-" + data.idUser).length === 0) {
                $("#accordionSidebar").append('<li class="nav-item" id="div-user-' + data.idUser + '">\n' +
                    '                        <div class="nav-link active">\n' +
                    '                            <i class="icon ion-happy"></i>\n' +
                    '                            <span>' + data.username + '</span>\n' +
                    '                            <span class="badge badge-primary float-right">0</span>\n' +
                    '                        </div>\n' +
                    '                    </li>');
            }
            break;
        // case 'left':
        //     break;
        case 'pushQuestion':
            $('#answerDiv').removeAttr('hidden')
            $('#answer-input').removeAttr('disabled');
            switch (data.questionType) {
                case 'QuestionWithText':
                    $('#question-content').html('<h1 className="h1 text-center mx-auto d-block w-auto unselectable">' + data.text + '</h1>')
                    $('#question-content-generated').html('')
                    break;
                case 'QuestionWithPicture':
                    $('#question-content').html('<img class="rounded mx-auto d-block w-auto unselectable" \n' +
                        '                                 src="./games_images/guess_the/' + data.link + '" \n' +
                        '                                 style="max-height: 70vh; max-width: 100%" alt="?Guess The?"> ')
                    $('#question-content-generated').html('De quel ' + data.subcategory + ' est tirée cette image ?')
                    break;
            }
            startQuestionChrono()
            _answerForm.onsubmit = event => {
                event.preventDefault();
                fetch(_answerForm.action, {
                    method: _answerForm.method,
                    body: 'type=answer&message=' + $('#answer-input').val() + '&idRoom=' + roomId + '&time=' + parseInt($('#time-addon').html()) + '&question=' + data.idQuestion,
                    headers: new Headers({
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    })
                }).then(() => {
                    _messageInput.value = '';
                });
            }
            if (hostId === playerId) {
                setTimeout(function () {
                    console.log(data);
                    fetch(_callAnswerForm.action, {
                        method: _callAnswerForm.method,
                        body: 'type=pushAnswer&idRoom=' + roomId + '&question=' + data.idQuestion,
                        headers: new Headers({
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        })
                    }).then(() => {
                        setTimeout(function () {
                            nextQuestion()
                        }, 5000);
                    });
                }, 15000);
            }
            break;
        case 'pushAnswer':
            $('#question-content').html(data.answer);
            $('#question-content-generated').html('');
            $('#answer-input').prop('disabled', true);
            break;
        case 'startGame':
            $('#waiting-text').hide();
            $('#gameCard').removeClass("bg-gradient-primary");
            if (hostId === playerId) {
                console.log('je passe')
                nextQuestion();
            }
            break;
        case 'showResult':
            console.log('Mangoes and papayas are $2.79 a pound.');
            break;
    }
    if (!data.message) {
        return;
    }
    _receiver.insertAdjacentHTML('beforeend', `<div class="message">${data.message}</div>`);
};

window.addEventListener('DOMContentLoaded', () => {
    sendMessage('join', username + ' joined!');
});
