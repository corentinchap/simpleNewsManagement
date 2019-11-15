<?php
 if(isset($_POST["titre"]) && $_POST["action"] == 'edit')
 {//var_dump($_POST);

     ?>
     <div class="writeEditArticle">
         <form action="#" method="post" enctype="multipart/form-data">
             <h2>Modifiez l'article<a href="http://localhost"><i id="close_edit" class="fa fa-times" aria-hidden="true"></i></a></h2>
             <div class="md-form form-group">
                 <i class="fa fa-quote-left prefix"></i>
                 <input type="text" name="newsTitre" class="form-control" value="<?php echo $_POST["titre"]?>"/>
                 <label class="active" for="newsTitre">Titre</label>
             </div>
             <div class="md-form form-group">
                 <i class="fa fa-info prefix"></i>
                 <input type="text" name="newsDescription" class="form-control" value="<?php echo $_POST["description"]?>" />
                 <label class="active" for="newsContent">Description de la news</label>
             </div>
             <div class="form-group">
                 <i class="fa fa-pencil prefix"></i>
                 <textarea type="text" name="newsContent" class="md-textarea"><?php echo $_POST["text"]?></textarea>
                 <label class="active" for="newsContent">Contenu de la news</label>
             </div>
             <div class="md-form form-group">
                 <i class="fa fa-clock-o prefix"></i>
                 <input type="date" name="newsDate" class="form-control" value="<?php echo $_POST["date"]?>"/>
             </div>
             <div class="md-form form-group">
                 <input type="hidden" name="newsId" value="<?php echo $_POST["id"] ?>"
             </div>
             <div class="md-form form-group">
                 <i class="fa fa-file-image-o prefix"></i>
                 <input type="file" name="newsPhotoCover" class="form-control" />
                 <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
             </div>
             <div class="md-form form-group">
                 <input type="submit" name="send" class="btn btn-primary btn-md" content="Valider"/>
             </div>
         </form>
     </div>
 <?php }