<!DOCTYPE html>
<html>
<head>
    <title>File Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="file"], input[type="text"], input[type="submit"] {
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #preview {
            margin-top: 20px;
        }

        #preview img {
            max-width: 50%;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #after {
            margin-top: 20px;
        }

        #after img {
            max-width: 50%;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<form id="uploadForm" enctype="multipart/form-data">
    <input type="file" accept="image/png, image/jpeg" name="file" id="file"/>
    <br>
    <label>
        Service-Key :
        <input type="text" name="Service-Key" value="cee6f0f0-2df3-46c2-98fb-679cdc2812ee" id="header"/>
    </label>
    <br>
    <label>
        Optimize-Level :
        <input type="text" name="Optimize-Level" value="50" id="optimize_level"/>
    </label>
    <br>

    <input type="submit" value="Сжать"/>
</form>

<div id="preview">
    <div id="preview-text">
    </div>
</div>


<div id="after">
    <div id="after-text">
    </div>
</div>

<script>
    document.getElementById('uploadForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var form = document.getElementById('uploadForm');
        var file = form.querySelector("#file").files[0];
        var headerValue = form.querySelector('#header').value;
        var optimizeLevel = form.querySelector('#optimize_level').value;

        if (!file) {
            alert('Нужно прикрепить файл');
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/optimize', true);
        xhr.setRequestHeader('service-key', headerValue);

        var formData = new FormData();
        formData.append('image', file);
        formData.append('optimize_level', optimizeLevel);

        xhr.onload = function () {
            if (xhr.status === 200 && file) {
                document.getElementById('after-text').innerHTML = '<h1>После обработки:</h1>';
                document.getElementById('preview-text').innerHTML = '<h1>До обработки:</h1>';

                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    document.getElementById('preview').append(img);
                }

                var response = JSON.parse(xhr.responseText);
                var img = document.createElement('img');
                img.src = response.path;
                document.getElementById('after').append(img);

                reader.readAsDataURL(file);
            }

            if(xhr.status === 403) {
                alert('Неверный service-key!')
            }

            if(xhr.status === 500) {
                alert('Не удалось сжать файл, попробуйте позже!')
            }
        };

        xhr.send(formData);
    });
</script>
</body>
</html>