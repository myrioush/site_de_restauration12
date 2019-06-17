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
                <h1><strong>Liste du menu  </strong><a href="ajouter.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1> <a href="reservation_liste.php">liste des réservation</a>
                <table class="row">
                  <thead class="card">
                    <tr>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Prix</th>
                      <th>Catégorie</th>
                      <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>
                      <?php
                        require '../database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id ASC');
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'. $item['name'] . '</td>';
                            echo '<td>'. $item['description'] . '</td>';
                            echo '<td>'. number_format($item['price'], 2, '.', '') . '</td>';
                            echo '<td>'. $item['category'] . '</td>';
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="views.php?id='.$item['id'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="update.php?id='.$item['id'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                            echo ' ';
                            echo '<button class="btn btn-danger" ><a  href="delete.php?id='.$item['id'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></button>';
                            echo '</td>';
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