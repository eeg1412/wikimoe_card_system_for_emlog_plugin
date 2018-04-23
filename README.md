# 维基萌emlog抽卡系统插件

#### 项目介绍
可用于emlog博客系统，自带数十张精美卡牌图片，不仅可以每天抽卡更可以与亲朋好友进行卡牌竞技！

#### 使用说明
在需要的页面添加自定义钩子：
```PHP
<?php doAction('wm_card_plugin'); ?>
```
在地址栏带上参数即可查询该用户的卡片情况，例如
www.wikimoe.com/?post=130&useraddr=fbb31d99a24cf9a56c48b44dd0797d22&usernick=广树
其中useraddr=想要查询的邮箱地址MD5值，usernick=用户名

体验地址：[https://www.wikimoe.com/?post=130](https://www.wikimoe.com/?post=130)
![预览图](https://gitee.com/uploads/images/2018/0423/102004_554a8f2e_1258290.png "QQ截图20180423101944.png")
![竞技模式](https://gitee.com/uploads/images/2018/0423/102131_49e221e9_1258290.jpeg "QQ截图20180423102031.jpg")
![竞技模式](https://gitee.com/uploads/images/2018/0423/103429_4793ca2f_1258290.jpeg "QQ截图20180423103345.jpg")

#### 注意

1. 邮箱地址必须是曾经在使用插件的网站内评论过且通过审核的邮箱地址才能进行抽卡。
2. 卡牌所用到的素材图片均源自网络，版权归各位大佬所有。
3. 如果图片素材侵犯到了大佬的权利，请联系我，我将迅速处理！
4. 卡牌图片仅供技术交流使用，严禁私自用于商业用途，如果造成法律纠纷，后果自负！