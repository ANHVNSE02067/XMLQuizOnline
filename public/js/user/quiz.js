$(document).ready(function(){
    $('.choice-desc, .choice-letter').click(function(){
        $(this).parent().find('input[type=radio]').trigger('click');
    });
    countDown();
});

function countDown(){
    var time = parseInt($('#timeinsec').val());
    time = time - 1;
    $('#timeinsec').val(time);
    $('#time').text(formatTime(time));
    if (time > 0) {
       setTimeout(function(){countDown()}, 1000);
    }else{
        // Time end
        submitQuiz();
    }
}

function submitQuiz(){
    return false;
}

function formatTime(s){
    var h = Math.floor(s/3600);
    s -= h*3600;
    var m = Math.floor(s/60); 
    s -= m*60;
    var out = '';
    if (h > 0) out += ((h < 10)?('0' + h):h) + ':';
    if (m > 0) out += ((m < 10)?('0' + m):m) + ":";
    out+= (s < 10)?('0' + s):s;
    return out;
}
