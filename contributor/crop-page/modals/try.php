<!DOCTYPE html>
<html>
<head>
    <title>Multiple Image Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .image-preview {
            position: relative;
            display: inline-block;
            margin-right: 10px;
        }

        .remove-image {
            position: absolute; 
            top: 0;
            right: 0;
            background: none;
            border: none;
            color: red;
            font-weight: bold;
            cursor: pointer;
        }

        .image-preview img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <button type="submit" name="submit">Upload</button>
    </form>
    <div id="preview"></div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (isset($_FILES["images"]["name"])) {
        $count = count($_FILES["images"]["name"]);
        for ($i = 0; $i < $count; $i++) {
            $file_name = $_FILES["images"]["name"][$i];
            $file_tmp = $_FILES["images"]["tmp_name"][$i];
            $file_type = $_FILES["images"]["type"][$i];
            $file_size = $_FILES["images"]["size"][$i];
            if ($file_size > 0) {
                $upload_dir = "img/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                // Process the image upload
                $destination = $upload_dir . $file_name;
                move_uploaded_file($file_tmp, $destination);
            }
        }
    }
}
?>

<script>
    $(document).ready(function() {
        $('input[type="file"]').on("change", function() {
            var files = $(this)[0].files;
            $('#preview').empty();
            $.each(files, function(i, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').append('<div class="image-preview"><img src="' + e.target.result + '" width="100"/><button class="remove-image" data-index="' + i + '">x</button></div>');
                }
                reader.readAsDataURL(file);
            });
        });

        $(document).on("click", ".remove-image", function() {
            var index = $(this).data("index");
            var input = $('input[type="file"]')[0];
            var files = input.files;
            var newFiles = [];
            for (var i = 0; i < files.length; i++) {
                if (i !== index) {
                    newFiles.push(files[i]);
                }
            }
            var dataTransfer = new DataTransfer();
            newFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            $(this).parent().remove();
        });
    });
</script>
