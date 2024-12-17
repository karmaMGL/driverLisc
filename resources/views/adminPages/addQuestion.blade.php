@section('content')

<title>Add Question</title>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4 fw-bold">Add Question</h1>
        <form id="questionForm" class="bg-white p-4 rounded shadow" action="{{ route('StoreQuestionFunc') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <!-- Section Select -->
            <div class="mb-3">
                <label for="sectionId" class="form-label fw-bold">Section</label>
                <select id="sectionId" name="SectionIDSelected" class="form-select" required>
                    <option value="">Select a section</option>
                </select>
            </div>

            <!-- Question Title -->
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Question Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter the question title" required>
            </div>

            <!-- Options -->
            <div id="optionsContainer" class="mb-3">
                <div class="mb-2 d-flex align-items-center">
                    <label class="form-label me-2">Option 1</label>
                    <input type="text" name="options[]" class="form-control me-2" placeholder="Enter option 1" required>
                    <button type="button" class="btn btn-danger btn-sm removeOption d-none">Remove</button>
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <label class="form-label me-2">Option 2</label>
                    <input type="text" name="options[]" class="form-control me-2" placeholder="Enter option 2" required>
                    <button type="button" class="btn btn-danger btn-sm removeOption d-none">Remove</button>
                </div>
            </div>
            <button type="button" id="addOptionBtn" class="btn btn-success mb-3">Add Option</button>

            <!-- Correct Answer -->
            <div class="mb-3">
                <label for="correctAnswer" class="form-label fw-bold">Correct Answer</label>
                <select id="correctAnswer" name="correctAnswer" class="form-select" required>
                    <option value="">Select the correct answer</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Image (Optional)</label>
                <input type="file" id="image" name="imagePath" accept="image/*" class="form-control">
            </div>

            <!-- Explanation -->
            <div class="mb-3">
                <label for="explanation" class="form-label fw-bold">Explanation</label>
                <textarea id="explanation" name="why" rows="4" class="form-control" placeholder="Explain why this is the correct answer" required></textarea>
            </div>
            {{-- <input type="hidden" name="SectionIDSelected" value="{{$data}}"> --}}
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Question</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('questionForm');
            const optionsContainer = document.getElementById('optionsContainer');
            const addOptionBtn = document.getElementById('addOptionBtn');
            const correctAnswerSelect = document.getElementById('correctAnswer');
            const sectionSelect = document.getElementById('sectionId');

            // Populate sections dynamically from Blade $data
            const sections = @json($data); // Blade data passed here
            sections.forEach(section => {
                const option = document.createElement('option');
                option.value = section.id;
                option.textContent = `${section.SectionNumber} ${section.title}`;

                sectionSelect.appendChild(option);
            });

            // Add new option dynamically
            addOptionBtn.addEventListener('click', function () {
                const optionCount = optionsContainer.children.length + 1;
                const newOption = document.createElement('div');
                newOption.classList.add('mb-2', 'd-flex', 'align-items-center');
                newOption.innerHTML = `
                    <label class="form-label me-2">Option ${optionCount}</label>
                    <input type="text" name="options[]" class="form-control me-2" placeholder="Enter option ${optionCount}" required>
                    <button type="button" class="btn btn-danger btn-sm removeOption">Remove</button>
                `;
                optionsContainer.appendChild(newOption);
                updateCorrectAnswerDropdown();
            });

            // Remove option and update correct answer dropdown
            optionsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('removeOption')) {
                    e.target.parentElement.remove();
                    updateCorrectAnswerDropdown();
                }
            });

            // Update Correct Answer Dropdown
            function updateCorrectAnswerDropdown() {
                correctAnswerSelect.innerHTML = '<option value="">Select the correct answer</option>';
                const options = document.querySelectorAll('input[name="options[]"]');
                options.forEach((option, index) => {
                    const newOption = document.createElement('option');
                    newOption.value = option.value || `Option ${index + 1}`;
                    newOption.textContent = option.value || `Option ${index + 1}`;
                    correctAnswerSelect.appendChild(newOption);
                });
            }

            // Update dropdown on input change
            optionsContainer.addEventListener('input', updateCorrectAnswerDropdown);

            // Handle form submission via AJAX
            // form.addEventListener('submit', async function (e) {
            //     e.preventDefault();
            //     const formData = new FormData(form);
            //     formData.append('options', JSON.stringify(Array.from(document.querySelectorAll('input[name="options[]"]')).map(input => input.value)));

            //     try {
            //         const response = await fetch(form.action, {
            //             method: 'POST',
            //             headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            //             body: formData
            //         });

            //         if (response.ok) {
            //             const result = await response.json();
            //             alert('Question submitted successfully!');
            //             console.log(result);
            //         } else {
            //             alert('Failed to submit question.');
            //         }
            //     } catch (error) {
            //         console.error('Error:', error);
            //         alert('An error occurred.');
            //     }
            // });
        });
    </script>
</body>

@endsection
