<?php
$baseUrl = Yii::app()->baseUrl;
$detail = $this->createUrl('detail');
?>

<body class="g-x">
<div class="g-w">
    <div class="g-hd">
        <a href="<?php echo $baseUrl; ?>" class="g-logo">
            <h1></h1>
        </a>
        <ul class="g-nav">
            <li><a href="<?php echo "{$baseUrl}"; ?>" class="act">首页</a></li>
            <li><a href="<?php echo $detail; ?>"><span>低碳风‧行天下</span>抽奖活动</a></li>
            <li><a href="#">发电擂台赛</a></li>
            <li><a href="#">直流风扇产品介绍</a></li>
            <li><a href="#">微电影</a></li>
            <li class="noright"><a href="http://www.airmate-china.com" target="_blank">艾美特官网</a></li>
        </ul>
    </div>
    <div class="g-c">
        <img src="images/bg.jpg" usemap="#bg">
        <map name="bg" id="bg">
            <area shape="poly" coords="225,585,225,510,505,490,505,547,569,541,566,586,418,600,416,562" href="<?php echo $detail; ?>" alt="我要参加" title="低碳风‧行天下抽奖活动">
            <area shape="poly" coords="340,245,424,244,490,235,547,222,600,200,640,176,675,143,712,192,666,222,610,248,529,268,439,270,396,265" href="<?php echo $detail; ?>" alt="我要参加" title="低碳风‧行天下抽奖活动">
            <area shape="poly" coords="343,268,397,275,445,278,514,280,585,271,649,255,697,232,701,290,648,305,557,316,496,313,421,299,387,291" href="#" alt="发电擂台赛" title="发电擂台赛">
            <area shape="poly" coords="347,294,427,320,499,333,577,341,667,338,705,328,708,385,660,387,593,385,518,373,454,358,381,321" href="#" alt="直流风扇产品介绍" title="直流风扇产品介绍">
            <area shape="poly" coords="359,326,425,358,499,389,566,410,638,422,699,424,705,478,651,472,585,457,526,440,460,408,401,373" href="#" alt="微电影" title="微电影">
            <area shape="rect" coords="813,627,840,652" href="#" data-key="sinablog" title="分享到新浪微博">
            <area shape="rect" coords="844,627,870,652" href="#" data-key="qzone" title="分享到QQ空间">
            <area shape="rect" coords="873,627,899,652" href="#" data-key="txblog" title="分享到腾讯微博">
            <area shape="rect" coords="903,627,929,652" href="#" data-key="rr" title="分享到人人">
            <area shape="rect" coords="933,627,957,652" href="#" data-key="wy" title="分享到网易微博">
        </map>
    </div>
</div>
</body>