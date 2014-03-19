$(document).ready(function(){
    $('#listQuiz tbody tr').click(function(){
        document.location.href = $(this).find('a').attr('href');
    });
    $('#quizFilter').keyup(function(){
        filterQuiz($(this).val());
    });
    $('#quizFilter').focus();
});

function filterQuiz(keyword){
    var quizTable = $('#listQuiz');
    $.uiTableFilter(quizTable, keyword);
}
