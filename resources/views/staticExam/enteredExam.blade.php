<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Interactive Quiz with Calendar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
        }
        .sidebar {
            width: 300px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 80px; /* Adjust this value to control the distance from the top */
            height: calc(100vh - 80px); /* Adjust height to fit with top spacing */
            overflow-y: auto; /* Scroll if content is too tall */
        }

        .calendar {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .performance {
            background-color: #e9ecef;
            border-radius: 8px;
            padding: 15px;
        }
        .progress-grid {
            margin-top: 20px;
            position: sticky;
            top: 120px;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        #progress-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(30px, 1fr));
            gap: 10px;
            text-align: center;
        }

        .progress-item {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ced4da; /* Default color */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            color: #fff;
        }

        .progress-item.correct {
            background-color: #28a745; /* Green for correct */
        }

        .progress-item.incorrect {
            background-color: #dc3545; /* Red for incorrect */
        }

        .progress-item.default {
            background-color: #6c757d; /* Gray for unanswered */
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .question-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        .question-card.correct {
            background-color: #d4edda;
        }
        .question-number {
            font-size: 1.2em;
            color: #007bff;
            margin-bottom: 15px;
        }
        .question-title {
            font-size: 1.4em;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .question-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .option-button {
            padding: 12px 20px;
            background-color: #f8f9fa;
            color: #495057;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1em;
            font-weight: 500;
        }
        .option-button:hover {
            background-color: #e9ecef;
            border-color: #ced4da;
        }
        .option-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
        }
        .feedback {
            margin-top: 15px;
            font-weight: 600;
            font-size: 1.1em;
        }
        .correct {
            color: #ffffff;
        }
        .incorrect {
            color: #ffffff;
        }
        .explanation {
            margin-top: 15px;
            background-color: #e9ecef;
            border-radius: 8px;
            padding: 15px;
            font-style: italic;
            color: #495057;
        }
        .option-button.selected {
            background-color: #007bff; /* Highlight selected answer */
            color: white;
        }
        .option-button.correct {
            background-color: #28a745; /* Green for correct */
            color: white;
        }
        .option-button.incorrect {
            background-color: #dc3545; /* Red for incorrect */
            color: white;
        }
    </style>
</head>
<body>
    @include('QuestTestPages.layout.layout')
    @yield('layout')

    <div class="sidebar">
        <div class="calendar">
            <h3>Calendar</h3>
            <p>Current Date: <span id="current-date"></span></p>
        </div>
        <div class="performance">

            <h3>Your Performance</h3>
            <div id="exam-results"></div>

            {{-- <p>Correct Answers: <span id="correct-count">0</span></p>
            <p>Incorrect Answers: <span id="incorrect-count">0</span></p> --}}
        </div>
        <div class="progress-grid">
            <h3>Progress</h3>
            <div id="progress-container"></div>
        </div>
    </div>

    <div class="main-content">
        <div class="quiz-container">
            <h3>Time Remaining: <span id="timer">20:00</span></h3>

            @php $counter = 0; @endphp
            @foreach ($examQuests as $quest)
                @php $counter++; @endphp
                <div class="question-card" id="question-{{$counter}}">
                    <div class="question-number">Question {{$counter}}</div>
                    <div class="question-title">{{$quest->Title}}</div>
                    @isset($quest->ImagePath)
                        <img class="question-image" src="{{ asset($quest->ImagePath) }}" alt="Question Image">
                    @endisset
                    <div class="options-grid">
                        @php $options = json_decode($quest->Options, true); @endphp
                        @if (is_array($options))
                            @php
                                $randomized = $options;
                                for ($i=0; $i < count($randomized)-1; $i++) {
                                    $num = rand(0,count($randomized)-1);
                                    $temp = $randomized[$i];
                                    $randomized[$i] = $randomized[$num];
                                    $randomized[$num]  = $temp;
                                }
                            @endphp
                            @foreach ($randomized as $item)
                                <button class="option-button" onclick='selectAnswer({{$counter}}, "{{$item}}", "{{$quest->CorrectAnswer}}", this)'>{{$item}}</button>
                            @endforeach
                        @endif
                    </div>
                    <div class="feedback" id="feedback-{{$counter}}" style="display:none;"></div>
                    <div class="explanation" id="explanation-{{$counter}}" style="display: none;">
                        <strong>Correct answer:</strong> {{$quest->CorrectAnswer}}<br>
                        <strong>Explanation:</strong> {{$quest->Why}}
                    </div>
                </div>
            @endforeach
            <button id="submit-button" class="option-button">Submit Exam</button>
        </div>
    </div>

    <script>
        let correctCount = 0;
        let incorrectCount = 0;
        let timer;

        // Initialize the progress grid with the total number of questions
        initializeProgressGrid({{ count($examQuests) }});

        function initializeProgressGrid(totalQuestions) {
            const progressContainer = document.getElementById('progress-container');
            for (let i = 1; i <= totalQuestions; i++) {
                const progressItem = document.createElement('div');
                progressItem.classList.add('progress-item', 'default');
                progressItem.id = `progress-item-${i}`;
                progressItem.textContent = i; // Add the question number
                progressContainer.appendChild(progressItem);
            }
        }

        // Start the 20-minute timer
        startTimer(20 * 60); // 20 minutes in seconds

        function startTimer(duration) {
            let timerDisplay = document.getElementById('timer');
            let timeRemaining = duration;

            timer = setInterval(function () {
                let minutes = Math.floor(timeRemaining / 60);
                let seconds = timeRemaining % 60;

                timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                timeRemaining--;

                if (timeRemaining < 0) {
                    clearInterval(timer);
                    submitExam(); // Automatically submit when time runs out
                }
            }, 1000);
        }

        function selectAnswer(questionNumber, selectedAnswer, correctAnswer, button) {
            // Remove previous selection
            document.querySelectorAll(`#question-${questionNumber} .option-button`).forEach(btn => {
                btn.classList.remove('selected');
            });

            // Highlight the selected option
            button.classList.add('selected');
        }

        // Function to handle the submission of the exam
        function submitExam() {
            const selectedAnswers = [];

            document.querySelectorAll('.question-card').forEach((card, index) => {
                const selectedOption = card.querySelector('.option-button.selected'); // Find selected option
                selectedAnswers.push({
                    questionNumber: index + 1, // Use 1-based index
                    selectedAnswer: selectedOption ? selectedOption.textContent : ''
                });
            });

            // Submit the answers via AJAX to the Laravel controller
            fetch('/submit-exam', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ answers: selectedAnswers ,examid:@json($examData->id)}) // Ensure the correct structure
            })
            .then(response => response.json())
            .then(data => {
                displayResults(data.results); // Adjusted to use data.results
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        // Submit button click event listener
        document.getElementById('submit-button').addEventListener('click', function() {
            clearInterval(timer); // Stop the timer if manually submitted
            submitExam();
        });

        // Display results after submission
        function displayResults(results) {
            let incorrectCount = 0; // Initialize the correct answers count
            let correctCount =0;
            results.forEach((result, index) => {
                const feedbackElement = document.getElementById(`feedback-${index + 1}`);
                const progressItem = document.getElementById(`progress-item-${index + 1}`);
                const explanationElement = document.getElementById(`explanation-${index + 1}`);

                // Display feedback based on result
                if (result.correct) {
                    feedbackElement.innerHTML = "Correct!";
                    feedbackElement.className = "feedback correct";
                    feedbackElement.style.display = "block";
                    progressItem.classList.remove('default');
                    progressItem.classList.add('correct');
                    document.querySelector(`#question-${index + 1} .option-button.selected`).classList.add('correct'); // Highlight correct option
                    correctCount++;
                } else {
                    feedbackElement.innerHTML = "Incorrect!";
                    feedbackElement.className = "feedback incorrect";
                    feedbackElement.style.display = "block";
                    progressItem.classList.remove('default');
                    progressItem.classList.add('incorrect');
                    document.querySelector(`#question-${index + 1} .option-button.selected`).classList.add('incorrect'); // Highlight incorrect option
                    incorrectCount++;
                }
                explanationElement.style.display = "block"; // Show explanation after submission

            });
            const finalResultMessage = `You answered correct ${correctCount}/${results.length} questions. ` +
                               (incorrectCount >= 3 ? "You failed." : "You passed.");
                document.getElementById('exam-results').innerHTML = finalResultMessage;
        }

        // Set current date
        const currentDate = new Date().toLocaleDateString();
        document.getElementById('current-date').textContent = currentDate;

    </script>

    @include('QuestTestPages.layout.fooder')
    @yield('footer')
</body>
</html>
