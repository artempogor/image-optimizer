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
        if (xhr.status >= 200 && xhr.status < 300) {
            var response = JSON.parse(xhr.responseText);

            document.getElementById('preview').innerHTML = '<h1>До обработки:</h1> <br> <h2>Размер: ' + response.size_file_preview + ' байт</h2></br>';
            document.getElementById('after').innerHTML = '<h1>После обработки:</h1><br> <h2>Размер: ' + response.size_file_after + 'байт</h2></br>';

            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                document.getElementById('preview').appendChild(img);
            };

            if (response.path) {
                var imgAfter = document.createElement('img');
                imgAfter.src = response.path;
                document.getElementById('after').appendChild(imgAfter);
                reader.readAsDataURL(file);
            } else if (xhr.status === 403) {
                alert('Неверный service-key!');
            } else if (xhr.status === 402) {
                alert(JSON.parse(xhr.responseText).image);
            } else if (xhr.status === 500) {
                alert('Не удалось сжать файл, попробуйте позже!');
            }
        }
    };

    xhr.send(formData);
});
