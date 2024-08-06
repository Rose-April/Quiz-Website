<?php
include 'config.php';

$quiz_id = 1; // Assuming quiz ID is 1 for World War II Knowledge Quiz

$sql = "SELECT * FROM questions WHERE quiz_id = $quiz_id";
$result = $conn->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question = [
            'id' => $row['id'],
            'question' => $row['question'],
            'type' => $row['type'],
            'answer' => $row['answer'],
            'options' => [],
            'matches' => []
        ];

        if ($row['type'] == 'multiple_choice') {
            $question_id = $row['id'];
            $sql_options = "SELECT * FROM options WHERE question_id = $question_id";
            $result_options = $conn->query($sql_options);

            if ($result_options->num_rows > 0) {
                while ($option_row = $result_options->fetch_assoc()) {
                    $question['options'][] = $option_row['option_text'];
                }
            }
        }

        if ($row['type'] == 'matching') {
            $question_id = $row['id'];
            $sql_matches = "SELECT * FROM matches WHERE question_id = $question_id";
            $result_matches = $conn->query($sql_matches);

            if ($result_matches->num_rows > 0) {
                while ($match_row = $result_matches->fetch_assoc()) {
                    $question['matches'][] = [
                        'match_text' => $match_row['match_text'],
                        'match_pair' => $match_row['match_pair']
                    ];
                }
            }
        }

        $questions[] = $question;
    }
}

echo json_encode($questions);

$conn->close();
?>
