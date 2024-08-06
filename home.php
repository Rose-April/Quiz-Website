<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Javascript Quiz</title>
<link rel="stylesheet" href="style1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>
<style>
    .content {
margin-top: 54px;
}
.header {
padding: 15px;
position: fixed;
top: 0;
width: 100%;
z-index: 9999;
}
.left-title {
width: 80px;
color: #fff;
font-size: 18px;
float: left;
}
.right-title {
width: 150px;
text-align: right;
float: right;
color: #fff;
}
.quiz-body {
margin-top: 15px;
padding-bottom: 50px;
}
.option-block-container {
margin-top: 20px;
max-width: 420px;
}
.option-block {
padding: 10px;
background: aliceblue;
border: 1px solid #84c5fe;
margin-bottom: 10px;
cursor: pointer;
}
.result-question {
font-weight: bold;
}
.c-wrong {
margin-left: 20px;
color: #ff0000;
}
.c-correct {
margin-left: 20px;
color: green;
}
.last-row {
border-bottom: 1px solid #ccc;
padding-bottom: 25px;
margin-bottom: 25px;
}
.res-header {
border-bottom: 1px solid #ccc;
margin-bottom: 15px;
padding-bottom: 15px;
}
    </style>
<body>
<header class="header bg-primary">
<div class="left-title">JS Quiz</div>
<div class="right-title">Total Questions: <span id="tque"></span></div>
<div class="clearfix"></div>
</header>
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div id="result" class="quiz-body">
<form name="quizForm" onSubmit="">
<fieldset class="form-group">
<h4><span id="qid">1.</span> <span id="question"></span></h4>
<div class="option-block-container" id="question-options">
</div> 
</fieldset>
<button name="previous" id="previous" class="btn btn-success">Previous</button>
&nbsp;
<button name="next" id="next" class="btn btn-success">Next</button>
</form>
</div>
</div> 
</div> 
</div> 
</div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="app.js"></script>
</body>
</html>