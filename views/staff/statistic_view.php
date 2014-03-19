<table id="listQuiz" class="table-list">
    <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Time</td>
        </tr>
    </thead>
    <tbody>
<?php foreach ($this->data['quizzes'] as $quiz) {?>
        <tr>
            <td><?php echo $quiz->getQuizID(); ?></td>
            <td><a href="report.php?quizId=<?php echo $quiz->getQuizID(); ?>"><?php echo $quiz->getDescriptionQuiz(); ?></a></td>
            <td><?php echo $quiz->getTime(); ?></td>
        </tr>
<?php } ?>
    </tbody>
</table>