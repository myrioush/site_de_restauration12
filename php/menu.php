<?php
    require "../Models/database.php";
    require_once 'fonctions_panier2.php';

    session_start();
    set_time_limit(0);
     function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $db = Database::connect();
    /* vider_panier*/

    if (isset($_POST['vider_panier']))
    {
        panier_vide();
        header( 'location:menu.php');

    }
    /* Initialisation du panier */ 
    if(!isset($_SESSION['panier'])) 
    { 
        /* Initialisation du panier */ 
        panier_vide();

    }

    /* Ajout de plat dans le panier */ 
    if (isset($_POST['Ajouter'])) 
    {

        $select = array(); 
        $select['id'] = $_POST['id']; 
        $select['name'] = $_POST['name']; 
        $select['qte'] = $_POST['qte']; // quantité
        $select['description'] =$_POST['description'];
        $select['price'] =$_POST['price']*$_POST['qte'];;
        $select['image'] =$_POST['image'];

        ajout($select);
        header( 'location:menu.php');
        
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>resto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	
</head>
<body>
    <nav>
        <ul class="nav nav-tabs" role="tablist">
            <?php
            $db = Database::connect();
            $statement = $db ->query("call getAllCat()");
            $categories = $statement->fetchAll();
            foreach ($categories as $category){
                if($category['id'] == 1)
                    echo '<li  class="active" role="tab"><a href="#' . $category['name'] .'" data-toggle="tab">' .$category['name'] . '</a></li>';
                else
                    echo '<li  role="tab"><a href="#' . $category['name'] .'" data-toggle="tab">' .$category['name'] . '</a></li>';
            }
            ?>
        </ul>
    </nav>

    <div class="container">

         <h3>Mon panier </h3> 
         <table class="table table-bordered table-striped table-condensed">
         <tr>
            
            <td style=" "><b style="  ">Plat(s)</b></td>
            <td style=" "><b style=" ">name</b></td>
            <td style=" "><b style=" ">description </b></td>
            <td style=" "><b style=" ">Price</b></td>
            <td style=" "><b style=" ">nombre de plat</b></td>
            <td style=" " ><b style=" ">Total </td>
            
        </tr>
        <?php
        for ($i=0; $i <sizeof($_SESSION['panier']['id']) ; $i++) 
        { 
        
        ?>
      
          <tr>
            
            <td style=" "><img src="<?=$_SESSION['panier']['image'][$i] ;?>" style="width: 100px"><br> </td>
            <td style=" "><?php echo $_SESSION['panier']['name'][$i] ;?></td>
            <td style=" "><?php echo $_SESSION['panier']['description'][$i] ;?></td>
            <td style=" "><?php echo $_SESSION['panier']['prix_unitaire'][$i];?>Fcfa</td>
            <td style=" "><?= $_SESSION['panier']['qte'][$i];?> </td>
            <td style=" "><?= $_SESSION['panier']['price'][$i];?> </td>
          </tr>
        <?php 
        }
          $date=date('dmYHis');
          echo$id_commande='CMD'.$date;
        ?>
        </table>
        <p>

           Le montant total est <?= montant_panier();?>
        </p>
        <form action="" method="POST">
        <button class="btn btn-danger" type="submit" name="vider_panier">Vider panier</button>
        <?php

             if ((empty($_POST['valider_commande'])))
              {
                 echo "veuillez-vous connection";  
              }
             

        ?>
        <button class="btn btn-danger" type="submit" name="valider_commande"><a href="commande.php">Valider la commande</a></button>
       </form>



        
    </div>

    <div class="tab-content">
        <?php
        foreach ($categories as $category){
            if($category['id'] == 1)
                echo '<div class="tab-pane active" id="'. $category['name'] .'" role="tabpanel">';
            else
                echo '<div class="tab-pane" id="'. $category['name'] .'" role="tabpanel">';
            echo '<div class="row">';
            $statement = $db->prepare("call getItemByCat(?)");
            $statement->execute(array($category['id']));
            $items = $statement->fetchAll();
            foreach ($items as $item){
        ?>
        <div class="col-sm-6 col-md-4">
                <form action="" method="POST">
                        <div class="card h-100">

                            <a href="#"><img class="card-img-top img-rounded " src="<?='../image/'. $item['image'];?>"  width="100" ></a>
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="name" value="<?= $item['name'] ?>">
                                <input type="hidden" name="price" value="<?= $item['price'] ?>">
                                <input type="hidden" name="description" value="<?= $item['description'] ?>">
                                <input type="hidden" name="image" value="<?= $item['image'] ?>">

                                <h4 class="card-title">
                                    <b style="color: orange"><?= $item['name'];?></b> 
                                </h4>
                                <h5>Prix: <?= $item['price'].' FCFA';?></h5>
                                <?php //<p class="card-text"></p>?>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small><br>
                                nombre de plat:
                                <select name="qte" >
                                    <?php
                                    for ($i=1; $i <101 ; $i++)
                                        { ?>
                                            <option value='<?= $i;?>'><?= $i;?></option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                    <button class="btn btn-success" name="Ajouter"> Add</button>

                                </div>
                                </div>

                    </form>
            </div>
                   
            <?php
            }
            echo '</div>
            </div>';
            ?>
        <?php
        }

        ?>
            

       
    </div>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
 </body>
</html>