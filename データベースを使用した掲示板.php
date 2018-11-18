<?php
 header('Content-Type: text/html; charset=UTF-8');
 // mission_3-1開始
 $dsn = 'データベース名';
 $user = 'ユーザー名';
 $password = 'パスワード';
 $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
 // mission_3-1完了

 $name = $_POST["name"];
 $comment = $_POST["comment"];
 $number = $_POST["number"];
 $number2 = $_POST["number2"];
 $number2_sub = $_POST["number2_sub"];
 $password = $_POST["password"];
 $password1 = $_POST["password1"];
 $password2 = $_POST["password2"];

 $date = date( "Y年m月d日  H:i:s" );
 
 ?>

<?php
 //mission3-5データベースに記載
 if (!empty($name) and !empty($comment) and !empty($password) and empty($number2_sub)){
     $sql  =  $pdo  ->  prepare("INSERT  INTO  keiziban5 (name,comment,password,date)  VALUES  (:name,:comment,:password,:date)");
     $sql  ->  bindParam(':name',  $name,  PDO::PARAM_STR);
     $sql  ->  bindParam(':comment',  $comment,  PDO::PARAM_STR);    
     $sql  ->  bindParam(':password',$password,  PDO::PARAM_STR);
     $sql  ->  bindParam(':date',$date,  PDO::PARAM_STR);
     $sql  ->  execute();
 }
 //mission3-5データベースに記載

 //mission3-7編集表示
 if(!empty($number2)){
  $sql2    = 'SELECT * FROM keiziban5';
  $results = $pdo ->query($sql2);
  $data    = $results->fetchAll();
  foreach($data as $row){
     if($row['id']==$number2){
      if($row['password'] == $password2){
      $edit[0] =$row['id']; 
      $edit[1] =$row['name'] ;
      $edit[2] =$row['comment'] ;
      }
      else{
        $error = "パスワードが違います！";
      }
    }
   }
  }
 //mission3-7編集表示

 
 //mission3-8
 if (!empty($number)){
  $sql3 = 'SELECT * FROM keiziban5';
  $results = $pdo ->query($sql3);
  $data=$results->fetchAll();
  foreach($data as $row){
    if($row['id']==$number){
      if($row['password'] == $password1){
        $sql4  =  "delete  from  keiziban5  where  id=$number";    
        $result  =  $pdo->query($sql4);
      }
      else{
        $error = "パスワードが違います！";
      }
    }  
  }
 }
 //mission3-8
?>

 <html>
 <head> 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>mission4</title>
 <?php echo $error ;?> 
 </head>
 <body>
 <form method = "post">
 <input type="text" name="name" placeholder="名前" value = "<?php echo $edit[1] ;?>" size = "20">
 <br>
 <input type="text" name="comment" placeholder="コメント" value = "<?php echo $edit[2] ;?>" size = "20">
 <br>
 <input type="text" name="password" placeholder="パスワード" value = "<?php echo $edit[4] ;?>">
 <input type="submit" value="送信" >
 <input type="text" name="number2_sub"  style ="visibility:hidden" value = "<?php echo $edit[0] ;?>" >
 <br>
 <br>
 <input type="text" name="number" placeholder="削除対象番号" size ="20">
 <br>
 <input type="text" name="password1" placeholder="パスワード" >
 <input type="submit" value="削除" >
 <br>
 <input type="text" name="number2" placeholder="編集行番号" size ="20">
 <br>
 <input type="text" name="password2" placeholder="パスワード" >
 <input type="submit" value="編集" >
 </form>
 </body>
</html>  

<?php

 //mission3-7編集2
 if (!empty($number2_sub)){
  $id = $number2_sub ;
  $nm =  $_POST["name"] ;
  $kome  =  $_POST["comment"] ;  
  $pass  =  $_POST["password"] ;
  $sql5  =  "update  keiziban5  set  name='$nm'  ,  comment='$kome' , password='$pass' where  id  =  $id";
  $result  =  $pdo->query($sql5);
 }
 //mission3-7編集2

 //mission3-6
 $sql6  =  'SELECT  *  FROM  keiziban5';
 $results  =  $pdo  ->  query($sql6);
 foreach  ($results  as  $row){
        //$rowの中にはテーブルのカラム名が入る
        echo  $row['id'].',';
        echo  $row['name'].',';
        echo  $row['comment'].',';
        echo  $row['date'].'<br>';
 }
 //mission3-6
?>