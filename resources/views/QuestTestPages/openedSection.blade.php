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
            <p>Correct Answers: <span id="correct-count">0</span></p>
            <p>Incorrect Answers: <span id="incorrect-count">0</span></p>
        </div>
        <div class="progress-grid">
            <h3>Progress</h3>
            <div id="progress-container"></div>
        </div>
    </div>

    <div class="main-content">
        <div class="quiz-container">
            @php $counter = 0; @endphp
            @foreach ($datas as $data)
                @php $counter++; @endphp
                <div class="question-card" id="question-{{$counter}}">
                    <div class="question-number">Question {{$counter}}</div>
                    <div class="question-title">{{$data->Title}}</div>
                    @isset($data->ImagePath)
                        <img class="question-image" src=" {{asset($data->ImagePath)}}" alt="Question Image">
                    @endisset
                    <div class="options-grid">
                        @php
                            $options = json_decode($data->Options, true);
                        @endphp
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
                                <button class="option-button" onclick='checkAnswer({{$counter}}, "{{$item}}", "{{$data->CorrectAnswer}}","{{$data->id}}")'>{{$item}}</button>
                            @endforeach
                        @endif
                    </div>
                    <div class="feedback" id="feedback-{{$counter}}"></div>
                    <div class="explanation" id="explanation-{{$counter}}" style="display: none;">
                        <strong>Correct answer:</strong> {{$data->CorrectAnswer}}<br>
                        <strong>Explanation:</strong> {{$data->Why}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        let correctCount = 0;
        let incorrectCount = 0;

        // Initialize the progress grid with the total number of questions
        initializeProgressGrid({{ count($datas) }});
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

            function checkAnswer(questionNumber, selectedAnswer, correctAnswer,questID) {
            const questionCard = document.getElementById(`question-${questionNumber}`);
            const feedbackElement = document.getElementById(`feedback-${questionNumber}`);
            const explanationElement = document.getElementById(`explanation-${questionNumber}`);
            const optionButtons = document.querySelectorAll(`#question-${questionNumber} .option-button`);
            const progressItem = document.getElementById(`progress-item-${questionNumber}`);

            optionButtons.forEach(button => {
                button.disabled = true;
                if (button.textContent === selectedAnswer) {
                    button.style.backgroundColor = selectedAnswer === correctAnswer ? '#28a745' : '#dc3545';
                    button.style.color = '#ffffff';
                } else if (button.textContent === correctAnswer) {
                    button.style.backgroundColor = '#28a745';
                    button.style.color = '#ffffff';
                }
            });
            let baseCorrectAnswerUrl = "{{ route('correctAnswered', [Auth::guard('Member')->check() ? Auth::guard('Member')->id() : '0', $SectionID, ':selectedAnswer',':questID']) }}";

            let baseCorrectAnswerUrl11 = baseCorrectAnswerUrl.replace(':selectedAnswer', selectedAnswer);
            let correctAnswerUrl = baseCorrectAnswerUrl11.replace(':questID', questID);


            let baseCorrectAnswerUrl2 = "{{ route('incorrectAnswered', [Auth::guard('Member')->check() ? Auth::guard('Member')->id() : '0', $SectionID, ':selectedAnswer',':questID']) }}";
            let baseCorrectAnswerUrl22 = baseCorrectAnswerUrl2.replace(':selectedAnswer', selectedAnswer);
            incorrectAnswerUrl = baseCorrectAnswerUrl22.replace(':questID', questID);



            let url = selectedAnswer === correctAnswer ? correctAnswerUrl : incorrectAnswerUrl;
            let data = { questionNumber: questionNumber, selectedAnswer: selectedAnswer };

            if (selectedAnswer !== correctAnswer) {
                data.correctAnswer = correctAnswer;
            }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Handle the response data here if needed
            })
            .catch(error => {
                console.error('Error:', error);
            });

            if (selectedAnswer === correctAnswer) {
                feedbackElement.innerHTML = "Correct!";
                feedbackElement.className = "feedback correct";
                questionCard.classList.add('correct');
                correctCount++;
                progressItem.classList.remove('default');
                progressItem.classList.add('correct');
            } else {
                feedbackElement.innerHTML = "Incorrect. The correct answer is: " + correctAnswer;
                feedbackElement.className = "feedback incorrect";
                incorrectCount++;
                progressItem.classList.remove('default');
                progressItem.classList.add('incorrect');
            }

            explanationElement.style.display = "block";
            updatePerformance();
        }



        function updatePerformance() {
            document.getElementById('correct-count').textContent = correctCount;
            document.getElementById('incorrect-count').textContent = incorrectCount;
        }

        // Set current date
        const currentDate = new Date().toLocaleDateString();
        document.getElementById('current-date').textContent = currentDate;
    </script>

    @include('QuestTestPages.layout.fooder')
    @yield('footer')
</body>
</html>
