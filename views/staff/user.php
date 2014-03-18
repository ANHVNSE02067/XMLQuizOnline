<table id="listUser" class="table-list" border="1">
    <thead>
        <tr>
            <th class="col-id">ID</th>
            <th class="col-name">Name</th>
            <th class="col-email">Email</th>
            <th class="col-action">Action</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($this->data['users'] as $user) { ?>
        <tr>
        <td class="col-id"><?php echo $user->getUserID(); ?></td>
        <td class="col-name"><?php echo $user->getFullname(); ?></td>
        <td class="col-email"><?php echo $user->getEmail(); ?></td>
            <td class="col-action">
                <button type="button" class="btn-edit">Edit</button>
                <button type="button" class="btn-delete">Delete</button>
            </td>
            </tr>
<?php } ?>
        <tfoot>
            <tr>
                <td colspan="4">
                    <button type="button" id="btnAddUser" onclick="document.location.href='add_user.php'">Add User</button>
                </td>
            </tr>
        </tfoot>
    </tbody>
</table>
