<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Reviews</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src='http://www.google.com/recaptcha/api.js'></script>
        <link rel="stylesheet" href="css/reviews.css"/>
    </head>
    
<div class="wrapper-reviews">
   <h1>Оставьте отзыв о нашем сайте</h1>
        
        <!--Форма вызова отзыва по номеру-->
   <form method="POST" action="index.php" name="rewies" accept-charset="utf8">
      <input type="text" name="nomer"> Введите номер отзыва который вы хотите видеть         
      <input type="submit" name="nomer_sub">
   </form>
         
        
        
<?php
   //Подключение к базе данных users
   $connect = mysqli_connect("localhost", "student777", "biscuit777","users"); 
   $error_number = mysqli_connect_errno();    
   //Проверка на успешное подключение
   if(0 != $error_number)
   {
      echo mysqli_connect_errno().'<br>'.mysqli_connect_error();
   }
  
   //Обработка количества записей в базе данных
   $result = mysqli_query($connect, "SELECT COUNT(id) FROM rewievs");
   $result1 = mysqli_fetch_row($result);
   $count = (int)$result1[0];

   //Обработчик вызова отзыва по номеру
   if(isset($_POST['nomer'])){$nomer = $_POST['nomer'];}
   else
   {
      $nomer = $count; 
   }

   //Если было введенно число большее чем количество записей возвращать результат начиная от последней существующей записи
   if($nomer>$count){$nomer = $count;}
   if($nomer<3){$nomer=3;}

   //Поиск по базе данных введенного значения
   echo '<br>';
   $result = mysqli_query($connect ,
    "SELECT * FROM rewievs WHERE id IN ($nomer,$nomer-1, $nomer-2) ORDER BY id DESC");

   //Вывод на экран значения
   while ($stroka = mysqli_fetch_row($result))
   {
      echo '<p class="reviews_text">'
         .$stroka[5].') '.' Пользователь: '.$stroka[0].'<br>'.
         'Email: '.$stroka[1].'<br>'.
         'Тема: '.$stroka[2].'<br>'.
         'Отзыв: <br>'.$stroka[3].'<br>'.'</p>';

      //Вывод на экран картинки
      $kart = $stroka[4];
      if($kart != null)
      {
         echo "<img src=\"kartinki/$kart\" alt= \"$kart\">";
      }
   }//while ($stroka = mysqli_fetch_row($result))
?>

<!--Форма ввода данных-->
   <form method="POST" action="obrabotka.php" name="rewies" accept-charset="utf8" class="form">            
      <div class="g-recaptcha" data-sitekey="6Leuch4TAAAAAF0MagvUZz3V8i8Xmxr3D3haadZM"></div>
             
      <div>
         <label>*Имя или Логин:<input type="text" name="user_name"></label>
         <label>*Email:<input type="email" name="email"></label>

         <label>*Тема:
            <select name="theme"> 
               <option>Деньги</option>
               <option>Безопасность</option>    
               <option>Бизнес</option>    
            </select>
         </label>                    
      </div>

      <div>
         <p>Текст отзыва:</p>
         <label><textarea cols="140" rows="8" name="text"></textarea></label>
      </div>
      <input type="submit" value="Оставить отзыв" name="submit">
      <input type="reset" value="Сброс" name="reset">
   </form>
</div><!--<div class="wrapper-reviews">-->

<!--Отключение от базы данных-->
<?php mysqli_close($connect);?>
    
</html>
