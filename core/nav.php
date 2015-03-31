<nav class="navbar navbar-default navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">ООО "Волна-К". Сертификаты</a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="http://localhost/">В начало</a>
                </li>
                <!--<li>
                    <a href="/index.php?page=catlist">Категории</a>
                </li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($result_cat as $row):
                            if ($row{'fa_style'} == '')
                                $fa_stl = "fa-folder";
                            else
                                $fa_stl = $row{'fa_style'};

                            echo "<li><a href=\"index.php?page=cat&catid=" . $row{'id'} . "\"><i class=\"fa " . $fa_stl . "\"></i> " . $row{'name'} . "</a></li>";
                        endforeach
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Дополнительно <i class="caret"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="/index.php?page=add">Добавить сертификат</a></li>
                        <li><a href="/index.php?page=addinf">Добавить информацию</a></li>
                        <li class="divider"></li>
                        <li><a href="/index.php?page=outdate">Просроченные</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Оформление<i class="caret"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="?css=<?php echo $lightcss;?>">Light</a></li>
                        <li><a href="?css=<?php echo $darkcss;?>">Dark</a></li>
                        <li><a href="?css=<?php echo $default;?>">Default</a></li>
                    </ul>
                </li>
            </ul>
            <div class="col-sm-3 col-md-3 pull-right">
                <form class="navbar-form" role="search" method="post" action="pages/do-search.php">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="search" id="search_box">

                        <div class="input-group-btn">
                            <button class="btn btn-default search_button" type="submit"><i
                                    class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

    </div>

</nav>