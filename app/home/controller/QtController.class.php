<?php

/**
 * 前台的控制器，作为默认控制器用
 */
class QtController extends Controller {
    private $per = 3;

	/**
	 * 首页方法
	 */
	public function indexAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $m_Article = Factory::M("Article");
        $m_admin = Factory::M("Admin");
        $total = $m_Article->getArticleTotal();
        $totalPage = ceil($total / $this->per);
        if ($page <= 0){
            $page = 1;
        }
        if ($page > $totalPage){
            $page = $totalPage;
        }
        $start = ($page - 1) * $this->per;
        $end = $this->per;
        $num = $start + 1;
        $articles = $m_Article->getArticles($start, $end);
		// 载入前台首页模板
		require './app/home/view/index.php';
	}

}