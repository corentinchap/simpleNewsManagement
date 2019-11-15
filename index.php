<?php
require('connection.class.php');
$dbh = new DBHandler();
if($dbh->getInstance() === null){
    die("no db conn");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Axianet - Gestion des news</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">


    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>


  <!--Navbar-->
      <nav class="navbar scrolling-navbar">

          <!-- Collapse button-->
          <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
              <i class="fa fa-bars"></i>
          </button>

          <div class="container">
              <!--Collapse content-->
              <div class="collapse navbar-toggleable-xs" id="collapseEx">

                  <ul class="nav navbar-nav text-black">
                      <li class="nav-item active">
                          <a class="nav-link">Mode administrateur<input id="adminToggleEvent" type="checkbox" data-toggle="toggle"></a>
                      </li>

                  </ul>
              </div>
              <!--/.Collapse content-->

          </div>

      </nav>
      <!--/.Navbar-->

      <!-- Main container-->
     <div class="container">
         <h1 class="titre">Gestion des news Axianet</h1>
            <a href="?action=add" id="addNews" ><img class="btnAddArticle" src="img/btnAdd.png"/></a>
         <section id="newscontainer">
         <?php
         if(isset($_GET["action"]) && $_GET["action"] == "add")
         {
             ?>
             <div class="writeEditArticle">
                 <form action="/" method="post" enctype="multipart/form-data" id="addForm">
                    <h2 style="width: 100%;">Ecrivez un nouvel article<a href="http://localhost"><i id="close_edit" class="fa fa-times" aria-hidden="true"></i></a></h2>
                     <div class="md-form form-group">
                         <i class="fa fa-quote-left prefix"></i>
                         <input type="text" name="newsTitre" class="form-control" />
                         <label for="newsTitre">Titre</label>
                     </div>
                     <div class="md-form form-group">
                         <i class="fa fa-info prefix"></i>
                         <input class="active" type="text" name="newsDescription" class="form-control"  />
                         <label for="newsContent">Description de la news</label>
                     </div>
                     <div class="form-group">
                         <i class="fa fa-pencil prefix"></i>
                         <textarea type="text" name="newsContent" class="form-control md-textarea"></textarea>
                         <label for="newsContent">Contenu de la news</label>
                     </div>
                     <div class="md-form form-group">
                         <i class="fa fa-clock-o prefix"></i>
                         <input type="date" name="newsDate" class="form-control" />
                     </div>
                     <div class="md-form form-group">
                         <i class="fa fa-file-image-o prefix"></i>
                         <input type="file" name="newsPhotoCover" class="form-control" />
                         <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                     </div>
                     <div class="md-form form-group">
                         <input type="submit" name="add" class="btn btn-primary btn-md" content="Ajouter"/>
                     </div>
                 </form>
             </div>
         <?php }


         $pdo = $dbh->getInstance();

        if(isset($_POST["add"]) or isset($_POST["send"]))
        {
            $titre = addslashes(htmlspecialchars($_POST["newsTitre"]));
            $description = addslashes(htmlspecialchars($_POST["newsDescription"]));
            $contenu = addslashes(htmlspecialchars($_POST["newsContent"]));
            $date = addslashes(htmlspecialchars($_POST["newsDate"]));

            if($_FILES['newsPhotoCover']['error'] != UPLOAD_ERR_NO_FILE)
            {
                $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
                $extension_upload = strtolower(  substr(  strrchr($_FILES['newsPhotoCover']['name'], '.')  ,1)  );
                if ($_FILES['newsPhotoCover']['error'] > 0) $erreur = "Erreur lors du transfert";
                $nom = md5(uniqid(rand(), true));
                $nom = "$nom.{$extension_upload}";
                $resultat = move_uploaded_file($_FILES['newsPhotoCover']['tmp_name'],'img/'.$nom);
            }

            if(isset($_POST["add"]))
            {
                if($_FILES['newsPhotoCover']['error'] == UPLOAD_ERR_NO_FILE)
                {
                    $sql = "INSERT INTO tblNews (newsTitre, newsDate, newsContent, newsDescription, newsPhotoPath) VALUES ('$titre','$date','$contenu','$description', 'news1.jpg')";
                }
                else
                {
                    $sql = "INSERT INTO tblNews (newsTitre, newsDate, newsContent, newsDescription, newsPhotoPath) VALUES ('$titre','$date','$contenu','$description', '$nom')";

                }

                $req = $pdo->prepare($sql);
                $res = $req->execute();


            }
            else if(isset($_POST["send"]))
            {
                $id = $_POST["newsId"];
                if($_FILES['newsPhotoCover']['error']  == UPLOAD_ERR_NO_FILE)
                {
                    $sql = "UPDATE tblNews SET newsDescription = ?,newsContent = ?, newsDate = ?, newsTitre = ?, newsPhotoPath = 'news1.jpg' WHERE newsId = ? ";
                    $req = $pdo->prepare($sql);
                    $data = array($description, $contenu, $date, $titre, $id);
                }
                else
                {
                    $sql = "UPDATE tblNews SET newsDescription = ?,newsContent = ?, newsDate = ?, newsTitre = ?, newsPhotoPath = ? WHERE newsId = ? ";
                    $req = $pdo->prepare($sql);
                    $data = array($description, $contenu, $date, $titre,$nom, $id);
                }

                $res = $req->execute($data);
            }
            unset($_POST);


        }




        $query = $pdo->query("SELECT * FROM tblNews ORDER BY newsDate DESC");
        $i=0;
        while($res = $query->fetchObject())
        {
            $i++;
              ?>

                  <!--First columnn-->
                  <div class="col-md-6">
                      <!--Card-->
                      <div class="card wow fadeInUp" data-wow-delay="<?php echo $i*0.2 ?>"  news-id="<?php echo $res->newsId ?>">

                          <!--Card image-->
                          <div class="view overlay hm-white-slight">
                              <img src="img/<?php echo $res->newsPhotoPath ?>" class="img-fluid" alt="">
                              <div class="hided closeButton">
                                <span class="edit fa-stack fa-md">
                                 <i class="fa fa-circle fa-stack-2x"></i>
                                 <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                </span>
                                  <span class="delete fa-stack fa-md adminMode">
                                  <i class="fa fa-circle fa-stack-2x"></i>
                                  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                                </span>
                              </div>


                                  <div class="mask"></div>
                              </a>
                          </div>
                          <!--/.Card image-->

                          <!--Card content-->
                          <div class="card-block text-xs-center">
                              <!--Title-->
                              <h4 class="card-title"><?php echo $res->newsTitre ?></h4>
                              <hr>
                              <!--Text-->
                              <p class="card-text"><?php echo $res->newsDescription ?></p>
                              <p class="card-details">
                                  <i class="fa fa-clock-o"></i> <?php echo $res->newsDate ?></li>
                              </p>
                              <p class="card-text hided"><?php echo $res->newsContent ?></p>
                          </div>
                          <!--/.Card content-->

                      </div>
                      <!--/.Card-->
                  </div>
                  <!--First columnn-->
              <?php
                if($i%2 == 0)
                {
                    echo '<div class="clearfix"></div>';
                }
                }
              ?>



          </section>
          <!--/Section: Best features-->

          </div>
             <!--/ Main container-->




    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>


  <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/script.js"></script>

</body>

</html>
