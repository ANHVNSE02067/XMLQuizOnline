$(document).ready(function(){
    $('#quizFilter').keyup(function(){
        filterQuiz($(this).val());
    });
});


function filterQuiz(keyword){
    var quizTable = $('#listQuiz');
    $.uiTableFilter(quizTable, keyword);
}

function deleteQuiz(quizId){
    if(!confirm('Are you sure to delete this quiz?')){
        return;
    }
    $('#frmDeleteQuiz input[name=quiz_id]').val(quizId);
    $('#frmDeleteQuiz').submit();
}
