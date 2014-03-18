<table id="listStaff" class="table-list" border="1">
    <thead>
        <tr>
            <th class="col-id">ID</th>
            <th class="col-name">Name</th>
            <th class="col-email">Email</th>
            <th class="col-action">Action</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($this->data['staffs'] as $staff) { ?>
        <tr>
        <td class="col-id"><?php echo $staff->getStaffID(); ?></td>
        <td class="col-name"><?php echo $staff->getFullname(); ?></td>
        <td class="col-email"><?php echo $staff->getEmail(); ?></td>
            <td class="col-action">
                <button type="button" class="btn-edit">Edit</button>
                <button type="button" class="btn-delete">Delete</button>
            </td>
            </tr>
<?php } ?>
        <tfoot>
            <tr>
                <td colspan="4">
                    <button type="button" id="btnAddStaff" onclick="document.location.href='add_staff.php'">Add Staff</button>
                </td>
            </tr>
        </tfoot>
    </tbody>
</table>
