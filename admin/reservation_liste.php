<?php
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

	<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> resto <span class="glyphicon glyphicon-cutlery"></span></h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>Liste de reservation </strong></h1>
                <table class="row">
                  <thead class="card">
                    <tr>
                      <th>Nom</th>
                      <th>prenom</th>
                      <th>nombre de personne</th>
                      <th>email</th>
                      <th>numero</th>
                      <th>date de reservtion</th>
                      <th>heure de reservation</th>
                      <th>numéro de la table</th>
                    </tr>
                  </thead>

                  <tbody>
                      <?php
                        require '../database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT reservation.id, reservation.nom_reser, reservation.prenom_reser, reservation.nombre_p, reservation.email,reservation.numero ,reservation.date_reser,reservation.heure_reser  FROM reservation ORDER BY reservation.id ASC');
                        
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'. $item['nom_reser'] . '</td>';
                            echo '<td>'. $item['prenom_reser'] . '</td>';
                            echo '<td>'. $item['nombre_p'] . '</td>';
                            echo '<td>'. $item['email'] . '</td>';
                            echo '<td>'. $item['numero'] . '</td>';
                            echo '<td>'. $item['date_reser'] . '</td>';
                            echo '<td>'. $item['heure_reser'] . '</td>';
                            echo '</tr>';
                        } 
                        Database::disconnect();
                      ?>
                  </tbody>
                </table>
            </div>
        </div>   

</body>
</html>