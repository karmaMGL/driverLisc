<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Driving Test Portal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Sticky Sidebar */
            .sidebar {
                position: sticky;
                top: 3rem; /* Keeps some space from the top */
                background-color: #fff;
                height: 100vh;
                border-right: 1px solid #eee;
                overflow-y: auto;

            }

            /* Sticky Navbar */
            .navbar {
                position: sticky;
                top: 0;
                z-index: 1030; /* Ensures it stays above other elements */
            }

            .nav-link {
                color: #666;
                padding: 0.8rem 1rem;
            }

            .nav-link:hover {
                background-color: #f8f9fa;
            }

            .progress {
                height: 0.5rem;
            }

            .question-container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }

            .answer-option {
                border: 1px solid #dee2e6;
                border-radius: 4px;
                padding: 1rem;
                margin-bottom: 1rem;
                cursor: pointer;
                transition: all 0.2s;
            }

            .answer-option:hover {
                background-color: #f8f9fa;
            }

            .performance-card {
                background-color: #fff;
                border-radius: 8px;
                padding: 1.5rem;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);

                position: sticky;
                top: 4rem; /* Keeps some space from the top */
            }

            .correct-answers {
                color: #198754;
            }

            .wrong-answers {
                color: #dc3545;
            }
        </style>
    </head>
    <body class="bg-light">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="{{route('main')}}">Driving Test Portal</a>
                @guest('Member')
                <a href="{{route('login')}}"><button class="btn btn-dark">Login</button></a>
                @endguest
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Хайх" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Хайх</button>
                  </form>
                @auth('Member')
                <div class="dropdown show">
                    <div class="dropdown">
                        <span>Эргээд тавтай морил</span>
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{Auth::guard('Member')->user()->name}}
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Profile</a></li>
                          <li><a class="dropdown-item" href="#">Settings</a></li>
                          <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                      </div>
                  </div>
                    {{-- <a href="{{route('MemberDashboard')}}"><button class="btn btn-dark">Profile</button></a> --}}
                @endauth
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-2 sidebar p-0">
                    <div class="nav flex-column">
                        <a class="nav-link active" href="{{route('MemberDashboard')}}">Dashboard</a>
                        <a class="nav-link" href="{{route('exam.section')}}">Exams</a>
                        <a class="nav-link" href="{{route('main.test')}}">Tests</a>
                        <a class="nav-link" href="{{route('roadSigns')}}">Road Signs</a>
                        <a class="nav-link" href="{{route('member.game')}}">Simulations</a>
                        <a class="nav-link" href="{{route('MemberDashboard')}}">Study Materials</a>
                        <a class="nav-link" href="#">Personal Exam</a>
                    </div>
                </div>
                @php $counter = 1; @endphp

                <!-- Main Content -->
                <div class="col-7 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Хэсэг {{$SectionID}}: {{$sectionTitle}}</h2>
                        <div class="d-flex align-items-center">
                            <span class="me-3">Progress</span>
                            <div class="progress" style="width: 100px;">
                                <div id="main-progress-bar" class="progress-bar bg-dark" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    @foreach ($datas as $data)

                    <div id="question-{{$counter}}" class="question-container p-4">
                        <h5 class="mb-4">Асуулт {{$counter}}</h5>
                        <p class="text-secondary mb-4">{{$data->Title}}</p>
                        @isset($data->ImagePath)
                        <div class="image-placeholder d-flex align-items-center justify-content-center" style="height: 300px; background: url('{{asset($data->ImagePath)}}') center/contain no-repeat;"></div>
                        @endisset
                        <div class="answers mt-4">
                            @php
                                $options = json_decode($data->Options, true);
                                shuffle($options);
                            @endphp
                            @foreach ($options as $item)
                            <div class="answer-option" onclick='checkAnswer({{$counter}}, "{{$item}}", "{{$data->CorrectAnswer}}")'>
                                {{$item}}
                            </div>
                            @endforeach
                            <div class="feedback" id="feedback-{{$counter}}"></div>
                            <div class="explanation" id="explanation-{{$counter}}" style="display: none;">
                                <strong>Correct answer:</strong> {{$data->CorrectAnswer}}<br>
                                <strong>Explanation:</strong> {{$data->Why}}
                            </div>
                        </div>
                    </div>
                    @php $counter++; @endphp <br>
                    @endforeach
                </div>

                <!-- Right Sidebar -->
                <div class="col-3 p-4">
                    <div class="performance-card">
                        <h4 class="mb-4">Гүйцэтгэл</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Зөв хариулсан </span>
                            <span id="correct-count" class="correct-answers fw-bold">0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Буруу хариулсан</span>
                            <span id="incorrect-count" class="wrong-answers fw-bold">0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Үлдсэн</span>
                            <span id="remaining-count" class="fw-bold">{{ count($datas) }}</span>
                        </div>
                        <div class="progress mt-4">
                            <div id="sidebar-progress-bar" class="progress-bar bg-dark" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($questID)
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    const questID = {{$questID}}; // Get the questID passed from PHP
                    const questionElement = document.getElementById(`question-${questID}`); // Find the element by ID

                    if (questionElement) {
                        questionElement.scrollIntoView({ behavior: 'smooth', block: 'start' }); // Scroll to the question
                    }
                });
            </script>
        @endisset

        <script>
            let correctCount = 0;
            let incorrectCount = 0;
            const totalQuestions = {{ count($datas) }};
            const progressBar = document.getElementById('main-progress-bar');
            const sidebarProgressBar = document.getElementById('sidebar-progress-bar');
            const correctCountElement = document.getElementById('correct-count');
            const incorrectCountElement = document.getElementById('incorrect-count');
            const remainingCountElement = document.getElementById('remaining-count');

            // Update performance and progress
            function updateProgress() {
                const answeredCount = correctCount + incorrectCount;
                const progressPercentage = (answeredCount / totalQuestions) * 100;

                // Update progress bars
                progressBar.style.width = `${progressPercentage}%`;
                sidebarProgressBar.style.width = `${progressPercentage}%`;

                // Update counts
                remainingCountElement.textContent = totalQuestions - answeredCount;
                correctCountElement.textContent = correctCount;
                incorrectCountElement.textContent = incorrectCount;
            }

            // Check answer and provide feedback
            function checkAnswer(questionNumber, selectedAnswer, correctAnswer) {
                const feedbackElement = document.getElementById(`feedback-${questionNumber}`);
                const explanationElement = document.getElementById(`explanation-${questionNumber}`);

                if (selectedAnswer === correctAnswer) {
                    feedbackElement.innerHTML = "<strong class='text-success'>Correct!</strong>";
                    correctCount++;
                } else {
                    feedbackElement.innerHTML = `<strong class='text-danger'>Incorrect!</strong> Correct answer: ${correctAnswer}`;
                    incorrectCount++;
                }

                explanationElement.style.display = "block";
                updateProgress();

                // Disable further clicks on options
                document.querySelectorAll(`#question-${questionNumber} .answer-option`).forEach(option => {
                    option.style.pointerEvents = 'none';
                });
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
