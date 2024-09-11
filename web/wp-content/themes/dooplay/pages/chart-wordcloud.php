<?php
/*
Template Name: DT - wordcloud
*/
// Header
get_header();
$data = getMysqlData("SELECT meta_value, COUNT(*) AS count FROM wp_postmeta WHERE meta_key = 'Country' GROUP BY meta_value");
$dataTxt = file_get_contents('./data/wordcloud.txt');
$dataTxt = explode("\n", $dataTxt);
$dataTxt = array_map(function ($item){
    $ex = explode(' ', $item);
    return [$ex[0], $ex[1]];
}, $dataTxt);
?>

<script src="./js/echarts.min.js"></script>
    <script src="./js/echarts-wordcloud.js"></script>
    <style>
        #main,#bg,#bg img{
            height:720px;
            width:1280px;
            margin-left: 85px;
            margin-top: 5px;
            top: 5px;
        }

    </style>


<body>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="main"></div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script>
    var myChart=echarts.init(document.getElementById("main"));
    var maskImage=new Image();
    maskImage.crossOrigin = "Anonymous";
    maskImage.src='./images/logo.png';

    var option={
        tooltip: {},
        series: [ {
            type: 'wordCloud',
            gridSize: 2,
            sizeRange: [15, 45],
            rotationRange: [-60, 60],
            rotationStep: 1,
            width:'100%',
            height:'100%',
            shape: 'pentagon',
            maskImage:maskImage,
            drawOutOfBound:false,
            textStyle: {
                normal: {
                    color: function () {
                        return 'rgb(' + [
                            Math.round(Math.random() * 160),
                            Math.round(Math.random() * 160),
                            Math.round(Math.random() * 160)
                        ].join(',') + ')';
                    }
                },
                emphasis: {
                    shadowBlur: 10,
                    shadowColor: '#333'
                }
            },
            data:[
                <?php
                foreach ($dataTxt as $item ){
                    echo "{name:'". $item[1] ."',value:".$item[0]."},";
                }
                ?>
            ]
        }]

    };
    maskImage.onload=function(){
        option.series[0].maskImage;
        myChart.setOption(option);
    }

</script>



</body>




<?php
// Footer
get_footer();
?>
