<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>World War II Knowledge Quiz</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-5">World War II Knowledge Quiz</h1>
    <div id="quizContainer"></div>
    <button id="submitQuiz" class="btn btn-primary mt-3">Submit</button>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $.ajax({
        url: 'fetch_questions.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
          const quizContainer = $('#quizContainer');
          data.forEach((question, index) => {
            let questionHtml = `<div class="question"><p>${index + 1}. ${question.question}</p>`;

            if (question.type === 'true_false') {
              questionHtml += `
                <div>
                  <label><input type="radio" name="question_${question.id}" value="true"> True</label>
                  <label><input type="radio" name="question_${question.id}" value="false"> False</label>
                </div>
              `;
            } else if (question.type === 'multiple_choice') {
              questionHtml += `<div>`;
              question.options.forEach(option => {
                questionHtml += `
                  <label><input type="radio" name="question_${question.id}" value="${option}"> ${option}</label>
                `;
              });
              questionHtml += `</div>`;
            } else if (question.type === 'fill_blank') {
              questionHtml += `<div><input type="text" name="question_${question.id}" class="form-control"></div>`;
            } else if (question.type === 'matching') {
              questionHtml += `<div class="matching-question">`;
              question.matches.forEach(match => {
                questionHtml += `
                  <div class="matching-pair">
                    <span>${match.match_text}</span>
                    <input type="text" name="question_${question.id}_match_${match.match_text}" class="form-control" placeholder="Match with ${match.match_pair}">
                  </div>
                `;
              });
              questionHtml += `</div>`;
            }
            questionHtml += `</div>`;
            quizContainer.append(questionHtml);
          });
        }
      });

      $('#submitQuiz').click(function() {
        
        const answers = {};
        $('.question').each(function() {
          const questionId = $(this).find('input[type="radio"], input[type="text"]').first().attr('name').split('_')[1];
          const answer = $(this).find('input[type="radio"]:checked').val() || $(this).find('input[type="text"]').val();
          answers[questionId] = answer;
        });
        console.log(answers);
        alert('Quiz submitted! Check console for answers.');
      });
    });
  </script>
</body>
</html>
