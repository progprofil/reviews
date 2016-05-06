<?php

include_once 'index.php';

//Подключение к базе данных
$connect = mysqli_connect("localhost", "student777", "biscuit777","users");

$zapisq_sostoyalas=false;
$zapisq=false;
//Проверяем ввод имени
if (isset($_POST['user_name'])){$user_name = $_POST['user_name'];}
else {unset($user_name);}
//Проверяем ввод email
if (isset($_POST['email'])){$email = $_POST['email'];}
else {unset($email);}

//Проверяем ввод темы
if (isset($_POST['theme'])){$theme = $_POST['theme'];}
else {unset($theme);}

//Проверяем ввод отзыва
if (isset($_POST['text'])){$text = $_POST['text'];}
else {unset($text);}


//Проверка на заполнение полей
if(@!empty($user_name&&$email&&$theme&&$text))
{
   $zapisq=true;
   //Убираем спецсимволы
   $user_name = stripcslashes($user_name);
   $user_name = htmlspecialchars($user_name);

   $email = stripcslashes($email);
   $email = htmlspecialchars($email);

   $theme = stripcslashes($theme);
   $theme = htmlspecialchars($theme);

   $text = stripcslashes($text);
   $text = htmlspecialchars($text);

  //Удаляем пробелы
   $user_name = trim($user_name);
   $email = trim($email);
   $theme = trim($theme);
   $text = trim($text);

   //Защита от ввода текста без пробелов, переносов строки или табуляции
   //После каждых 80-ти символов вставляем принудительный пробел
           $str1=""; $nado=false;
           $i=0;
           for($i=0;$i<strlen($text)&&$i<2040;$i++)
           {
               $s=$text[$i];
               $str1=$str1.$s;
               if($s==' '||$s=='\t'||$s=='\n')
                  $nado=true;
               if($i%80==0&&$i!=0)
               {
                  if( $nado==false )
                  {
                     $str1=$str1.' ';
                  }
                  
                  $nado=false;
               }//if($i%80==0&&$i!=0)
           }//for($i=0;$i<strlen($text)&&$i<2040;$i++)
           $text=$str1;


  $result = mysqli_query($connect, "SELECT COUNT(id) FROM rewievs");

  $result1 = mysqli_fetch_row($result);
  $count = (int)$result1[5];

  $result = mysqli_query($connect, "SELECT * FROM rewievs WHERE id=$count");
  $res = mysqli_fetch_row($result);

  if(@$user_name==$res[0]&&@$email==$res[1]&&@$theme==$res[2]&&@$text==$res[3])
      $zapisq = FALSE; 

  //Внесение данных
  if( $zapisq )
  {
      $zapisq_sostoyalas = true;
      $result = mysqli_query($connect ,"INSERT INTO rewievs
       (user_name,email,theme,text) VALUES('$user_name','$email','$theme','$text')");
  }//if( $zapisq )

}//if(!empty($user_name&&$email&&$theme&&$text))






//Отключение от базы данных
 mysqli_close($connect);
 
 //Если ввод данных прошел успешно переход на страницу дабавления картинки
 if($zapisq_sostoyalas)
 {  
   echo '<meta http-equiv="refresh" content="0;URL=kartinka.html">';    
   $zapisq_sostoyalas = false;
 }
 else
 {
   echo '<meta http-equiv="refresh" content="0;URL=index.php">';    
 }
 ?>

