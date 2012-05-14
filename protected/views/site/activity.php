<?php 
$baseUrl = Yii::app()->getBaseUrl(true);
$detail = $this->createUrl('detail');
$lotteryDraw = $this->createUrl('lotteryDraw');
?>
<body class="g-x">
<div class="tips-wrap" id="tips">
    <div class="bg"></div>
    <table class="tips-content">
        <tr>
            <td class="tl"></td>
            <td class="bg2"><a class="clz" id="clz" href="#"></a></td>
            <td class="tr"></td>
        </tr>
        <tr>
            <td class="bg2"></td>
            <td class="bg2 tips-box"></td>
            <td class="bg2"></td>
        </tr>
        <tr>
            <td class="bl"></td>
            <td class="bg2"></td>
            <td class="br"></td>
        </tr>
    </table>
</div>
<div class="g-w">
    <div class="g-hd">
        <a href="<?php echo $baseUrl; ?>" class="g-logo">
            <h1></h1>
        </a>

        <ul class="g-nav">
            <li><a href="<?php echo $baseUrl; ?>">首页</a></li>
            <li><a href="<?php echo $detail; ?>" class="act"><span>低碳风‧行天下</span>抽奖活动</a></li>
            <li><a href="#">发电擂台赛</a></li>
            <li><a href="#">直流风扇产品介绍</a></li>
            <li><a href="#">微电影</a></li>
            <li class="noright"><a href="http://www.airmate-china.com" target="_blank">艾美特官网</a></li>
        </ul>
    </div>
    <div class="g-c2">

        <img src="images/bg2.jpg" usemap="#bg3">
        <map name="bg3" id="bg3">
            <area shape="poly" coords="263,313,298,313,298,333,263,333" href="http://weibo.com/airmatecorp" target="_blank">
            <area shape="rect" coords="803,628,828,653" href="#" data-key="sinablog" title="分享到新浪微博">
            <area shape="rect" coords="831,628,857,653" href="#" data-key="qzone" title="分享到QQ空间">
            <area shape="rect" coords="860,628,886,653" href="#" data-key="txblog" title="分享到腾讯微博">
            <area shape="rect" coords="890,628,916,653" href="#" data-key="rr" title="分享到人人">
            <area shape="rect" coords="922,628,947,653" href="#" data-key="wy" title="分享到网易微博">
        </map>
        <form id="form" name="lotteryDraw" method="post" action="<?php echo $lotteryDraw; ?>">
            <input type="text" id="name" class="input1" name="Customer[name]">
            <input type="text" id="phone" class="input1" name="Customer[num_phone]">
            <div class="province">
                <select id="province" name="Customer[province]"></select>
            </div>
            <div class="city">
                <select id="city" class="hide" name="Customer[city]"></select>
            </div>
            <input type="text" class="input1" id="area" name="Customer[address]">
            <input type="text" class="input1" id="card" name="Customer[num_card]">
            <input type="text" class="input1" id="product" name="Customer[num_product]">
            <input type="text" class="input3" id="number" name="Customer[num_flow]">
            <a id="example" href="" style="display: block;background-color: #fff;"></a>
            <img id="exampleImage" src="images/example.png" style="display: none;position: absolute;z-index: 1024;width: 208px;height: 109px;">
            <input type="submit" id="submit" title="填完资料后,点击提交抽奖" style="display: block;background-color: #fff;cursor: pointer;">
            <script type="text/javascript">$('#example').css('opacity', 0);$('#submit').css('opacity', 0);</script>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".province,.city").bind("selectstart",function(){return false;})
        area.init();
        /*all-not null name:中文2-8,en:\s2-32 phone \d5-14 card [a-z]14 type not null number:\d[A-Z]15-18 area [10,n]*/
        $.validator.addMethod('nameRule',function(value,element){
            return /^([\u4e00-\u9fa5]{2,8}|[a-zA-Z\s]{2,32})$/.test(value)
        },"名字格式为2-8个中文或者2-32个英文");
        $.validator.addMethod('phoneRule',function(value,element){
            return /^(13|14|15|18)\d{9}$/.test(value)
        },"手机号码格式为11位数字");
        $.validator.addMethod('cardRule',function(value,element){
            return /^[\da-z]{14}$/.test(value)
        },"卡片号码格式为14位的小写字母");
        $.validator.addMethod('numberRule',function(value,element){
            return /^[\dA-Z]{15,18}$/.test(value)
        },"机身流水码格式为15-18个数字、大写字母");
        $.validator.addMethod('areaRule',function(value,element){
            return /^[\u0000-\uffff]{10,}$/.test(value)
        },"联系地址格式为10个以上的字符");
        $("#form").validate({
            submitHandler: function(form) {
                var url = $('#form').attr('action');
                $.post(url, $(form).serialize(), function(json){
                    if(json.state == '200'){
                        json.mark ? Tips.show(1,json.mark):Tips.show(0);

                    }else if(json.state == '404'){
                           Tips.show(2,Tips._serilaError(json.errors));
                    }
                }, 'json');

                //Tips.show(0);  表示成功
                //Tips.show(1);  表示失败
                /*alert("abc");*/
            },
            rules:{
                'Customer[name]':{
                    required:true,
                    nameRule:true
                },
                'Customer[num_phone]':{
                    required:true,
                    phoneRule:true
                },
                'Customer[province]':'required',
                'Customer[city]':'required',
                'Customer[address]':{
                    required:true,
                    areaRule:true
                },
                'Customer[num_card]':{
                    required:true,
                    cardRule:true
                },
                'Customer[num_product]':{
                    required:true
                },
                'Customer[num_flow]':{
                    required:true,
                    numberRule:true
                }
            },
            messages:{
                'Customer[name]':{
                    required:"请输入您的姓名"
                },
                'Customer[num_phone]':{
                    required:"请输入您的手机号码"
                },
                'Customer[province]':{
                    required:'请选择您现在居住的省份'
                },
                'Customer[city]':{
                    required:'请选择您现在居住的城市'
                },
                'Customer[address]':{
                    required:"请输入您的详细地址"
                },
                'Customer[num_card]':{
                    required:"请输入抽奖卡卡号（只能使用一次）"
                },
                'Customer[num_product]':{
                    required:"请输入产品型号"
                },
                'Customer[num_flow]':{
                    required:"请输入机身流水码（只能使用一次）"
                }
            },
            onfocusout:false,
            onkeyup:false,
            onclick:false,
            showErrors:function(errorMap,errorList){
                if(!errorList.length) return false;
                Tips.show(2,Tips._serilaError(errorMap));
            }
        })
        var example = $('#example');
        var position = example.position();
        var left = position.left;
        var top = position.top;
        var width = example.width();
        var _img = example.next();
        var imgWidth = _img.width();
        var imgHeight = _img.height();
        var imgLeft = left - (imgWidth - width) / 2;
        var imgTop = top - imgHeight - 2;
        _img.css({left: imgLeft, top: imgTop});
        $("#example").bind("click",function(event){
            event.preventDefault();
            _img.toggle();
        }).bind("mouseleave",function(){
             _img.hide();
        });
        /*$("#example>img").bind("mouseenter",function(){
            clearTimeout(_timer);
            _img.show();
        }).bind("mouseleave",function(){
            _timer =setTimeout(function(){_img.hide()},300)
        });*/
    })
    //下面的都不用看。。。只是一些调用的东西
    var Tips = (function(){
        var _tips = $("#tips").css({"height":$("html")[0].scrollHeight});
        var _content = _tips.find("table");
        var _box = _tips.find(".tips-box");
        var _form = $("#form")
        $("#clz").bind("click",function(){
            _tips.hide();
        })
        $(".error-list li").live("click",function(){
            _tips.hide();
            $($(this).attr("data-rel")).focus();
        })
        return {
            _serilaError:function(json){
                var _str = '<div class="error-title">抱歉！麻烦您修正以下的问题</div>'
                        + '<ol class="error-list">';
                for(var item in json){
                    _str += '<li data-rel="#'+item+'">'+(json[item].constructor === Array ? json[item][0] : json[item])+'</li>'
                }
                _str += '</ol>';
                return _str;
            },
            _suc:function(_type){
                return $('<div class="result-suc"><img src="images/success.png"><div class="award">'+(_type==1?'恭喜你中奖了！<br>获得爱骑行奖 <i>莫曼顿自行车isee310</i> 一台':'恭喜你中奖了！<br>获得爱低碳奖 <i>莫曼顿自行车Nulife</i> 一台')+'</div><div>获奖者注意：</div><p>亲爱的客户，<strong>恭喜您获得莫曼顿自行车 '+(_type == 1?"See310":"Nulife")      +'</strong>，即将让您尽情享受低碳出行的健康生活，为了给您提供更优质的服务并确定您领奖资格，请点击 <a href="'+(_type == 1?"<?php echo "{$baseUrl}/download/see310detail.doc"; ?>":"<?php echo "{$baseUrl}/download/nulifedetail.doc"; ?>") +'">下载word文档</a> 填写完成后并用电子邮件寄到艾美特总部企划部张先生邮箱：（50674@airmate-china.net）如有疑问请联系电话：0755-27655988-8112</p></div>')},
            _fail:$('<div class="result-fail"><img src="images/fail.png"><p>谢谢参与,再接再厉</p></div>'),
            /**
             *
             * @param num :to switch the result
             * @param html :content
             */
            show:function(num,html){
                var _h = $(window).height();
                var _w = $(window).width();
                switch(num){
                /**
                 * 0 fail
                 * 1 success
                 * 2 errors*/
                    case 0:
                        _box.html(this._fail)
                        _content.css({"top":(_h-371)/2,"left":(_w-584)/2});
                        break;                             case 1:
                    _box.html(this._suc(html));
                    _content.css({"top":(_h-401)/2,"left":(_w-584)/2});
                    break;
                    case 2:
                        _box.html(html);
                        _content.css({"top":_form.offset().top-60,"left":_form.offset().left-104,width:351,height:260});
                        break;
                }
                _tips.show();
            }
        }
    }());

    var area = (function(){
        function buildOpt(data){
            var _arr = [];
            if(data.constructor == Array){
                for(var _i = 0,_len = data.length;_i<_len;_i++){
                    if(0 == _i)
                    {
                        _arr.push('<option>'+data[_i]+'</option>');
                    }
                    else
                    {
                        _arr.push('<option value="'+data[_i]+'">'+data[_i]+'</option>');
                    }

                }
            }else{
                /*$.each(data, function(index, value){
                    if(0 == index)
                    {
                        _arr.push('<option>'+value+'</option>');
                    }
                    else
                    {
                        _arr.push('<option value="'+value+'">'+value+'</option>');
                    }
                });*/
                for(var item in data){
                    if(item === '省/直辖市')
                    {
                        _arr.push('<option>'+item+'</option>');
                    }
                    else
                    {
                        _arr.push('<option value="'+item+'">'+item+'</option>');
                    }
                }
            }
            return _arr.join("");
        }
        var _pro = $("#province");
        var _city = $("#city");
        return {
            init:function(){
                this._makeProvince(buildOpt(AREA));
                this._events();
            },
            _makeProvince:function(pStr){
                _pro.html(pStr);
                _pro.iSimulateSelect()
            },
            _events:function(){
                var _dd = _pro.next().find("dd")
                var _init = _dd.eq(0);
                _dd.bind("click",function(){
                    _init.remove();
                    _city.next().remove();
                    _city.html(buildOpt(AREA[$(this).text()]));
                    _city.iSimulateSelect();
                })
                _init.trigger("click");
            }
        };
    }());
</script>
</body>