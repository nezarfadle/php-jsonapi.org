<?php  namespace App\Tasks;

use App\Article,
	App\Comment,
	App\Author,
	App\ArticleEntity
;

class GetArticleTask
{
	public static function get()
	{
		$article = new Article( 1, "PHP & Mysql", "PHP is Cool");
		$article->writtenBy( new Author(1, "Nezar Fadle", "email@gmail.com" ));
		$article->has( new Comment( 1, "First Comment", "Just First Comment" ));
		$article->has( new Comment( 2, "Second Comment", "Just Second Comment" ));

		return new ArticleEntity( $article );
	}
}