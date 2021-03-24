import './styles/room.scss';
import './styles/fonts/ionicons.min.css';
import './styles/fonts/fontawesome-all.min.css';


const playerId = $('#js-get-id-player').data('playerId');
const username = $('#js-get-username').data('username');
const roomId = $('#js-get-id-room').data('roomId');
const hostId = $('#js-get-id-host').data('hostId');
const nbRound = $('#js-get-nb-round').data('nbRound');
let alreadyCorrectAnswer = false;

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
        event.preventDefault();
        sendMessage('startGame');
        $('#start-game-form').hide()
        fetch(_startForm.action, {
            method: _startForm.method
        }).then(() => {
        });
        return false;
    }
}
if (hostId === playerId) {
    $("#restart-btn").on("click", function () {
        $.ajax({
            method: "POST",
            url: "/restart",
            data: {room: roomId}
        });
        $(".user-info").each(function () {
            $(this).find(".score").text("0")
        });
    });
}

const sendMessage = (typeMsg) => {
    fetch(_sendForm.action, {
        method: _sendForm.method,
        body: 'type=' + typeMsg + '&idUser=' + playerId + '&idRoom=' + roomId + '&username=' + username,
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
    console.log(currentRound + " <= " + nbRound)
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
        sendMessage('showResult');
    }
}

const startQuestionChrono = () => {
    var timeleft = 15;
    var downloadTimer = setInterval(function () {
        if (timeleft <= 0) {
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
    console.log(data);
    switch (data.type) {
        case 'answer':
            if (data.isCorrect === true) {
                $('#score-user-' + data.idUser).html(parseInt($('#score-user-' + data.idUser).html()) + parseInt(data.newPoints));
            } else {
                if (parseInt(data.idUser) === playerId) {
                    $('#answer-input').prop('disabled', false);
                }
            }
            let scores = []
            $(".user-info").each(function (index) {
                scores[index] = {
                    id: $(this).data('idPlayer'),
                    score: $(this).find(".score").text(),
                    pseudo: $(this).find(".pseudo").text()
                }
            })
            scores.sort((a, b) => parseFloat(b.score) - parseFloat(a.score));
            $("#accordionSidebar").html("")
            $.each(scores, function (index, user) {
                $("#accordionSidebar").append("\n" +
                    "                        <li class=\"nav-item\" id=\"div-user-{{ score.guest.id }}\">\n" +
                    "                            <div class=\"nav-link active user-info\" data-id-player=\"" + user.id + "\">\n" +
                    "                                <i class=\"icon ion-happy\"></i>\n" +
                    "                                <span class=\"pseudo\">" + user.pseudo + "</span>\n" +
                    "                                <span id=\"score-user-" + user.id + "\"\n" +
                    "                                      class=\"badge badge-primary float-right score\">" + user.score + "</span>\n" +
                    "                            </div>\n" +
                    "                        </li>")
            });
            break;
        case 'join':
            if ($("#div-user-" + data.idUser).length === 0) {
                $("#accordionSidebar").append('<li class="nav-item" id="div-user-' + data.idUser + '">\n' +
                    '                        <div class="nav-link active user-info" data-id-player="' + data.idUser + '">\n' +
                    '                            <i class="icon ion-happy"></i>\n' +
                    '                            <span class="pseudo">' + data.username + '</span>\n' +
                    '                            <span id="score-user-' + data.idUser + '" class="badge badge-primary float-right score">0</span>\n' +
                    '                        </div>\n' +
                    '                    </li>');
            }
            break;
        case 'pushQuestion':
            $('#answerDiv').removeAttr('hidden')
            $('#answer-input').removeAttr('disabled');
            switch (data.questionType) {
                case 'QuestionWithText':
                    $('#question-content').html('<h1 class="h1 text-center mx-auto d-block w-auto unselectable">' + data.text + '</h1>')
                    $('#question-content-generated').html('')
                    break;
                case 'QuestionWithPicture':
                    $('#question-content').html('<img class="rounded mx-auto d-block w-auto unselectable" \n' +
                        '                                 src="./../games_images/guess_the/' + data.link + '" \n' +
                        '                                 style="max-height: 70vh; max-width: 100%" alt="?Guess The?"> ')
                    $('#question-content-generated').html('De quel ' + data.subcategory + ' est tirée cette image ?')
                    break;
            }
            startQuestionChrono()
            _answerForm.onsubmit = event => {
                event.preventDefault();
                $("#answer-input").prop('disabled', true);
                let message = $("#answer-input").val()
                $("#answer-input").val("");
                fetch(_answerForm.action, {
                    method: _answerForm.method,
                    body: 'type=answer&message=' + message + '&idRoom=' + roomId + '&time=' + parseInt($('#time-addon').html()) + '&question=' + data.idQuestion + '&idUser=' + playerId,
                    headers: new Headers({
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    })
                }).then(() => {
                });
            }
            if (hostId === playerId) {
                setTimeout(function () {
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
            $('#question-content').html('<h1 class="h1 text-center mx-auto d-block w-auto unselectable">' + data.answer + '</h1>');
            $('#question-content-generated').html('');
            $('#answer-input').prop('disabled', true);
            $('#answer-input').val('');
            break;
        case 'startGame':
            $('#waiting-text').hide();
            $('#gameCard').removeClass("bg-gradient-primary");
            if (hostId === playerId) {
                nextQuestion();
                $("#replay-game").attr("hidden", true)
            }
            break;
        case 'showResult':
            $("#gameCard").addClass("bg-gradient-primary");
            $("#answerDiv").attr("hidden", true);
            $("#current-round").val(1);
            if (hostId === playerId) {
                $("#replay-game").attr("hidden", false)
            }
            $("#question-content").html("\n" +
                "                                <table class=\"table text-center w-50 mx-auto border-top-0\">\n" +
                "                                    <tbody class=\"text-light\">\n" +
                "                                    <tr class=\"\">\n" +
                "                                        <th scope=\"col\" style=\"border-top-left-radius: 15px\">#</th>\n" +
                "                                        <th scope=\"col\">Joueur</th>\n" +
                "                                        <th scope=\"col\" style=\"border-top-right-radius: 15px\">Score</th>\n" +
                "                                    </tr>\n" +
                "                                    </tbody>\n" +
                "                                </table>")
            let position = 1;
            $(".user-info").each(function () {
                $("tbody").append("\n" +
                    "                                    <tr>\n" +
                    "                                        <th scope=\"row\">" + position + "</th>\n" +
                    "                                        <td>" + $(this).find(".pseudo").text() + "</td>\n" +
                    "                                        <td>" + $(this).find(".score").text() + "</td>\n" +
                    "                                    </tr>")
                $(this).find(".score").text("0")
                position++
            })
            break;
    }
    if (!data.message) {
        return;
    }
    _receiver.insertAdjacentHTML('beforeend', `<div class="message">${data.message}</div>`);
};

window.addEventListener('DOMContentLoaded', () => {
    sendMessage('join');
});
