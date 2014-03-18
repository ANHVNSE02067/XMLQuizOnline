<?php if ($this->data['quiz']->getIsClosed() == QUIZ_CLOSED) { echo 'Quiz is Closed!'; } else { $quiz = $this->data['quiz']; ?>
<h2><?php echo $quiz->getDescriptionQuiz(); ?></h2>
<form id="questions">
<?php $questions = $quiz->getQuestions();
for ($i = 1; $i < count($questions); $i++) { ?>
<table id="ques<?php echo $questions[$i]->getQuestionID(); ?>" class="question" border="1">
<tr class="ques-desc">
<th colspan="3"><strong>Question <?php echo $i; ?>:</strong> <?php echo $questions[$i]->getDescriptionQuestion(); ?></th>
</tr>
<?php $choices = $questions[$i]->getChoices(); 
for($j = 0; $j < count($choices); $j++) { ?>
<tr class="choice a">
<td><?php echo chr(ord('A') + $j); ?>. </td>
<td><?php echo $choices[$j]->getDescriptionChoice(); ?></td>
<td><input type="radio" name="ques<?php echo $questions[$i]->getQuestionID(); ?>" value="<?php echo $j; ?>"></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<div><button type="submit">Submit</button></div>
</form>
<?php } ?>
