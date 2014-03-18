$(document).ready(function(){
    $('#userFilter').keyup(function(){
        filterUser($(this).val());
    });
});


function filterUser(keyword){
    var staffTable = $('#listUser');
    $.uiTableFilter(staffTable, keyword);
}
