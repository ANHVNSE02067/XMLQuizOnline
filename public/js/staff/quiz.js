$(document).ready(function(){
    $('#quizFilter').keyup(function(){
        filterQuiz($(this).val());
    });
});


function filterQuiz(keyword){
    var quizTable = $('#listQuiz');
    $.uiTableFilter(quizTable, keyword);
}
