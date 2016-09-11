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
        select username, imageUrl, a.id as article_id,
        user_id,type_id,title,summary,tag_name,
        content,tag_id,a.create_time,
        state,t.id as type_id,type_name,
        g.tag_name
        from article as a
        left join article_type as t
        on a.type_id = t.id
        left join article_tag as g
        on a.tag_id = g.id
        left join admin
        on a.user_id = admin.id
        where state=1
        order by a.published_at desc limit $start,$end
EOP;

        return $this->_dao->fetchAll($sql);
    }
    public function searchArticle($start=0,$end=1,$search) {
        $sql = <<< EOP
        select username, imageUrl, a.id as article_id,
        user_id,type_id,title,summary,tag_name,
        content,tag_id,a.create_time,
        state,t.id as type_id,type_name,
        g.tag_name
        from article as a
        left join article_type as t
        on a.type_id = t.id
        left join article_tag as g
        on a.tag_id = g.id
        left join admin
        on a.user_id = admin.id
        where state=1
        and
        (
        a.title like '%$search%'
        or
        a.summary like '%$search%'
        or
        g.tag_name like '%$search%'
        or
        t.type_name like '%$search%'
        )
        order by a.published_at desc limit $start,$end
EOP;
        return $this->_dao->fetchAll($sql);
    }
    public function getArticleTotal() {
        $sql = "select count(*) from article where state=1";
        return $this->_dao->fetchOne($sql);
    }
     public function getSearchTotal($search) {
        $sql = <<< EOP
        select count(*) from
        article as a
        left join article_tag as g
        on a.tag_id = g.id
        left join article_type as t
        on a.type_id = t.id
        where state=1
        and
        (
        a.title like '%$search%'
        or
        a.summary like '%$search%'
        or
        g.tag_name like '%$search%'
        or
        t.type_name like '%$search%'
        )
EOP;
//die(var_dump($sql));
        return $this->_dao->fetchOne($sql);
    }
     public function getAllArticles() {
        $sql = "select * from article_type";
        return $this->_dao->fetchAll($sql);
    }
     public function getLatestArticles($per) {
        $sql = "select title,create_time from article order by id desc limit 0,$per";
        return $this->_dao->fetchAll($sql);
    }
     public function deleteArticle($id) {
        $sql = "delete from article where id=$id";
        return $this->_dao->query($sql);
    }
    public function addArticle($data=array()) {
        // 拼凑SQL，insert语法
        $sql = "INSERT INTO `article` VALUES (null, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)";
        // 转义所有的数据 并 使用单引号包裹
        $escape_data = $this->_escapeArray($data);
        $sql = sprintf($sql, $escape_data['user_id'], $escape_data['type_id'], $escape_data['title'], $escape_data['imageUrl'], $escape_data['summary'], $escape_data['content'], $escape_data['tag_id'], $escape_data['create_time'], $escape_data['published_at'], $escape_data['state']);

        // 执行
        return $this->_dao->query($sql);
    }
    public function updateArticle($data=array()) {
        // 拼凑SQL，update语法
        $escape_data = $this->_escapeArray($data);
        $sql = <<< EOP
            update article
            set
            `type_id`=%s,
            `title`=%s,
            `summary`=%s,
            `content`=%s,
            `tag_id`=%s,
            `state`=%s
            where `id`=%s
EOP;

        // 转义所有的数据 并 使用单引号包裹

        $sql = sprintf($sql, $escape_data['type_id'], $escape_data['title'], $escape_data['summary'],$escape_data['content'], $escape_data['tag_id'], $escape_data['state'], $escape_data['id']);
        // 执行
        return $this->_dao->query($sql);
    }

}