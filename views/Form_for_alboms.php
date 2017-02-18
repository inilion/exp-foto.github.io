<form action="/add_alboms.php" method="post" enctype="multipart/form-data">


    <div>
        <label for="title">Название Исполнителя</label>
        <input type="text" id="title" name="title_singer" placeholder="">
    </div>

    <div>
        <label for="music">Название Альбома</label>
        <input type="file" id="music" name="music_albom" accept="*/*">
    </div>
    <input type="submit" value="Загрузить">
</form>
