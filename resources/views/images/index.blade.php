<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
    <style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
        }
        .image-item {
            margin: 10px;
            text-align: center;
        }
        img {
            max-width: 200px; /* Limit the image size */
            max-height: 150px; /* Limit the image height */
        }
    </style>
</head>
<body>
    <h1>Uploaded Images</h1>
    <a href="{{ route('imagez.create') }}">Upload New Image</a>

    <div class="image-container">
        @foreach ($images as $image)
            <div class="image-item">
                <img src="{{ asset('images/' . $image->image) }}" alt="{{ $image->title }}">
            </div>
        @endforeach
    </div>
</body>
</html>
