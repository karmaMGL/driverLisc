@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image Upload Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .image-upload {
      width: 100%;
      max-width: 300px;
      height: 200px;
      border: 2px dashed #ccc;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      position: relative;
      background-size: cover;
      background-position: center;
      background-color: #f8f9fa;
      margin-bottom: 15px; /* Added margin for spacing */
    }

    .image-upload input {
      display: none;
    }

    .image-upload-label {
      color: #888;
      font-size: 16px;
      text-align: center;
      position: absolute;
    }
  </style>
</head>
<body>
  <div class="container mt-5">

    <h2>Image Upload Form Example</h2>
    <form action="{{route('roadsign.upload')}}" method="post" enctype="multipart/form-data">
        @csrf
      <!-- Name input -->
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
      </div>

      <!-- Photo upload with preview as background -->
      <div class="mb-3">
        <label class="form-label">Upload Photo</label>
        <div class="image-upload" id="imageUpload" onclick="document.getElementById('photo').click();">
          <span class="image-upload-label" id="imageLabel">Click to upload an image</span>
          <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)" required>
        </div>
      </div>

      <!-- Explanation text -->
      <div class="mb-3">
        <label for="explanation" class="form-label">Explanation</label>
        <textarea class="form-control" id="explanation" name="explanation" rows="4" placeholder="Enter your explanation here" required></textarea>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const imageUpload = document.getElementById('imageUpload');

      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          // Set the background of the image upload div to the selected image
          imageUpload.style.backgroundImage = `url(${e.target.result})`;
          imageUpload.querySelector('.image-upload-label').style.display = 'none'; // Hide the label
        };

        reader.readAsDataURL(file);
      }
    }
  </script>
</body>
</html>
@endsection
