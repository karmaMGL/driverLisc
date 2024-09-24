@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Question</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const optionsContainer = document.getElementById('optionsContainer');
            const addOptionButton = document.getElementById('addOptionButton');
            const correctAnswerSelect = document.getElementById('correctAnswer');
            const correctAnswerValue = "{{ $data->CorrectAnswer }}"; // Get the correct answer from backend

            // Add new option
            addOptionButton.addEventListener('click', function (e) {
                e.preventDefault();
                const optionCount = optionsContainer.children.length;
                const newOption = document.createElement('div');
                newOption.classList.add('mb-4', 'flex', 'items-center');
                newOption.innerHTML = `
                    <input type="text" id="option_${optionCount}" name="options[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2" placeholder="Option ${optionCount + 1}" required>
                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded removeOptionBtn">X</button>
                `;
                optionsContainer.appendChild(newOption);
                updateCorrectAnswerDropdown();
            });

            // Update correct answer dropdown
            function updateCorrectAnswerDropdown() {
                correctAnswerSelect.innerHTML = '<option value="" disabled>Select the correct answer</option>';
                const options = document.querySelectorAll('input[name="options[]"]');
                options.forEach((option, index) => {
                    const optionValue = option.value || `Option ${index + 1}`;
                    const newOption = document.createElement('option');
                    newOption.value = optionValue;
                    newOption.text = optionValue;
                    correctAnswerSelect.appendChild(newOption);
                });

                // Set the correct answer as selected
                if (correctAnswerValue) {
                    correctAnswerSelect.value = correctAnswerValue;
                }
            }

            // Call the function to update the correct answer dropdown after options are generated
            updateCorrectAnswerDropdown();

            // Update dropdown on input change
            optionsContainer.addEventListener('input', updateCorrectAnswerDropdown);

            // Remove option functionality
            optionsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('removeOptionBtn')) {
                    e.target.parentElement.remove();
                    updateCorrectAnswerDropdown();
                }
            });
        });
    </script>

</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold mb-6 text-center">Update Question</h1>
        <form action="{{route('submitEditQuestion',$data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="sectionNumberSelected" class="block text-gray-700 text-sm font-semibold mb-2">Section</label>
                <select id="sectionNumberSelected" name="sectionNumberSelectedId" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="{{$selectedSection->id}}"  selected>{{$selectedSection->SectionNumber}} - {{$selectedSection->title}}</option>
                    @foreach($section as $one)
                        <option value="{{ $one->id }}">{{ $one->SectionNumber }} - {{ $one->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{$data->Title}}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            @php
                $options = json_decode($data->Options, true);
            @endphp
            <div id="optionsContainer" class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Options</label>
                @foreach ($options as $index => $option)
                    <div class="mb-4 flex items-center">
                        <input type="text" id="option_{{ $index }}" name="options[]" value="{{ $option }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2" required>
                        <button type="button" class="bg-red-500 text-white px-2 py-1 rounded removeOptionBtn">X</button>
                    </div>
                @endforeach
            </div>

            <button id="addOptionButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-6 w-full">Add Option</button>

            <div class="mb-6">
                <label for="correctAnswer" class="block text-gray-700 text-sm font-semibold mb-2">Correct Answer</label>
                <select id="correctAnswer" name="correctAnswer" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="{{ $data->CorrectAnswer }}" selected>{{ $data->CorrectAnswer }}</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="imagePath" class="block text-gray-700 text-sm font-semibold mb-2">Image</label>
                <input type="file" id="imagePath" name="imagePath" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label for="why" class="block text-gray-700 text-sm font-semibold mb-2">Explanation</label>
                <textarea id="why" name="why" rows="4" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{$data->Why}}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Update Question</button>
        </form>
    </div>
</body>
</html>
@endsection
