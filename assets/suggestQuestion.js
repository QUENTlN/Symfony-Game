$(".GuessTheBtn").on("click", function () {
    $("[name='quiz_question']").attr("hidden", true);
    $("[name='guess_the_question']").removeAttr("hidden");
});


$(".QuizBtn").on("click", function () {
    $("[name='guess_the_question']").attr("hidden", true);
    $("[name='quiz_question']").removeAttr("hidden");
});


var $collectionHolder;
var $addNewItem = $('<div class="form-group text-center"><button class="btn btn-info mb-4">Ajouter</button></div>');
$(document).ready(function () {
    $collectionHolder = $('#answersDiv');
    $collectionHolder.append($addNewItem);
    $collectionHolder.data('index', $collectionHolder.find('input').length)
    $addNewItem.click(function (e) {
        e.preventDefault();
        addNewForm();
    })
});


function addNewForm() {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $panel = $('<div class="mb-2"></div>').append(newForm);
    addRemoveButton($panel);
    $addNewItem.before($panel);
}


function addRemoveButton($panel) {
    var $removeButton = $('<button class="btn btn-outline-danger">Retirer</button>');
    var $panelFooter = $('<div class="input-group-append"></div>').append($removeButton);
    $removeButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.input-group').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $panel.find("input").unwrap();
    $panel.find("input").parent().addClass("input-group");
    $panel.find("input").after($panelFooter);
}


var $guessTheCollectionHolder;
var $addNewGuessTheItem = $('<div class="form-group text-center"><button class="btn btn-info mb-4">Ajouter</button></div>');
$(document).ready(function () {
    $guessTheCollectionHolder = $('#guessTheAnswersDiv');
    $guessTheCollectionHolder.append($addNewGuessTheItem);
    $guessTheCollectionHolder.data('index', $guessTheCollectionHolder.find('input').length)
    $addNewGuessTheItem.click(function (e) {
        e.preventDefault();
        addNewGuessTheAnswerForm();
    })
});


function addNewGuessTheAnswerForm() {
    var prototype = $guessTheCollectionHolder.data('prototype');
    var index = $guessTheCollectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $guessTheCollectionHolder.data('index', index + 1);
    var $panel = $('<div class="mb-2"></div>').append(newForm);
    addGuessTheRemoveButton($panel);
    $addNewGuessTheItem.before($panel);
}


function addGuessTheRemoveButton($panel) {
    var $removeButton = $('<button class="btn btn-outline-danger">Retirer</button>');
    var $panelFooter = $('<div class="input-group-append"></div>').append($removeButton);
    $removeButton.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.input-group').slideUp(1000, function () {
            $(this).remove();
        })
    });
    $panel.find("input").unwrap();
    $panel.find("input").parent().addClass("input-group");
    $panel.find("input").after($panelFooter);
}