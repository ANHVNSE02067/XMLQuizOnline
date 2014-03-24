<form id="frmQuizFilter">
<div>
    <input id="quizFilter" type="text" placeholder="filter..">
</div>
</form>
<table id="listQuiz" class="table-list" border="1">
    <thead>
        <tr>
            <th>Quiz ID</th>
            <th>Staff ID</th>
            <th>Quiz Title</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($this->data['quizzes'] as $quiz) { ?>
        <tr>
        <td><?php echo $quiz->getQuizID(); ?></td>
        <td><?php echo $quiz->getStaffID(); ?></td>
        <td><?php echo $quiz->getDescriptionQuiz(); ?></td>
        <td><?php echo $quiz->getTime(); ?></td>
        <td><?php echo ($quiz->getIsClosed() == QUIZ_CLOSED)?"Closed":"Opening" ?></td>
            <td class="col-action">
                <button type="button" class="btn-edit">Edit</button>
                <button type="button" class="btn-delete" onclick="deleteQuiz('<?php echo $quiz->getQuizID(); ?>')">Delete</button>
            </td>
            </tr>
<?php } ?>
        <tfoot>
            <tr>
                <td colspan="6">
                    <button type="button" id="btnAddQuiz" onclick="document.location.href='add_quiz.php'">Add Quiz</button>
                </td>
            </tr>
        </tfoot>
    </tbody>
</table>
