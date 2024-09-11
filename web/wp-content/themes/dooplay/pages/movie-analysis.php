<?php
/*
Template Name: DT - movieanalysis
*/
// Header
get_header();
$data = getMysqlData("SELECT meta_value, COUNT(*) AS acount FROM wp_postmeta WHERE meta_key = 'Country' and meta_value != 'Unknown' and meta_value != 'Hong Kong' GROUP BY meta_value HAVING acount > 50 order by acount desc");
$colors = ['#a90000', '#62B7D7', '#F15B5E', '#4B62BB', '#80C66F', '#FBC259', '#ff0000', '#ff0a00'];
$jsData = [];
foreach ($data as $item) {
    $jsData[] = [
        'value' => (int)$item['acount'],
        'itemStyle' => [
            'color' => array_shift($colors),
        ],
    ];
}
$jsDataString = json_encode($jsData);

$c1data = '[';
foreach ($data as $item) {
    $c1data .=  '"' . $item['meta_value'] . '",';
}
$c1data .= ']';

$home_topmovies = getTopMovieIds(5, 20, 'DESC', 100);
$home_topmovies = array_slice($home_topmovies, 0, 10);
$queryIds = '(' . implode(',', $home_topmovies) . ')';
$top5 = getMysqlData("SELECT post_title from wp_posts where ID in $queryIds");


$genres = doo_li_genres_without_html();


$average_rating = getMysqlData("SELECT AVG(CAST(meta_value AS DECIMAL(10, 2))) AS average_rating FROM wp_postmeta WHERE meta_key ='_starstruck_avg'");
?>

<style>
    .container-top-level1 {
        display: flex;
    }

    .box {
        width: 640px;
        height: 520px;
        margin-left: 90px
    }

</style>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div class="container">
    <style>
        #chart-container {
            position: relative;
            height: 80vh;
            overflow: hidden;
        }
    </style>
    <div class="container-top-level1">

        <div id="chart-container" class="box" style="height: 500px"></div>

        <script src="https://fastly.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
        <script>
            var dom = document.getElementById('chart-container');
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option;

            option = {
                title: {
                    text: 'Countries with more than 50 movies'
                },
                xAxis: {
                    type: 'category',
                    data: <?php echo $c1data; ?>
                },
                tooltip: {
                    formatter: '{b} : {c}'
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        data: <?php echo $jsDataString; ?>,
                        type: 'bar'
                    }
                ]
            };

            if (option && typeof option === 'object') {
                myChart.setOption(option);
            }

            window.addEventListener('resize', myChart.resize);
        </script>


        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <style>
            #chart-container2 {
                position: relative;
                height: 80vh;
                overflow: hidden;
            }
        </style>
        <div id="chart-container2" class="box"  style="height: 500px"></div>
    </div>
    <script>
        var dom = document.getElementById('chart-container2');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var app = {};

        var option;

        option = {
            title: {
                text: "Top5 most rated",
            },
            legend:{
                show: true,
                top:"7%"
            },
            tooltip: {
                trigger: 'item',
                formatter: '{b}'
            },
            toolbox: {
                feature: {}
            },
            series: [
                {
                    name: 'Funnel',
                    type: 'funnel',
                    left: '10%',
                    top: 68,
                    bottom: 60,
                    width: '80%',
                    min: 0,
                    max: 100,
                    minSize: '0%',
                    maxSize: '100%',
                    sort: 'descending',
                    gap: 2,
                    label: {
                        show: true,
                        position: 'inside'
                    },
                    labelLine: {
                        length: 100,
                        lineStyle: {
                            width: 1,
                            type: 'solid'
                        }
                    },
                    itemStyle: {
                        borderColor: '#fff',
                        borderWidth: 1
                    },
                    emphasis: {
                        label: {
                            fontSize: 20
                        }
                    },
                    data: [
                        <?php
                        $v = 100;
                        foreach ($top5 as $item) {
                            if (strpos($item['post_title'], ':') !== false) {
                                $parts = explode(':',  $item['post_title'], 2);
                                $title = trim($parts[0]);
                            } else {
                                $title = trim($item['post_title']);
                            }
                            if (strpos($title, '|') !== false) {
                                $parts = explode('|',  $title, 2);
                                $title = trim($parts[0]);
                            } else {
                                $title = trim($title);
                            }
                            echo "{value: " . $v . ", name: ' " . $title. "'},";$v -= 20;
                        }
                        ?>
                    ]
                }
            ]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>


    <div class="container-top-level1" >

        <div id="chart-container3" class="box"></div>
        <style>
            #chart-container3 {
                position: relative;
                height: 80vh;
                overflow: hidden;
            }
        </style>
        <script>
            var dom = document.getElementById('chart-container3');
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });
            var app = {};

            var option;

            option = {
                title: {
                    text: 'Average movie score'
                },
                tooltip: {
                    formatter: '{b} : {c}'
                },
                series: [
                    {
                        name: 'Pressure',
                        type: 'gauge',
                        progress: {
                            show: true
                        },
                        detail: {
                            valueAnimation: true,
                            formatter: '{value}'
                        },
                        data: [
                            {
                                value: <?php echo number_format($average_rating[0]['average_rating'], 2); ?>,
                                name: 'SCORE'
                            }
                        ],
                        min:0,
                        max: 10
                    }
                ]
            };

            if (option && typeof option === 'object') {
                myChart.setOption(option);
            }

            window.addEventListener('resize', myChart.resize);
        </script>


        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <div id="chart-container4" class="box"></div>
    </div>

    <style>
        #chart-container4 {
            position: relative;
            height: 80vh;
            overflow: hidden;
        }
    </style>
    <script>
        var dom = document.getElementById('chart-container4');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var app = {};

        var option;

        option = {
            title: {
                text: 'Number of genres'
            },
            legend: {
                top: 'bottom'
            },
            tooltip: {
                formatter: '{b} : {c}'
            },
            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                }
            },
            series: [
                {
                    name: 'Nightingale Chart',
                    type: 'pie',
                    radius: [50, 250],
                    center: ['50%', '50%'],
                    roseType: 'area',
                    itemStyle: {
                        borderRadius: <?php echo count($genres); ?>
                    },
                    data: [
                        <?php
                        foreach ($genres as $item) {
                            echo "{value: " .$item->category_count. ", name: '".$item->name."'},";
                        } ?>
                    ]
                }
            ]
        };

        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>

</body>

<?php
// Footer
get_footer();
?>
