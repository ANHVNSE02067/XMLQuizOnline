$(document).ready(function(){
    $('#userFilter').keyup(function(){
        filterUser($(this).val());
    });
});


function filterUser(keyword){
    var staffTable = $('#listUser');
    $.uiTableFilter(staffTable, keyword);
}

function deleteUser(userId){
    if(!confirm('Are you sure to delete this user?')){
        return;
    }
    $('#frmDeleteUser input[name=user_id]').val(userId);
    $('#frmDeleteUser').submit();
}
