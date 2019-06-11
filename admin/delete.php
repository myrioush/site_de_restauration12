<?php
  
  require '../database.php';
 
   
 if(!empty($_GET['id'])) 
  
  {
      
    $id = checkInput($_GET['id']);
  
  }

    
 if(!empty($_POST)) 
   
 {
       
    $id = checkInput($_POST['id']);
   
    $db = Database::connect();
        
    $statement = $db->prepare("DELETE FROM items WHERE id = ?");
   
    $statement->execute(array($id));
     
    Database::disconnect();
     
    header("Location:affichage.php"); 
   
 }

  
  function checkInput($data) 
  
  {
     
    $data = trim($data);
     
    $data = stripslashes($data);
     
    $data = htmlspecialchars($data);
     
    return $data;
   
 }

?>


<!DOCTYPE html>

<html>
   
 <head>
        
<title>resto</title>
 
      <meta charset="utf-8"/>
     
      <meta name="viewport" content="width=device-width, initial-scale=1">
  
     <script src="../js/jquery.min.js"></script>
        <link rel="../css/bootstrap.min.css">
        <script src="../js/bootstrap.min.js"></script>
      
  <link rel="stylesheet" href="../css/styles.css">
    
</head>
    
  
 <body>
      
  <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> resto<span class="glyphicon glyphicon-cutlery"></span></h1>
     
    <div class="container admin">
         
       <div class="row">
               
         <h1><strong>Supprimer un item</strong></h1>
                <br>
       
         <form class="form" action="delete.php" role="form" method="post">
     
               <input type="hidden" name="id" value="<?php echo $id;?>"/>
            
        <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
    
                <div class="form-actions">
                 
     <button type="submit" class="btn btn-warning">Oui</button>
             
         <a class="btn btn-default" href="affichage.php">Non</a>
                   
 </div>
           
     </form>
          
  </div>
     
   </div>   
   
 </body>

</html>

