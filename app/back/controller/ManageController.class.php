<?php
/**
 * 后台管理中心控制器
 */
class ManageController extends ModuleController {
	/**
	 * 首页动作
	 */
	private $per = 5;
	public function indexAction() {
		// 载入后台首页模板
        require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/index.html';
	}
	public function getArticleTypeAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $m_ArticleType = Factory::M("ArticleType");
        $total = $m_ArticleType->getArticleTypeTotal();
        $page_obj = new Page($total, $this->per);
        $pagelist = $page_obj->fpage(array( 0, 1, 2, 3, 4, 5, 6, 7, 8));
        $totalPage = ceil($total / $this->per);
        if ($page <= 0){
            $page = 1;
        }
        if ($page > $totalPage){
            $page = $totalPage;
        }
        $start = ($page - 1) * $this->per;
        $end = $this->per;
        $articleTypes = $m_ArticleType->getArticleTypes($start, $end);
        require "./app/back/view/admin/articleTypesPage.php";
		// 载入后台首页模板
//		require './app/back/view/admin/layout/nav.html';
//		require './app/back/view/admin/category_list.html';
	}
	public function showArticleTypeAction() {

		// 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/category_list.html';
	}
	public function addArticleTypeAction() {
		// 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/category_add.html';
	}
	public function addArticleTypeToSqlAction() {
	    $type_name = $_POST["type_name"];
	    $order = $_POST["order"];
	    $create_time = date("Y-m-d H:i:s");
        $m_ArticleType = Factory::M("ArticleType");
        $result = $m_ArticleType->addArticleType($type_name,$create_time,$order);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showArticleType');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=addArticleType', '插入失败', 1);
        }
	}
	public function updateArticleTypeAction() {
	    $type_name = $_POST["type_name"];
	    $order = $_POST["order"];
	    $type_id = $_POST["type_id"];
        $m_ArticleType = Factory::M("ArticleType");
        $result = $m_ArticleType->updateArticleType($type_name,$order,$type_id);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showArticleType');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=showArticleType', '修改失败', 1);
        }
	}
	public function deleteArticleTypeAction() {
	    $type_id = $_GET["type_id"];
        $m_ArticleType = Factory::M("ArticleType");
        $result = $m_ArticleType->deleteArticleType($type_id);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showArticleType');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=showArticleType', '插入失败', 1);
        }
	}
	public function showArticleAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $m_Article = Factory::M("Article");
        $m_articleType = Factory::M("ArticleType");
        $m_articleTag = Factory::M("ArticleTag");
        $tags = $m_articleTag->getAllArticleTag();
        $type_names = $m_articleType->getAllArticleType();
        $total = $m_Article->getArticleTotal();
        $page_obj = new Page($total, $this->per);
        $pagelist = $page_obj->fpage(array( 0, 1, 2, 3, 4, 5, 6, 7, 8));
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
		// 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/article_list.php';
	}
	public function addArticleAction() {
        $m_ArticleType = Factory::M("ArticleType");
        $type_names = $m_ArticleType->getAllArticleType();
        $m_articleTag = Factory::M("ArticleTag");
        $tags = $m_articleTag->getAllArticleTag();
		// 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/article_add.php';
	}
	public function deleteArticleAction() {
	    $id = $_GET["delete_id"];
        $m_Article = Factory::M("Article");
        $result = $m_Article->deleteArticle($id);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showArticle');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=showArticle', '删除失败', 1);
        }
	}
	public function addArticleToSqlAction() {
        $data['user_id'] = $_SESSION["admin"]["id"];
        $data['type_id'] = $_POST["type_id"];
        $data['title'] = $_POST["title"];
        $data['content'] = $_POST["content"];
        $data['summary'] = $_POST["summary"];
        $data['tag_id'] = $_POST["tag_id"];
        $data['create_time'] = date("Y-m-d H:i:s");
        $data['published_at'] = isset($_POST["published_at"]) ? $_POST["published_at"] : date("Y-m-d H:i:s");
        $data['state'] = $_POST["state"];
        $data['tag_id'] = $_POST["tag_id"];
        // 先为商品图片增加默认数据
        $data['imageUrl'] = '';
        $data['cover_image'] = '';
        // 上传文章封面图片
        $t_upload = new Upload();
        // 设置封面上传路径
        $t_upload->setUploadPath('./public/upload/article/cover/');
        // 开始上传
        $upload_result = $t_upload->uploadFile($_FILES['cover']);
        if ($upload_result) {
            // 上传成功
            $data['imageUrl'] = $upload_result;
        } else {
            // 上传失败
            $this->_jumpWait('index.php?m=back&c=Manage&a=addArticle', '上传图片失败，原因为：' . $t_upload->getErrorInfo());
        }

        $m_Article = Factory::M("Article");
        $result = $m_Article->addArticle($data);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showArticle');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=addArticle', '添加文章失败', 1);
        }
	}
	public function updateArticleAction() {
        $data['id'] = $_POST["article_id"];
        $data['type_id'] = $_POST["type_id"];
        $data['title'] = $_POST["title"];
        $data['content'] = $_POST["content"];
        $data['summary'] = $_POST["summary"];
        $data['tag_id'] = $_POST["tag_id"];
        $data['state'] = $_POST["state"];
        $data['published_at'] = $_POST["state"] == 1 ? date("Y-m-d H:i:s") :'';

        $m_Article = Factory::M("Article");
        $result = $m_Article->updateArticle($data);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showArticle');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=showArticle', '修改失败', 1.5);
        }
	}
	public function showTagAction() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $m_articleTag = Factory::M("ArticleTag");
        $total = $m_articleTag->getArticleTagTotal();
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
        $Tags = $m_articleTag->getArticleTags($start,$end);
        // 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/tag_list.php';
	}
	public function addTagAction() {

		// 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/tag_add.php';
	}
	public function addTagToSqlAction() {
        $data["tag_name"] = $_POST["tag_name"];
        $data["create_time"] = date("Y-m-d H:i:s");
        $m_ArticleTag = Factory::M("ArticleTag");
        $result = $m_ArticleTag->addArticleTag($data);

        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showTag');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=addTag', '插入失败', 1);
        }

		// 载入后台首页模板
		require './app/back/view/admin/layout/nav.html';
		require './app/back/view/admin/tag_add.php';
	}
    public function updateTagAction() {
        $data['tag_id'] = $_POST["tag_id"];
        $data['tag_name'] = $_POST["tag_name"];
        $m_ArticleTag = Factory::M("ArticleTag");
        $result = $m_ArticleTag->updateArticleTag($data);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showTag');
        }else{
            $this->_jumpNow('index.php?m=back&c=Manage&a=showTag');
//            $this->_jumpWait('index.php?m=back&c=Manage&a=showTag', '修改失败或者您没有做任何修改', 2);
        }
        // 载入后台首页模板
        require './app/back/view/admin/layout/nav.html';
        require './app/back/view/admin/tag_add.php';
    }
    public function deleteTagAction(){
        $delete_id = $_GET["delete_id"];
        $m_articleTag = Factory::M("ArticleTag");
        $result = $m_articleTag->deleteTag($delete_id);
        if ($result){
            $this->_jumpNow('index.php?m=back&c=Manage&a=showTag');
        }else{
            $this->_jumpWait('index.php?m=back&c=Manage&a=showTag', '删除失败', 2);
        }
    }

    public function topAction() {
		require './app/back/view/top.html';
	}
	public function menuAction() {
		require './app/back/view/menu.html';
	}
	public function dragAction() {
		require './app/back/view/drag.html';
	}
	public function mainAction() {
		require './app/back/view/main.html';
	}

}