<table border="1">
    <tr>
        <th>name</th>
        <th>foto</th>
    </tr>

    <?php foreach ($foto as $item): ?>
        <tr>
            <td><p><?php echo $item['title'] ?></p></td>
            <td>
                <a href="<?php echo $item['path'] ?>" target="blank">
                    <img src="<?php echo $item['path'] ?>" style="max-width: 200px;"
            </td>
        </tr>
    <?php endforeach; ?>
</table>