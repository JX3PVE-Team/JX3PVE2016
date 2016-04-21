<script>
    <!--{if $_G['uid'] == 0}-->
        onclick="showWindow('login', this.href)"
        /*如果用户未登录，执行收藏和置顶时，也可以直接使用弹出dz的登录对话框*/
    <!--{else}-->
        /*已登录再判断权限*/
    <!--{/if}-->
</script>
