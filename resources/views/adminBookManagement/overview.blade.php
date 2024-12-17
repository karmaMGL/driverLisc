<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2>Document Sections</h2>
        <table id="section-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Document Title</th>
                    <th>Section Number</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $document->title }}</td>
                        <td>{{ $section->section_number }}</td>
                        <td>{{ $section->title ?? '-' }}</td>
                        <td>
                            <a href="{{ route('section.edit', ['id' => $section->id]) }}">Edit</a>
                            |
                            <form action="{{ route('section.delete', ['id' => $section->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Create New Section Form -->
        <div class="form-group">
            <label for="section_number">Section Number:</label>
            <input type="text" id="section_number" name="section_number" required>
        </div>
        <button id="create-section-btn" type="button" onclick="createNewSection()">Create Section</button>

        <!-- Update Existing Section Form -->
        @if ($editing)
            <form id="update-section-form">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="section_number">Section Number:</label>
                    <input type="text" id="section_number_update" name="section_number" required value="{{
    $editing->section_number }}">
                </div>
                <button id="update-section-btn" type="submit">Update Section</button>
            </form>
        @endif
    </div>

    <!-- Modal for Confirmation Dialog -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this section?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('section.delete', ['id' => $section->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create New Section JavaScript -->
    <script>
        function createNewSection() {
            // Implement logic to create a new section
            // ...
        }
    </script>
</body>
</html>
