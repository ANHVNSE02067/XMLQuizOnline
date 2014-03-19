<?php $quiz = $this->data['quiz']; ?>
<h2 class="quizHeader">
    <span class="quizTitle"><?php echo $quiz->getDescriptionQuiz(); ?> <br><span class="score">Result: <?php echo $this->data['correct'] ?>/<?php echo $this->data['total']; ?></span></span>
<span class="quizTime">Total Time <br><span id="time"><?php echo gmdate('H:i:s', $this->data['finishTime']); ?></span></span>
</h2>
<form id="questions">
<input type="hidden" name="quizId" value="<?php echo $quiz->getQuizID(); ?>">
<?php $questions = $quiz->getQuestions();
for ($i = 1; $i < count($questions); $i++) { ?>
<table id="ques<?php echo $questions[$i]->getQuestionID(); ?>" class="question" border="1">
<tr class="ques-desc">
<th colspan="3"><strong>Question <?php echo $i; ?>:</strong> <?php echo $questions[$i]->getDescriptionQuestion(); ?></th>
</tr>
<?php $choices = $questions[$i]->getChoices(); 
for($j = 0; $j < count($choices); $j++) { ?>
    <tr class="choice 
    <?php 
    if ($j == $questions[$i]->getSelectedIndex()) {
        if($questions[$i]->isCorrect()){
            echo 'correct';
        }else{
            echo 'wrong';
        }
    } else {
        if ($choices[$j]->getCorrect() == CHOICE_TRUE){
            echo 'answer';
        }
    } ?>" >
<td class="choice-letter"><?php echo chr(ord('A') + $j); ?>. </td>
<td class="choice-desc"><?php echo $choices[$j]->getDescriptionChoice(); ?></td>
<td class="choice-select"><input disabled="disabled" type="radio" name="question[<?php echo $questions[$i]->getQuestionID(); ?>]" value="<?php echo $j; ?>" <?php
if ($j == $questions[$i]->getSelectedIndex()) {
    echo 'checked="checked"';
} 
?>></td>
</tr>
<?php } ?>
</table>
<?php } ?>
</form>
