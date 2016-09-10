<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-10
 * Time: 下午5:20
 */
class ArticleModel extends Model{
    public function getArticles($start=0,$end=1) {
        $sql = <<< EOP
        select * from article as a
        left join article_type as t
        on a.type_id = t.id
        order by a.id desc limit $start,$end
EOP;

        return $this->_dao->fetchAll($sql);
    }
    public function getArticleTotal() {
        $sql = "select count(*) from article";
        return $this->_dao->fetchOne($sql);
    }
     public function getAllArticles() {
        $sql = "select * from article_type";
        return $this->_dao->fetchAll($sql);
    }
    public function addArticle($data=array()) {
        // 拼凑SQL，insert语法
        $sql = "INSERT INTO `article` VALUES (null, %s, %s, %s, %s, %s, %s, %s, %s, %s)";
        // 转义所有的数据 并 使用单引号包裹
        $escape_data = $this->_escapeArray($data);
        $sql = sprintf($sql, $escape_data['user_id'], $escape_data['type_id'], $escape_data['title'], $escape_data['imageUrl'], $escape_data['summary'], $escape_data['content'], $escape_data['tag_id'], $escape_data['create_time'], $escape_data['published_at']);

        // 执行
        return $this->_dao->query($sql);
    }

}