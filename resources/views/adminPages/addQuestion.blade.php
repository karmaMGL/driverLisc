@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Question</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let optionsContainer = document.getElementById('optionsContainer');
            let addOptionButton = document.getElementById('addOptionButton');
            let correctAnswerSelect = document.getElementById('correctAnswer');

            addOptionButton.addEventListener('click', function (e) {
                e.preventDefault();
                let optionCount = optionsContainer.children.length;
                let newOption = document.createElement('div');
                newOption.classList.add('mb-4');
                newOption.innerHTML = `
                    <label for="option_${optionCount}" class="block text-gray-700 text-sm font-bold mb-2">Option ${optionCount}</label>
                    <input type="text" id="option_${optionCount}" name="options[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                `;
                optionsContainer.appendChild(newOption);
                updateCorrectAnswerDropdown();
            });

            function updateCorrectAnswerDropdown() {
                correctAnswerSelect.innerHTML = '<option value="" disabled selected>Select the correct answer</option>';
                let options = document.querySelectorAll('input[name="options[]"]');
                options.forEach((option, index) => {
                    let optionValue = option.value || `Option ${index + 1}`;
                    let newOption = document.createElement('option');
                    newOption.value = optionValue;
                    newOption.text = optionValue;
                    correctAnswerSelect.appendChild(newOption);
                });
            }

            document.getElementById('optionsContainer').addEventListener('input', updateCorrectAnswerDropdown);
        });
    </script>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        <a href="{{route('AddSectionPage')}}">Add Section</a>
        <h1 class="text-2xl font-bold mb-4">Add Question</h1>
        <form action="{{route('StoreQuestionFunc')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-4">
                <legend class="text-lg font-semibold text-gray-700">Question Details</legend>

                <div class="mb-4">
                    <label for="sectionNumberSelected" class="block text-gray-700 text-sm font-bold mb-2">Section Number Selected</label>
                    <select id="sectionNumberSelected" name="sectionNumberSelectedId"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="" disabled selected>Select a section</option>
                        @foreach($data as $section)
                            <option value="{{ $section->id }}">{{ $section->SectionNumber }} {{ $section->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" id="title" name="title"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           required aria-label="Title">
                </div>

                <div id="optionsContainer" class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Options</label>
                    <div class="mb-4">
                        <label for="option_1" class="block text-gray-700 text-sm font-bold mb-2">Option 1</label>
                        <input type="text" id="option_1" name="options[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                </div>
                <button id="addOptionButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">Add Option</button>

                <div class="mb-4">
                    <label for="correctAnswer" class="block text-gray-700 text-sm font-bold mb-2">Correct Answer</label>
                    <select id="correctAnswer" name="correctAnswer" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="" disabled selected>Select the correct answer</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="imagePath" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                    <input type="file" id="imagePath" name="imagePath" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="why" class="block text-gray-700 text-sm font-bold mb-2">Why</label>
                    <textarea id="why" name="why" rows="4"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              required aria-label="Explanation of Correct Answer"></textarea>
                </div>
            </fieldset>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
        </form>
    </div>
</body>
</html>

@endsection
