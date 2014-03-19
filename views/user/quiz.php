<?php if ($this->data['quiz']->getIsClosed() == QUIZ_CLOSED) { echo 'Quiz is Closed!'; } else { $quiz = $this->data['quiz']; ?>
<h2 class="quizHeader">
<span class="quizTitle"><?php echo $quiz->getDescriptionQuiz(); ?></span>
<span class="quizTime">Time: <span id="time">59:59</span></span>
<input type="hidden" id="timeinsec" value="<?php echo intval($quiz->getTime() * 60); ?>">
</h2>
<form id="questions" method="POST" action="quiz_result.php">
<input type="hidden" name="quizId" value="<?php echo $quiz->getQuizID(); ?>">
<?php $questions = $quiz->getQuestions();
for ($i = 1; $i < count($questions); $i++) { ?>
<table id="ques<?php echo $questions[$i]->getQuestionID(); ?>" class="question" border="1">
<tr class="ques-desc">
<th colspan="3"><strong>Question <?php echo $i; ?>:</strong> <?php echo $questions[$i]->getDescriptionQuestion(); ?></th>
</tr>
<?php $choices = $questions[$i]->getChoices(); 
for($j = 0; $j < count($choices); $j++) { ?>
<tr class="choice">
<td class="choice-letter"><?php echo chr(ord('A') + $j); ?>. </td>
<td class="choice-desc"><?php echo $choices[$j]->getDescriptionChoice(); ?></td>
<td class="choice-select"><input type="radio" name="question[<?php echo $questions[$i]->getQuestionID(); ?>]" value="<?php echo $j; ?>"></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<div><button type="submit">Submit</button></div>
</form>
<?php } ?>
