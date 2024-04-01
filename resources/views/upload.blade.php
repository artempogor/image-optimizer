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
        Степень сжатия изображения:
        <select>
            <option id="optimize_level" value="10">Жесткая</option>
            <option id="optimize_level" value="50">Средняя</option>
            <option id="optimize_level" value="90">Слабая</option>
        </select>
    </label>
    <br>

    <input type="submit" value="Сжать"/>
</form>

<div id="preview">
</div>
<div id="after">
</div>
</body>
<script type="text/javascript" src="/js/upload.js"></script>
</html>