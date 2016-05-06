<!DOCTYPE html>
<html lang="uk">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="css/reviews.css"/>
 <title>
 </title>
</head>
<body>
 
   <?php
      echo '<h1>Загрузка вашей картинки</h1>' ;
 
   $if_load=false;

   
//   echo '<pre>';
//   var_dump($_FILES);
//   echo '</pre>';


   //Вся информация о присланном файле
//   foreach( $_FILES["input_teg_kartinka"] as $key => $value )
//   {
//      echo '<br>'.$key.' = '.$value ;
//   }

 //Внесение введенных данных в свои переменные
   $file_name_original=$_FILES["input_teg_kartinka"]["name"];
   $file_name_my=$file_name_original;
   $file_type_original=$_FILES["input_teg_kartinka"]["type"];
   $file_path_full_on_server=$_FILES["input_teg_kartinka"]["tmp_name"];
   $file_load_error=$_FILES["input_teg_kartinka"]["error"];
   $file_size_in_bytes=$_FILES["input_teg_kartinka"]["size"];
 
 
   
   //В процессе написания проверял на наличие значений в переменных
// echo '<br>&nbsp;<br>' ;
// echo '<br>$file_name_original = '.$file_name_original ;
// echo '<br>$file_type_original = '.$file_type_original ;
// echo '<br>$file_path_full_on_server = '.$file_path_full_on_server ;
// echo '<br>$file_load_error = '.$file_load_error ;
// echo '<br>$file_size_in_bytes = '.$file_size_in_bytes ;

   
   //Проверка загрузки картинки
   if($file_load_error!=0)
   {
      echo '<br>&nbsp;<br>
         <div class="kartinka_error">
            Не удалось загрузить Вашу картинку !!!  
         </div>
      '; 
  
   //При нажатии на кнопку занрузить выдает код ошибки 4
      if($file_load_error==4)
      {
         echo '<br>&nbsp;<br>
            <div class="kartinka_error">
               Вы нажали кнопку но забыли выбрать файл
            </div>
         '; 
      }//if($file_load_error==4)
   }//if($file_load_error!=0)
   else
   {
     echo '<br>&nbsp;<br>
      <div class="kartinka_ok">
         Анализируем Ваш файл
      </div>
      '; 
  
     //Берем путь к файлу
    $elem=  pathinfo($file_name_original);

  //Проверка во время написания кода
  /* 
  echo '<pre>';
  var_dump($elem);
  echo '</pre>';
  
  echo '<br>';
  foreach($elem as $key => $index)
  {
     echo '<br>'.$key.' = '.$index;
  }
*/

    //Вытягиваем имя файла
   $file_name_original_short = $elem["filename"] ;
 //  echo '<br>$file_name_original_short  = '.$file_name_original_short  ;

   //Вытягиваем расширение файла
   $file_name_original_extension = $elem["extension"] ;
   
   if( $file_name_original_extension == null )
   {
      $file_name_original_extension = "" ;
   }
  
 // echo '<br>$file_name_original_extension = '.$file_name_original_extension ;
  
  switch($file_name_original_extension)
  {
   case 'jpg':
    $if_load=true;
    break;
   case 'JPG':
    $if_load=true;
    break;
   case 'gif':
    $if_load=true;
    break;
   case 'png':
    $if_load=true;
    break;
   case 'jpeg':
    $if_load=true;
    break;
   default:
    $if_load=false;
      echo '<br>&nbsp;<br>
         <div class="kartinka_error">
            Ваша картинка не будет загруженна
            Разрешается грузить только файлы с расширениями:
            .jpg .JPG .jpeg .gif .png
         </div>
      '; 
    break;
  }//switch($file_name_original_extension)
  
  if($if_load)
  {

// Делаем добавку к оригинальному имени картинки в виде числа и времени заливки
     //Для того чтобы избежать одинаковых имен
     
    //Устанавливаем временную зону 
   date_default_timezone_set("UTC") ;
   $file_name_original_short_modified =
      $file_name_original_short.date( "ymdHis");
   
   //добавляем расширение к имени файла
   $file_name_my =
      $file_name_original_short_modified.'.'.$file_name_original_extension;

   //Записываем картинки в папку "kartinki"
   $if_load_success=move_uploaded_file( $file_path_full_on_server 
    ,'kartinki/'.$file_name_my );
   
   if($if_load_success)
   {
//Записываем имя файла картинки в последнюю сточку таблицы rewievs
      $connect = mysqli_connect("localhost", "student777", "biscuit777","users"); 
      $error_number = mysqli_connect_errno();
      
      if(0 != $error_number)
         {
            echo mysqli_connect_errno().'<br>'.mysqli_connect_error();
         }
       else
       {
          //Определение номера поседней записи
          $result = mysqli_query($connect, "SELECT COUNT(id) FROM rewievs");
          $result1 = mysqli_fetch_row($result);
          $count = (int)$result1[0];
          
         //Внесение имени файла картинки в базу данных 
          $result = mysqli_query($connect 
           ,"UPDATE rewievs SET pic_name = \"$file_name_my\" WHERE id = $count");
              
          //Последняя проверочка)))
//          echo '<pre>';
//           var_dump($result1);
//          echo '</pre>';
       } 

//Закрываем базу
      mysqli_close($connect);
      
      
      //Отчет об успешно загруженном файле на экран пользователя(+его имя и размер)
      echo '<br>&nbsp;<br>
            <div style="font-size: 200%; color: #009900;">
               Ваш файл успешно загружен
            </div>
            <div style="font-size: 150%; color: #990000;">
               Имя вашего файла:   '.$file_name_original.'
               <br>Размер вашего файла: '.$file_size_in_bytes.' байтов
          </div>
      '; 
   }//if($if_load_success)
   
      $if_load=false;
   }//if($if_load)

  }//else//if($file_load_error!=0)
 
  //Форма для кнопки возврата после загрузки файла
   echo '<form method="POST" action="index.php" name="rewies" accept-charset="utf8">
            <input type="submit" name="nomer_sub" value="Вернуться">
        </form>
   ';
   
//   THE END)))
?>
</body>
</html>
