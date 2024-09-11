<?php
/*
Template Name: DT - chartmap
*/
// Header
get_header();
$data = getMysqlData("SELECT meta_value, COUNT(*) AS count FROM wp_postmeta WHERE meta_key = 'Country' GROUP BY meta_value");

// Glossary
?>

<!-- 引入 ECharts 文件 -->
<script src="./js/echarts.min.js"></script>
<script src = "./js/world.js"></script>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="main" style="width: 1280px;height:720px;margin-left: 65px"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script>
    var myChart = echarts.init(document.getElementById('main'));

    var name_title = "World Map"
    var mapName = 'world'
    var data = [
        <?php
        foreach ($data as $item) {
            if ($item['meta_value'] == 'USA') {
                $item['meta_value'] = 'United States';
            }
            echo "{ name: '" . $item['meta_value'] . "', value: " . $item['count'] . " },";
        }
        ?>

    ];

    var option = {
        title: {
            text: name_title,
            x: 'center',
            textStyle: {
                fontSize: 24
            },
        },
        tooltip: {
            trigger: 'item',
            formatter: function(params) {
                var toolTiphtml = '';
                if (isNaN(params.value)){
                    toolTiphtml = params.name + 'has movie: 0';
                } else{
                    toolTiphtml = params.name + 'has movie: ' + params.value;
                }
                return toolTiphtml;
            }
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        visualMap: {
            show: true,
            left: 'left',
            top: 'bottom',
            seriesIndex: [0],
            type:'piecewise',
            pieces:[
                {min:101, color: 'rgb(254,57,101)'},
                {min:38, max:100, color: 'rgb(252,157,154)'},
                {min:15, max:37, color: 'rgb(249,205,173)'},
                {min:5, max:14, color: 'rgb(200,200,169)'},
                {min:1, max:4, color: 'rgb(131,175,155)'}
            ],
            textStyle: {
                color: '#000000'
            }
        },
        geo: {
            show: true,
            map: mapName,
            label: {
                normal: {
                    show: false,
                    fontSize:12,
                },
                emphasis: {
                    show: false,
                }
            },
            roam: true,
            itemStyle: {
                normal: {
                    areaColor: '#F6F6F6',
                    borderColor: '#666666',
                },
                emphasis: {
                    areaColor: '#0099CC',
                }
            }
        },
        series: [
            {
                type: 'map',
                map: mapName,
                geoIndex: 0,
                animation: false,
                data: data
            },
        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
</body>



<?php
// Footer
get_footer();
?>
