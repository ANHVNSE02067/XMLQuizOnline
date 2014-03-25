<?php $quiz = $this->data['quiz']; ?>
<form id="frmEditQuiz" method="post">
    <div>
        <label for="title">Title*: </label>
        <input id="title" type="text" name="title" value="<?php echo $quiz->getDescriptionQuiz(); ?>" placeholder="A short description about your quiz..">
    </div>
    <div>
        <label for="time">Time*: </label>
        <input id="time" type="text" name="time" value="<?php echo $quiz->getTime(); ?>">
        <span>Minutes</span>
    </div>
    <div>
        <label for="status">Status*: </label>
        <select name="status">
        <option value="<?php echo QUIZ_OPEN; ?>" <?php if (QUIZ_OPEN == $quiz->getIsClosed()) { ?>selected="selected"<?php } ?>>Opening</option>
        <option value="<?php echo QUIZ_CLOSED; ?>" <?php if (QUIZ_CLOSED == $quiz->getIsClosed()) { ?>selected="selected"<?php } ?>>Closed</option>
        </select>
    </div>
    <div style="text-align: center;">
        <input id="editQuiz" type="submit" name="editQuiz" value="Edit Quiz">
    </div>
</form>
<a class="btn-big" href="add_question?quizId=<?php echo $quiz->getQuizID(); ?>">Add Question</a>
<table id="listQuestino" class="table-list" border="1">
    <thead>
        <tr>
            <th>Question ID</th>
            <th>Description</th>
            <th>Choices</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<?php foreach($quiz->getQuestions() as $question) { ?>
        <tr>
            <td><?php echo $question->getQuestionID(); ;?></td>
            <td><?php echo $question->getDescriptionQuestion(); ;?></td>
            <td><?php foreach($question->getChoices() as $key => $choice) {
                echo '['.$key.'] ' . $choice->getDescriptionChoice() . '<br>';
            }
?></td>
            <td class="col-action">
            <button type="button" class="btn-edit" onclick="document.location.href='edit_question.php?quizId=<?php echo $quiz->getQuizID(); ?>&questionId=<?php echo $question->getQuestionID(); ?>'">Edit</button>
            <button type="button" class="btn-delete" onclick="deleteQuestion('<?php echo $quiz->getQuizID(); ?>', '<?php echo $question->getQuestionID(); ?>')">Delete</button>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>

