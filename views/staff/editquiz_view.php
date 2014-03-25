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
