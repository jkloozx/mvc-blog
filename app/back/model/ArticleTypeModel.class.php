<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-10
 * Time: 下午5:20
 */
class ArticleTypeModel extends Model{
    public function getArticleTypes($start=0,$end=1) {
        $sql = "select * from article_type order by id desc limit $start,$end";
        return $this->_dao->fetchAll($sql);
    }
    public function getArticleNum($type_id) {
        $sql = "select count(*) from article where type_id=$type_id";
        return $this->_dao->fetchOne($sql);
    }
    public function getArticleTypeTotal() {
        $sql = "select count(*) from article_type";
        return $this->_dao->fetchOne($sql);
    }
     public function getAllArticleType() {
        $sql = "select id,type_name from article_type";
        return $this->_dao->fetchAll($sql);
    }
     public function getArticleTypeName($type_id) {
        $sql = "select type_name from article_type where id = $type_id";
        return $this->_dao->fetchOne($sql);
    }
    public function addArticleType($type_name,$create_time,$order) {
        $escape_type_name = $this->_dao->escapeString($type_name);
        $escape_create_time = $this->_dao->escapeString($create_time);
        $escape_order = $this->_dao->escapeString($order);
        $sql = <<< EOP
        insert into article_type 
        (`type_name`,`create_time`,`order`)
        values
        ($escape_type_name,$escape_create_time,$escape_order);
EOP;

        return $this->_dao->query($sql);
    }
    public function updateArticleType($type_name,$order,$type_id) {
        $escape_type_name = $this->_dao->escapeString($type_name);
        $escape_order = $this->_dao->escapeString($order);
        $sql = <<< EOP
        update article_type 
        set
        `type_name`=$escape_type_name,
        `order`=$escape_order
         where `id`=$type_id;
EOP;

        return $this->_dao->query($sql);
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