$(document).ready(function(){
    $('#reportFilter').keyup(function(){
        filterReport($(this).val());
    });
});


function filterReport(keyword){
    var reportTable = $('#quizReport');
    $.uiTableFilter(reportTable, keyword);
}
