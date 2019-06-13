<?php
    require_once "../database.php";
     function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>resto</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
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
                echo ' 
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="images/' .$item['image'].'" alt="...">
                            <div class="price">' .number_format((float)$item['price'], 2, '.', ''). ' €</div>
                            <div class="caption">
                                <h4>'.$item['name'].'</h4>
                                <p>'.$item['description'].'</p>
                                <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div>
             </div>';
        }
        ?>
    </div>
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
</body>
</html>