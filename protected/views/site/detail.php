<?php
$baseUrl = Yii::app()->getBaseUrl(true);
$activity = $this->createUrl('activity');
?>
<body class="g-x">
<div class="g-w">
    <div class="g-hd">
        <a href="<?php echo $baseUrl; ?>" class="g-logo">
            <h1></h1>
        </a>
        <ul class="g-nav">
            <li><a href="<?php echo $baseUrl; ?>">首页</a></li>
            <li><a href="<?php echo $activity; ?>" class="act"><span>低碳风‧行天下</span>抽奖活动</a></li>
            <li><a href="#">发电擂台赛</a></li>
            <li><a href="#">直流风扇产品介绍</a></li>
            <li><a href="#">微电影</a></li>
            <li class="noright"><a href="http://www.airmate-china.com" target="_blank">艾美特官网</a></li>
        </ul>
    </div>
    <div class="g-c">
        <img src="<?php echo "{$baseUrl}/images/bg3.jpg"; ?>" usemap="#bg3">
        <map name="bg3" id="bg3">
            <area shape="poly" coords="418,80,685,63,678,125,436,147" href="<?php echo $activity; ?>">
            <area shape="poly" coords="513,555,603,555,603,587,513,587" href="<?php echo $activity; ?>">
            <area shape="rect" coords="800,627,826,652" href="#" data-key="sinablog" title="分享到新浪微博">
            <area shape="rect" coords="830,627,856,652" href="#" data-key="qzone" title="分享到QQ空间">
            <area shape="rect" coords="860,627,886,652" href="#" data-key="txblog" title="分享到腾讯微博">
            <area shape="rect" coords="890,627,916,652" href="#" data-key="rr" title="分享到人人">
            <area shape="rect" coords="920,627,944,652" href="#" data-key="wy" title="分享到网易微博">
        </map>
    </div>
</div>
</body>