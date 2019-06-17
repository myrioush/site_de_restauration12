<?php

		function creationPanier()
		{
		   if (!isset($_SESSION['panier']))
		   {
		      $_SESSION['panier']=array();
		      $_SESSION['panier']['id'] = array();
		      $_SESSION['panier']['qteProduit'] = array();
		      $_SESSION['panier']['price'] = array();
		      $_SESSION['panier']['verrou'] = false;
		   }
		   return true;
		}

		function ajouterArticle($id,$qteProduit,$price)
		{

		   //Si le panier existe
		   if (creationPanier() && !isVerrouille())
		   {
		      //Si le produit existe déjà on ajoute seulement la quantité
		      $positionProduit = array_search($id,  $_SESSION['panier']['id']);

		      if ($positionProduit !== false)
		      {
		         $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
		      }
		      else
		      {
		         //Sinon on ajoute le produit
		         array_push( $_SESSION['panier']['id'],$id);
		         array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
		         array_push( $_SESSION['panier']['price'],$price);
		      }
		   }
		   else
		   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
		}


		function supprimerArticle($id)
		{
		   //Si le panier existe
		   if (creationPanier() && !isVerrouille())
		   {
		      //Nous allons passer par un panier temporaire
		      $tmp=array();
		      $tmp['id'] = array();
		      $tmp['qteProduit'] = array();
		      $tmp['price'] = array();
		      $tmp['verrou'] = $_SESSION['panier']['verrou'];

		      for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
		      {
		         if ($_SESSION['panier']['id'][$i] !== $id)
		         {
		            array_push( $tmp['id'],$_SESSION['panier']['id'][$i]);
		            array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
		            array_push( $tmp['price'],$_SESSION['panier']['price'][$i]);
		         }

		      }
		      //On remplace le panier en session par notre panier temporaire à jour
		      $_SESSION['panier'] =  $tmp;
		      //On efface notre panier temporaire
		      unset($tmp);
		   }
		   else
		   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
		}



		function modifierQTeArticle($id,$qteProduit)
		{
		   //Si le panier éxiste
		   if (creationPanier() && !isVerrouille())
		   {
		      //Si la quantité est positive on modifie sinon on supprime l'article
		      if ($qteProduit > 0)
		      {
		         //Recharche du produit dans le panier
		         $positionProduit = array_search($id,  $_SESSION['panier']['id']);

		         if ($positionProduit !== false)
		         {
		            $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
		         }
		      }
		      else
		      supprimerArticle($id);
		   }
		   else
		   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
		}
         

        function MontantGlobal()
        {
		   $total=0;
		   for($i = 0; $i < count($_SESSION['panier']['id']); $i++)
		   {
		      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['price'][$i];
		   }
		   return $total;

        }

        function supprimePanier()
        {
		   unset($_SESSION['panier']);
		}




        function isVerrouille()
		{
		   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
		   {
               return true;
		   }
           else
           {
               return false;
           }
		   return false;
		}

        
        function compterArticles()
		{
		   if (isset($_SESSION['panier']))
		   {
              return count($_SESSION['panier']['id']);
		   }
		   else
		   {
              return 0;
		   }
		   

		}






?>