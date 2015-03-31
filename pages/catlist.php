<div class="fnone">
<ul class="cat-list list-inline center-block col-sm-8">
    <?php
    foreach ($result_cat as $row):
        if ($row{'fa_style'}=='')
            $fa_style = "fa-folder";
        else
            $fa_style = $row{'fa_style'};

        echo "<li class='hvr-curl-top-right hvr-glow'><a href=\"/index.php?page=cat&catid=".$row{'id'}."\" class=\"hvr-fade-mod\">"
            ."<i class=\"cat-icon fa fa-4x ".$fa_style."\"></i><br/>".$row{'name'}.
            "</a></li>";
    endforeach
    ?>
</ul>
</div>

