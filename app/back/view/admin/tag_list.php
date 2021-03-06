<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>管理中心_泰牛的博客</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="public/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="public/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="public/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="public/css/logo.css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="public/img/avatar04.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, ITbull</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="操作"/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php?m=back&c=Manage&a=index">
                                <i class="fa fa-dashboard"></i> <span>控制台</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th-large"></i> <span>分类</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?m=back&c=Manage&a=showArticleType"><i class="fa fa-list"></i>分类列表</a></li>
                                <li><a href="index.php?m=back&c=Manage&a=addArticleType"><i class="fa fa-edit"></i>分类添加</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file"></i> <span>文章</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?m=back&c=Manage&a=showArticle"><i class="fa fa-list"></i>文章列表</a></li>
                                <li><a href="index.php?m=back&c=Manage&a=addArticle"><i class="fa fa-edit"></i>文章添加</a></li>
                            </ul>
                        </li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-tag"></i> <span>标签</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?m=back&c=Manage&a=showTag"><i class="fa fa-list"></i>标签列表</a></li>
                                <li><a href="index.php?m=back&c=Manage&a=addTag"><i class="fa fa-edit"></i>标签添加</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

           <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        标签列表
                        <small>标签</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?m=back&c=Manage&a=index"><i class="fa fa-dashboard"></i> 管理中心</a></li>
                        <li><a href="index.php?m=back&c=Manage&a=showTag">标签</a></li>
                        <li class="active">标签列表</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <a href="index.php?m=back&c=Manage&a=addTag" class="btn btn-default pull-right">添加标签</a>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th>标签名称</th>
                                            <th>创建时间</th>
                                            <th style="width: 20%">操作</th>
                                        </tr>
                                        <?php  foreach ($Tags as  $tag) : ?>
                                            <tr>
                                                <td><?php echo $num++;?></td>
                                                <td><?php echo $tag["tag_name"];?></td>
                                                <td><?php echo $tag["create_time"];?></td>
                                                <td>
                                                    <button class="btn btn-default" data-toggle="modal" data-target="#edit_<?php echo $num;?>">
                                                        <span class="fa fa-edit"></span>编辑
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="edit_<?php echo $num;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <form method="post" action="index.php?m=back&c=Manage&a=updateTag" role="form">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title" id="myModalLabel">编辑标签信息</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <input type="hidden" name="tag_id" value="<?php echo $tag["id"];?>">
                                                                        <div class="form-group">
                                                                            <label for="inputSubject">标签名称</label>
                                                                            <input value="<?php echo $tag["tag_name"];?>" type="text" name="tag_name" placeholder="标签内容" id="inputSubject" class="form-control">
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
                                                    <a href="index.php?m=back&c=Manage&a=deleteTag&delete_id=<?php echo $tag["id"];?>" class="btn btn-default" title="删除" onclick="return confirm('是否删除？');"><span class="fa fa-trash-o"></span> 删除</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td style="text-align: center" colspan="6">
                                                共有 <?php echo $total;?>个记录
                                                每页显示 <?php echo $this->per;?>条
                                                <?php echo $page;?>/<?php echo $totalPage;?>页
                                                <a href="index.php?m=back&c=Manage&a=showTag&page=1">首页</a>
                                                <a href="index.php?m=back&c=Manage&a=showTag&page=<?php echo $page-1;?>">上一页</a>
                                                <a href="index.php?m=back&c=Manage&a=showTag&page=<?php echo $page+1;?>">下一页</a>
                                                <a href="index.php?m=back&c=Manage&a=showTag&page=<?php echo $totalPage;?>">尾页</a>
                                            </td>
                                        </tr>
                        </tbody></table>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                                                    </div>
                            </div>

                        </div>
                    </div>
                </section><!-- /.content -->

                <section class="content-footer">
                    <div class="text-center">
                       © 2016 All Rights Reserved. Diamondwang
                    </div>
                </section><!-- /.content-footer -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="public/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="public/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="public/js/app.js" type="text/javascript"></script>

    </body>
</html>