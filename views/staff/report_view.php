<form id="frmReportFilter">
<div>
    <input id="reportFilter" type="text" placeholder="Search report..">
</div>
</form>
<table id="quizReport" class="table-list">
    <thead>
        <tr>
            <td>User ID</td>
            <td>Full name</td>
            <td>Mark</td>
        </tr>
    </thead>
    <tbody>
<?php foreach ($this->data['reports'] as $report) {?>
        <tr>
            <td><?php echo $report['userID']; ?></td>
            <td><?php echo $report['fullname']; ?></td>
            <td><?php echo $report['result']; ?></td>
        </tr>
<?php } ?>
    </tbody>
</table>
