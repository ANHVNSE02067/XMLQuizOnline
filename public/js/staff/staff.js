$(document).ready(function(){
    $('#staffFilter').keyup(function(){
        filterStaff($(this).val());
    });
});


function filterStaff(keyword){
    var staffTable = $('#listStaff');
    $.uiTableFilter(staffTable, keyword);
}

function deleteStaff(staffId){
    if(staffId == $('#authStaffId').val()) {
        alert('You cannot delete yourself!');
        return;
    }
    if(!confirm('Are you sure to delete this staff?')){
        return;
    }
    $('#frmDeleteStaff input[name=staff_id]').val(staffId);
    $('#frmDeleteStaff').submit();
}
