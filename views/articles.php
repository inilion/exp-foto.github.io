<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Статьи</title>
    <link
        rel="stylesheet"
        href="/css/style.css"
        type="text/css"
        />
</head>
<body>

<h1 align="center">Статьи</h1>

<?php include __DIR__ . '/box_menu.php'; ?>

<div class="Articles">
    <?php foreach ($items as $item): ?>
<div class="Articles_one">
            <div class="Articles_title"><?php echo $item['articles_name']; ?></div>

                    <div class="Articles_content">
                    <div class="Articles_content_in"><p><?php echo $item['articles_text']; ?></p></div>
                    </div>
                    <div class="Articles_author"><?php echo $item['articles_author']; ?></div>
                    <div class="Articles_author"><?php echo $item['articles_date'] . '/#' . $item['articles_id'] ; ?></div>
</div>

    <?php endforeach; ?>
</div>

<div class="article_insert">

    <form action="/add_articles.php" accept-charset="UTF-8" method="post" enctype="multipart/form-data">
       <div class="title_article_insert"><input type="text" name="title"  size="30" placeholder="Название статьи"></div>
        <textarea type="text" name="content"  cols="50" rows="5" placeholder="Текст статьи"></textarea>
        <div class="title_article_insert"><input type="submit" name="submit" value="Sand"></div>
    </form>

</div>

<footer>
    &copy MC
</footer>
</body>
</html>