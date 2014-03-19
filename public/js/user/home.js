$(document).ready(function(){
    $('#listQuiz tbody tr').click(function(){
        document.location.href = $(this).find('a').attr('href');
    });
});
