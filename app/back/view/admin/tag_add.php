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
                    标签添加
                    <small>标签</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php?m=back&c=Manage&a=index"><i class="fa fa-dashboard"></i> 管理中心</a></li>
                    <li><a href="index.php?m=back&c=Manage&a=showTag">标签</a></li>
                    <li class="active">标签添加</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <form action="index.php?m=back&c=Manage&a=addTagToSql" method="post">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <a href="index.php?m=back&c=Manage&a=showTag" class="btn btn-default pull-right">标签列表</a>
                                </div>
                                <!-- /.box-header -->

                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSubject">标签名称</label>
                                        <input type="text" name="tag_name" placeholder="标签名称" id="inputSubject" class="form-control">
                                    </div>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="btn btn-primary" type="submit" name="state" value="1">添加</button>
                                </div>
                        </div>
                                <!-- /.box-body -->

                                <!-- /.box-footer -->
                        </form>


                    </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->

            <section class="content-footer">
                <div class="text-center">
                    © 2016 All Rights Reserved. Diamondwang
                </div>
            </section>
            <!-- /.content-footer -->

        </aside>
            
            <!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="public/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="public/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="public/js/app.js" type="text/javascript"></script>

    </body>
</html>