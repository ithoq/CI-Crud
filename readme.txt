
Make unique_slug helper function

make something to check unique relationships

check laravel queries for update and insert

podjeliti na create and edit.view/update

napraviti update i insert u jednom query-u uz transactions

update pivot table *

STORE VALUES TO DB

// DELETE ARTICLE WITH TAGGABLE AND TAGS / DELETING RECORDS WITHOUT FOREIGN KEY CONSTRAINT
DELETE articles, taggable, tags FROM articles INNER JOIN taggable ON articles.id = taggable.taggable_id INNER JOIN tags ON taggable.tag_id = tags.id WHERE articles.id = 39;


# Deleting rows from related tables in MySQL using MyISAM
// DELETE ARTICLE WITH TAGGABLE AND TAGS AND CATEGORIES | NotWorking
DELETE articles, taggable, tags, categories_articles, categories FROM articles INNER JOIN taggable ON articles.id = taggable.taggable_id 
INNER JOIN tags ON taggable.tag_id = tags.id 
INNER JOIN categories_articles ON taggable.taggable_id  = categories_articles.article_id 
INNER JOIN categories ON categories_articles.category_id = categories.id WHERE articles.id = 37;
===== 13 ROWS DELETED
= IF (articles.id = 38)
=====  0 ROWS AFFECTED

DELETE articles, taggable, tags, categories_articles, categories FROM articles LEFT JOIN taggable ON articles.id = taggable.taggable_id 
LEFT JOIN tags ON taggable.tag_id = tags.id 
LEFT JOIN categories_articles ON taggable.taggable_id  = categories_articles.article_id 
LEFT JOIN categories ON categories_articles.category_id = categories.id WHERE articles.id = 38
=====  1 ROW AFFECTED