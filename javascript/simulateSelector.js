/**
 * Created with JetBrains WebStorm.
 * UserTo:
 * Date: 12-5-10
 * Time: 上午10:28
 */
;(function($){
    /*
     * 统一select样式并实现样式高度自定义的jQuery插件@Mr.Think(http://mrthink.net/)
     */
    $.fn.iSimulateSelect=function(iSet){
        iSet=$.extend({
            selectBoxCls:'sim-box', //string类型,外围class名
            curSCls:'sim-selector',//string类型,默认显示class名
            optionCls:'sim-opt',//string类型,下拉列表class名
            selectedCls:'selected',//string类型,当前选中class名
            width:90,//number类型，模拟select的宽度
            height:200,//number类型，模拟select的最大高度
            zindex:20//层级顺序
        },iSet||{});
        this.hide();
        return this.each(function(){
            var self=this;
            var thisCurVal,thisSelect,cIndex=0;
            //计算模拟select宽度
            if(iSet.width==0){
                iSet.width=$(self).width();
            }
            var html='<div class="'+iSet.selectBoxCls+'" style="z-index:'+iSet.zindex+'"><div class="'+iSet.curSCls+'" style="width:'+iSet.width+'px">'+$(self).find('option:selected').text()+'</div><dl class="'+iSet.optionCls+'" style="display:none;width:'+iSet.width+'px">';
            //判断select中是否有optgroup
            //用dt替代optgroup，用dd替代option
            if($(self).find('optgroup').size()>0){
                $(this).find('optgroup').each(function(){
                    html+='<dt>'+$(this).attr('label')+'</dt>';
                    $(this).find('option').each(function(){
                        if($(this).is(':selected')){
                            html+='<dd class="'+iSet.selectedCls+'">'+$(this).text()+'</dd>';
                        }else{
                            html+='<dd>'+$(this).text()+'</dd>';
                        }
                    });
                });
            }else{
                $(this).find('option').each(function(){
                    if($(this).is(':selected')){
                        html+='<dd class="'+iSet.selectedCls+'">'+$(this).text()+'</dd>';
                    }else{
                        html+='<dd>'+$(this).text()+'</dd>';
                    }
                });
            }
            //将模拟dl插入到select后面
            $(self).after(html);
            //当前模拟select外围box元素
            thisBox=$(self).next('.'+iSet.selectBoxCls);
            //当前模拟select初始值元素
            thisCurVal=thisBox.find('.'+iSet.curSCls);
            //当前模拟select列表
            thisSelect=thisBox.find('.'+iSet.optionCls);
            /*
             若同页面还有其他原生select,请前往https://github.com/brandonaaron/bgiframe下载bgiframe，同时在此处调用thisSelect.bgiframe()
             */
            //thisSelect.bgiframe();
            //弹出模拟下拉列表
            thisCurVal.click(function(){
                if(thisSelect.is(":hidden")){
                    $('.'+iSet.optionCls).hide();
                    $('.'+iSet.selectBoxCls).css('zIndex',iSet.zindex);
                    $(self).next('.'+iSet.selectBoxCls).css('zIndex',iSet.zindex+1);
                    thisSelect.show();
                }else{
                    thisSelect.hide();
                }
            });
            //若模拟select高度超出限定高度，则自动overflow-y:auto
            if(thisSelect.height()>iSet.height){
                thisSelect.height(iSet.height);
            }
            //模拟列表点击事件-赋值-改变y坐标位置-...
            thisSelect.find('dd').bind("click",function(){
                $(this).addClass(iSet.selectedCls).siblings().removeClass(iSet.selectedCls);
                cIndex=thisSelect.find('dd').index(this);
                thisCurVal.text($(this).text());
                self.value = $(this).text();
               // $(self).find('option').eq(cIndex).attr('selected','selected');
                $('.'+iSet.selectBoxCls).css('zIndex',iSet.zindex);
                thisSelect.hide();
            });
            //非模拟列表处点击隐藏模拟列表
            //$(document)点击事件不兼容部分移动设备
            $('html,body').click(function(e){
                if(e.target.className.indexOf(iSet.curSCls)==-1){
                    thisSelect.hide();
                    $('.'+iSet.selectBoxCls).css('zIndex',iSet.zindex);
                }
            });
            //取消模块列表处取消默认事件
            thisSelect.click(function(e){
                e.stopPropagation();
            });
        });
    }
})(jQuery);
