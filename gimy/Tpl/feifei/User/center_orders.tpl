<include file="BlockTheme:header" />
<div class="container">
    <div class="user-center">
        <include file="User:center_nav" />
        <div class="content">
            <h2>订单管理</h2>
            <div class="orders-list">
                {orders:vod uid="{$user_id}"}
                <div class="order-item">
                    <h3>{field:title}</h3>
                    <p>状态：{field:status}</p>
                    <p>金额：{field:money}</p>
                </div>
                {/orders:vod}
            </div>
        </div>
    </div>
</div>
<include file="User:footer" />