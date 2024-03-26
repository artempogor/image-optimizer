<html>
<body>
<h1>Количество оптимизированных файлов : {{$statistic->count}}</h1>
<h1>Мегабайт оптимизировано : {{$statistic->bytesSummary}}</h1>
<a href={{url('upload') }}>Сжать файл</a>
</body>
</html>