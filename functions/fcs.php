<?php

function Sql_connect()
{
    mysql_connect('localhost', 'root', '1234');
    mysql_select_db('expert');
    mysql_query("SET character_set_results = 'utf8',
                character_set_client = 'utf8',
                character_set_connection = 'utf8',
                character_set_database = 'utf8',
                character_set_server = 'utf8'");

}

function Sql_exec($sql)
{
    Sql_connect();
    mysql_query($sql);

}

function Sql_query($sql)
{

    Sql_connect();
    $res = mysql_query($sql);

    $ret = [];
    while (false !== $row = mysql_fetch_assoc($res))
    {

        $ret[] = $row;
    }

    return $ret;
}


function File_upload($field){
  //  if (empty($_FILES))
 //       return false;
 //   if (0 != $_FILES[$field] ['error'])
 //       return false;
    if (is_uploaded_file($field['tmp_name'])){
        $res = move_uploaded_file(
            $field['tmp_name'],
            __DIR__ . '/../img_exp/I_M_G/' . $field['name']
        );
        if (!$res) {
            return false;
        } else {
            return '/I_M_G/' . $field['name'];
        }
    }
    return false;
}


function File_upload_service2($field ){
    //  if (empty($_FILES))
    //       return false;
    //   if (0 != $_FILES[$field] ['error'])
    //       return false;
   // var_dump($field);
    foreach ($field["error"] as $key => $error) {
        if ($error == 0) {
            $tmp_name = $field["tmp_name"][$key];
            // basename() может спасти от атак на файловую систему;
            // может понадобиться дополнительная проверка/очистка имени файла
            $name =  __DIR__ . '/../img_exp/I_M_G_Service/' . $field['name'][$key];

            $res = implode('///', $field['name']);

        }

        move_uploaded_file($tmp_name, $name);
    }

    return $res;
}

function File_upload_service($field ){
if (is_uploaded_file($field['tmp_name'])){
    $res = move_uploaded_file(
        $field['tmp_name'],
        __DIR__ . '/../img_exp/I_M_G_Service/' . $field['name']
    );
    if (!$res) {
        return false;
    } else {
        return '/I_M_G_Service/' . $field['name'];
    }
}
    return false;
}
?>
