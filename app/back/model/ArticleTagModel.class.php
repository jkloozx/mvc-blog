<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-10
 * Time: 下午5:20
 */
class ArticleTagModel extends Model{
    public function getArticleTags($start=0,$end=1) {
        $sql = <<< EOP
        select * from article_tag
        order by id desc
        limit $start,$end
EOP;

        return $this->_dao->fetchAll($sql);
    }
    public function getArticleTagTotal() {
        $sql = "select count(*) from article_tag";
        return $this->_dao->fetchOne($sql);
    }
     public function getAllArticleTag() {
        $sql = "select id,tag_name from article_tag";
        return $this->_dao->fetchAll($sql);
    }
     public function deleteTag($id) {
        $sql = "delete from article_tag where id=$id";
        return $this->_dao->query($sql);
    }
    public function addArticleTag($data=array()) {
        // 拼凑SQL，insert语法
        $sql = "INSERT INTO `article_tag` VALUES (null, %s, %s)";
        // 转义所有的数据 并 使用单引号包裹
        $escape_data = $this->_escapeArray($data);
        $sql = sprintf($sql, $escape_data['tag_name'], $escape_data['create_time']);

        // 执行
        return $this->_dao->query($sql);
    }
    public function updateArticleTag($data=array()) {
        // 拼凑SQL，update语法
        $escape_data = $this->_escapeArray($data);
        $sql = <<< EOP
            update article_tag
            set
            `tag_name`=%s
            where `id`=%s
EOP;

        // 转义所有的数据 并 使用单引号包裹

        $sql = sprintf($sql, $escape_data['tag_name'], $escape_data['tag_id']);        // 执行
        return $this->_dao->query($sql);
    }

}