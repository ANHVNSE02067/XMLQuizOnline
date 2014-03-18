$(document).ready(function(){
    $('#staffFilter').keyup(function(){
        filterStaff($(this).val());
    });
});


function filterStaff(keyword){
    var staffTable = $('#listStaff');
    $.uiTableFilter(staffTable, keyword);
}
