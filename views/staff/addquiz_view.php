<form id="frmAddQuiz" method="post">
    <div>
        <label for="title">Title*: </label>
        <input id="title" type="text" name="title" placeholder="A short description about your quiz..">
    </div>
    <div>
        <label for="time">Time*: </label>
        <input id="time" type="text" name="time" value="0">
        <span>Minutes</span>
    </div>
    <div>
        <label for="status">Status*: </label>
        <select name="status">
           <option value="<?php echo QUIZ_OPEN; ?>">Opening</option>
            <option value="<?php echo QUIZ_CLOSED; ?>">Closed</option>
        </select>
    </div>
    <div style="text-align: center;">
        <input id="addQuiz" type="submit" name="addQuiz" value="Add Quiz">
    </div>
</form>
