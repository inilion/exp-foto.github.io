<form action="/add_music.php" method="post" enctype="multipart/form-data">


   <div>
       <label for="title">Название</label>
        <input type="text" id="title" name="title" placeholder="">
    </div>
    <div>
        <label for="music">Файл</label>
        <input type="file" id="music" name="music" multiple accept="audio/*,image/*">
    </div>
    <input type="submit" value="Загрузить">
</form>
