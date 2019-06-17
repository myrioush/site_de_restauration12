<?php
 session_start();
 require"../database.php";
 include 'fonctions_panier2.php';
 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<title>resto</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
	
</head>
<body>
	<form method="post" action="">
		 <div class="row">
               <div class="col-sm-6">
                    <h1><strong>commande</strong></h1>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Nom:</label>
                        <input type="text" name="nom_c" id="nom_c" required="">
                      </div>
                      <div class="form-group">
                        <label>prénom:</label>
                        <input type="text" name="prenom_c" id="prenom_c">
                      </div>
                      <div class="form-group">
                        <label>email</label>
                        <input type="email" name="email_c" id="email_c">
                      </div>
                      <div class="form-group">
                        <label>numéro de télephone</label>
                        <input type="tel" name="num_c" id="num_c">
                      </div>
                       <div class="form-group">
                        <label>commune</label>
                        <select name="commune_c" id="commune_c">
                        	<option value="cocody">cocody</option>
                        	<option value="plateau">plateau</option>
                        	<option value="abobo">abobo</option>
                        	<option value="adjame">adjamé</option>
                        	<option value="treichville">treichville</option>
                        	<option value="yopougon">yopougon</option>
                        	<option value="marcory">marcory</option>
                        	<option value="port-bouet">port-bouet</option>
                        	<option value="koumassi">koumassi</option>
                        	<option value="attecoube">attécoube</option>
                        </select>
                    </div>
                     <div class="form-group">
                     	<label>lieu d'habitation</label>
                     	<input type="text" name="lieu_c" id="lieu_c">
                     </div>
                     <div class="form-group">
                     	<label>commande</label>
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
				        ?>
				        </table>
				        <p>
				           Le montant total est <?= montant_panier();?>
				        </p>
				                    
                     </div>

                     
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary" href="menu.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div> 
               
            </div>
		 
	</form>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>