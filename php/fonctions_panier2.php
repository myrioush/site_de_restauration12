<?php
function panier_vide()
   {
     $_SESSION['panier'] = array(); 
    /* Subdivision du panier */ 
    $_SESSION['panier']['id'] = array(); 
    $_SESSION['panier']['name'] = array(); 
    $_SESSION['panier']['description'] = array();
     $_SESSION['panier']['price'] = array(); 
    $_SESSION['panier']['image'] = array(); 
    $_SESSION['panier']['qte'] = array(); 
    $_SESSION['panier']['prix_unitaire'] = array(); 
  
   }





/** 
 * Ajout d'un plat dans le panier 
 * 
 *
 */ 
function ajout($select) 
{ 
     if(!verif_panier($select['id']))
    { 
        array_push($_SESSION['panier']['id'],$select['id']);  
        array_push($_SESSION['panier']['name'],$select['name']); 
        array_push($_SESSION['panier']['qte'],$select['qte']); 
        
        array_push($_SESSION['panier']['description'],$select['description']); 
        array_push($_SESSION['panier']['price'],$select['price']); 
        array_push($_SESSION['panier']['image'],$select['image']);
        array_push($_SESSION['panier']['prix_unitaire'],$select['price']);
    } 
    else 
    { 
        modif_qte($select['id'],$select['qte']); 
    } 
       

}







/** 
 * Vérifie la présence d'un plat dans le panier 
 * 
 *
 */ 
function verif_panier($id) 
{ 
    /* On initialise la variable de retour */ 
    $present = false; 
    /* On vérifie les numéros de références des plats et on compare avec l'plat à vérifier */ 
    if( count($_SESSION['panier']['id']) > 0) 
    { 
        for ($i=0; $i <count($_SESSION['panier']['id']) ; $i++)
         { 
            if($_SESSION['panier']['id'][$i] == $id ) 
            {
               $present = true; 
               break; 
            }
        }

        return $present;
        
    } 
     
}  



/** 
 * Modifie la quantité d'un plat dans le panier 
 * 
 * 
 */ 
function modif_qte($id, $qte) 
{ 
    /* On compte le nombre d'plats différents dans le panier */ 
    $nb_plats = count($_SESSION['panier']['id']); 
    /* On initialise la variable de retour */ 
    $ajoute = false; 
    /* On parcoure le tableau de session pour modifier l'plat précis. */ 
    for($i = 0; $i < $nb_plats; $i++) 
    { 
        if($id == $_SESSION['panier']['id'][$i] ) 
        { 
            $_SESSION['panier']['qte'][$i] += $qte;
            $_SESSION['panier']['price'][$i]=$_SESSION['panier']['qte'][$i]*$_SESSION['panier']['prix_unitaire'][$i]; 




            $ajoute = true; 
        } 
    } 
    return $ajoute; 
}




/* Fonction pour supprimer les plats ------------------------------------------------------------- */ 

function supprim_plat($id) 
{ 
    $suppression = false; 
    /* création d'un tableau temporaire de stockage des plats */ 
    $panier_tmp = array("qte"=>array(),"name"=>array(),"price"=>array(),"description"=>array(),"id"=>array(),"image"=>array(),"prix_unitaire"=>array()); 
    /* Comptage des plats du panier */ 
    $nb_plats = count($_SESSION['panier']['id']); 
    /* Transfert du panier dans le panier temporaire */ 
    for($i = 0; $i < $nb_plats; $i++) 
    { 
        /* On transfère tout sauf l'plat à supprimer */ 
        if($_SESSION['panier']['id'][$i] == $id ) 
        {

                
           echo "Un problème est survenu veuillez contacter l'administrateur du site.";
            


           
        } 
        else
        {
             array_push($panier_tmp['id'],$_SESSION['panier']['id'][$i]); 
            array_push($panier_tmp['qte'],$_SESSION['panier']['qte'][$i]); 
            array_push($panier_tmp['name'],$_SESSION['panier']['name'][$i]); 
            array_push($panier_tmp['prix'],$_SESSION['panier']['prix'][$i]);
            array_push($panier_tmp['image'],$_SESSION['panier']['image'][$i]);
            array_push($panier_tmp['description'],$_SESSION['panier']['description'][$i]); 
        }
    } 
    /* Le transfert est terminé, on ré-initialise le panier */ 
    $_SESSION['panier'] = $panier_tmp; 
    /* Option : on peut maintenant supprimer notre panier temporaire: */ 
    unset($panier_tmp); 
    $suppression = true; 
    return $suppression; 
} 





/* Fonction pour calculer le montant total du panier ------------------------------------------------------------- */ 
    function montant_panier() 
{ 
    /* On initialise le montant */ 
    $montant = 0; 
    /* Comptage des plats du panier */ 
    $nb_plats = count($_SESSION['panier']['id']); 
    /* On va calculer le total par plat */ 
    for($i = 0; $i < $nb_plats; $i++) 
    { 
        $montant +=  $_SESSION['panier']['price'][$i]; 
    } 
    /* On retourne le résultat */ 
    return $montant; 
}
    


?>