<?php
/**  Administration Bootstrap */
header("Content-Security-Policy: default-src 'self' http://127.0.0.1:7474 'unsafe-inline'; frame-ancestors 'self' http://127.0.0.1:8080 http://127.0.0.1:7474; worker-src blob:; font-src 'self' data: http://127.0.0.1:8080; img-src 'self' http://2.gravatar.com;");


require_once __DIR__ . '/admin.php';
require_once ABSPATH . 'sr-admin/admin-header.php';
?>
<style>
    .wrap {
        text-align: center;
    }

    .wrap a {
        display: inline-block;
        padding: 15px 30px;
        background-color: #007bff; /* 背景颜色 */
        color: #fff; /* 文本颜色 */
        text-decoration: none; /* 去除下划线 */
        font-size: 18px; /* 字体大小 */
        border: 2px solid #007bff; /* 边框样式 */
        border-radius: 5px; /* 圆角边框 */
        transition: background-color 0.3s, color 0.3s; /* 平滑过渡效果 */
        margin-top:200px;

    /* 当鼠标悬停在链接上时的样式 */
    &:hover {
         background-color: #0056b3; /* 悬停时的背景颜色 */
         color: #fff; /* 悬停时的文本颜色 */
     }
    }
</style>

<div class="wrap">
    <a href="http://localhost:7474/">knowledge graph admin dashboard</a>
</div>


<?php
require_once ABSPATH . 'sr-admin/admin-footer.php';
?>
