<?php
/**
 * Created by PhpStorm.
 * User: lhw
 * Date: 16-9-10
 * Time: 上午9:07
 */
echo <<< EOP
        <table class="table table-bordered">
        <tbody><tr>
        <th style="width: 10px">#</th>
        <th>分类</th>
        <th>文章数量</th>
        <th>排序</th>
        <th style="width: 20%">操作</th>
        </tr>
EOP;
$num = $start + 1;
foreach ($articleTypes as $articleType) {
//    $messageId = $message["id"];
//    $messageContent = $message["content"];
    $type_id = $articleType["id"];
    $type_name = $articleType["type_name"];
    $order = $articleType["order"];
    echo "<tr>";
    echo "<td>" . $num++ . "</td>";
    echo "<td>" . $articleType["type_name"] . "</td>";
    echo "<td>" . $m_ArticleType->getArticleNum($articleType["id"]) . "</td>";
    echo "<td>" . $articleType["order"] . "</td>";
    echo <<< EOP
            <td>
            <button class="btn btn-primary btn-default" data-toggle="modal" data-target="#edit_$num">
            编辑
            </button>
<!-- Modal -->
<div class="modal fade" id="edit_$num" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form method="post" action="index.php?m=back&c=Manage&a=updateArticleType" role="form">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">编辑分类信息</h4>
      </div>
      <div class="modal-body">
        
    <input type="hidden" name="type_id" value="$type_id">
  <div class="form-group">
    <label for="exampleInputEmail1">分类名称</label>
    <input value="$type_name" name="type_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="分类名称">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">排序</label>
    <input value="$order" name="order" type="number" class="form-control" id="exampleInputPassword1" placeholder="排序">
  </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">提交更改</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<a href="#" class="btn btn-default" title="删除" onclick="return confirm('是否删除？');"><span class="fa fa-trash-o"></span> 删除</a>
            </td>
EOP;

    echo "</tr>";

}
echo "<tr style='text-align: center'><ul class='pagination'><td colspan='5'>$pagelist</td></ul></tr>";
echo "</table>";