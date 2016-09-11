<?php

/**
 * 前台的控制器，作为默认控制器用
 */
class QtController extends Controller {
    private $article_per = 3;
    private $articleType_per = 5;
    private $latestArticle_per = 6;

	/**
	 * 首页方法
	 */
	public function indexAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $m_Article = Factory::M("Article");
        $latestArticles = $m_Article->getLatestArticles($this->latestArticle_per);
        $m_ArticleType = Factory::M("ArticleType");
        $articleTypes = $m_ArticleType->getSomeArticleType($this->articleType_per);
        $total = $m_Article->getArticleTotal();
        $totalPage = ceil($total / $this->article_per);
        if ($page <= 0){
            $page = 1;
        }
        if ($page > $totalPage){
            $page = $totalPage;
        }
        $start = ($page - 1) * $this->article_per;
        $end = $this->article_per;
        $num = $start + 1;
        $articles = $m_Article->getArticles($start, $end);
//        die(var_dump($total,$totalPage,$articles));
		// 载入前台首页模板
		require './app/home/view/index.php';
	}
	public function showSearchResultAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if (isset($_POST["search"])){
            setcookie('search',$_POST["search"]);
            $_COOKIE["search"] = $_POST["search"];
        }
        $search = isset($_COOKIE['search']) ? $_COOKIE['search'] : "";
        $m_Article = Factory::M("Article");
        $latestArticles = $m_Article->getLatestArticles($this->latestArticle_per);
        $m_ArticleType = Factory::M("ArticleType");
        $articleTypes = $m_ArticleType->getSomeArticleType($this->articleType_per);
        $total = $m_Article->getSearchTotal($search);
        $totalPage = ceil($total / $this->article_per);
        if ($page > $totalPage){
            $page = $totalPage;
        }
        if ($page <= 0){
            $page = 1;
        }
        $start = ($page - 1) * $this->article_per;
        $end = $this->article_per;
        $num = $start + 1;
        $articles = $m_Article->searchArticle($start, $end,$search);
//        die(var_dump($total,$totalPage,$articles));
		// 载入前台首页模板
		require './app/home/view/searchResult.php';
	}

}