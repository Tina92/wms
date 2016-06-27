<header class="am-topbar">
    <h1 class="am-topbar-brand">
        <a href="#">研发中心 — 工单协同管理系统</a>
    </h1>

        <div class="am-topbar-right">
            <a href="<?=DOCUMENT_ROOT?>/?g=Ticket&m=Login&a=index" class="am-btn am-btn-primary am-topbar-btn am-btn-sm">登录</a>
        </div>
    </div>
</header>
<div class="am-g am-padding-top-xl" style="padding-top: 100px;">
    <!--    logo-->
    <div class="am-u-sm-3 am-u-sm-centered am-margin-bottom">
        <img src="http://www.htnm.com/data/upload/shop/common/05189768616156433.png" width="270"/>
    </div>

    <div class="am-u-sm-6 am-u-sm-centered">
        <form action="<?= $label->url('Order-info') ?>" method="GET" data-am-validator>
            <input type="hidden" name="m" value="Order" />
            <input type="hidden" name="a" value="Info">
            <div class="am-input-group ">
                <input type="text" name="order_sn" class="am-form-field" required placeholder="填入工单号，查看工单详细信息  (例：ASAF146638700032)">
            <span class="am-input-group-btn">
                <button class="am-btn am-btn-default" type="submit">查看</button>
            </span>
            </div>
        </form>
    </div>
</div>