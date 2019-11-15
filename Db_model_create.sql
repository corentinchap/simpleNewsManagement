
USE pj87y_dbnews;

-- tables
-- Table: tblNews
CREATE TABLE tblNews (
    newsId int NOT NULL AUTO_INCREMENT,
    newsTitre varchar(255) NOT NULL,
    newsDescription varchar(255) NOT NULL,
    newsContent varchar(255) NOT NULL,
    newsPhotoPath varchar(255) NULL,
    newsDate timestamp NOT NULL,
    CONSTRAINT tblNews_pk PRIMARY KEY (newsId)
);

INSERT INTO tblNews (newsTitre, newsDescription, newsContent, newsPhotoPath)
VALUES
  ('titre1', 'lorem ipsum dolor descripsium', 'n MySQL the CURRENT_TIME() returns the current time in ‘HH:MM:SS’ format or HHMMSS.uuuuuu format depending on whether numeric or string is used in the function. CURRENT_TIME() and CURRENT_TIME are the synonym of CURTIME().Note: All of the example codes of this page will produce outputs depending upon the current time.' ,'news1.jpg'),
  ('titre2', 'lorem ipsum dolor descripsium', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis est velit, porttitor feugiat elit egestas sed. Nam laoreet erat vitae vehicula viverra. Cras fermentum sit amet justo eu vehicula. Donec auctor ipsum arcu, eget auctor quam ultrices et. Cras in ornare eros. Pellentesque porttitor sollicitudin nunc, eu dictum ipsum mollis id. Vivamus scelerisque a nulla id tincidunt.', 'news1.jpg'),
  ('titre3', 'lorem ipsum dolor descripsium','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis est velit, porttitor feugiat elit egestas sed. Nam laoreet erat vitae vehicula viverra. Cras fermentum sit amet justo eu vehicula. Donec auctor ipsum arcu, eget auctor quam ultrices et. Cras in ornare eros. Pellentesque porttitor sollicitudin nunc, eu dictum ipsum mollis id. Vivamus scelerisque a nulla id tincidunt.', 'news1.jpg'),
  ('titre4', 'lorem ipsum dolor descripsium','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis est velit, porttitor feugiat elit egestas sed. Nam laoreet erat vitae vehicula viverra. Cras fermentum sit amet justo eu vehicula. Donec auctor ipsum arcu, eget auctor quam ultrices et. Cras in ornare eros. Pellentesque porttitor sollicitudin nunc, eu dictum ipsum mollis id. Vivamus scelerisque a nulla id tincidunt.', 'news1.jpg'),
  ('titre5', 'lorem ipsum dolor descripsium','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis est velit, porttitor feugiat elit egestas sed. Nam laoreet erat vitae vehicula viverra. Cras fermentum sit amet justo eu vehicula. Donec auctor ipsum arcu, eget auctor quam ultrices et. Cras in ornare eros. Pellentesque porttitor sollicitudin nunc, eu dictum ipsum mollis id. Vivamus scelerisque a nulla id tincidunt.', 'news1.jpg');
