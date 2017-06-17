/**
 * Created by seiryuukyuu on 2017/6/14.
 */
$(function () {
    const myChart = echarts.init(document.getElementById('summary'));
    const option = {
        title : {
            text: '协议概览',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} : {b}<br/>{c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: []
        },
        series : [
            {
                name: '协议',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    const convert = new Vue({
        el:'#content',
        data:{
            url:'',
            shortKey:'',
            shortUrl:'',
            err_msg:''
        },
        methods:{
            onSubmit: function () {
                const me = this;
                $.get('/api/token','',function (token) {
                   $.post('/api/create',{_token:token,url:me.url,shortKey:me.shortKey},function (data) {
                       me.shortUrl = data.url;
                       if(data.status_code === 200){
                           me.err_msg = '';
                           me.reloadChart();
                       }else {
                           me.err_msg = data.message;
                       }
                   });
                });
            },
            reloadChart: function () {
                const me = this;
                myChart.showLoading();
                setTimeout(function(){
                    $.get('/api/summary','', function(data){
                        const info = '已为' + data.summary.sites + '个站点转换' + data.summary.total + "个链接";
                        option.legend.data = data.summary.scheme.names;
                        option.series[0].data = data.summary.scheme.data;
                        option.title.text = info;
                        myChart.hideLoading();
                        myChart.setOption(option);
                    });
                },150);
            }
        }
    });
    convert.reloadChart();
});
