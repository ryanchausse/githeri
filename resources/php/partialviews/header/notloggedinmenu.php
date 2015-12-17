<?php

/* 
 * Githeri.com Copyright 2013. All Rights Reserved.
 */
?>
<div class="header">
    <div class="navbar">
        <ul>
            <li style="padding-left:0px;"><img class="logoimg" src='./resources/images/logo.jpg'></li>
            <li>
                <h4 class="mainlink" id="faqmnu">FAQ</h4>
                <div class="subnav">
                    <ul>
                        <li class="infomnu">
                            <h4>About</h4>
                        </li>
                        <br />
                        <li class="contactmnu">
                            <h4>Contact</h4>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <h4 class="mainlink" id="blogmnu">Blog</h4>
            </li>
            <li style="width:35px;">
                <h4 class="mainlink" id="likemnu">
                    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fgitheri.com&amp;width=20&amp;layout=button&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
                </h4>
                <div class="subnav">
                    <ul>
                        <li>
                            <!-- FACEBOOK BEGIN -->
                                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fgitheri.com&amp;width=125&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:125px; height:21px;" allowTransparency="true"></iframe>
                            <!-- FACEBOOK END -->
                        </li>
                        <br />
                        <li>
                            <!-- TWITTER BEGIN -->
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://githeri.com/" data-text="I'm learning Swahili on Githeri.com! It is awesome." data-via="githeri_com">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                            <!-- TWITTER END -->
                        </li>
                        <br />
                        <li>
                            <!-- LINKEDIN BEGIN -->
                                <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                                <script type="IN/Share" data-url="http://githeri.com/" data-counter="right"></script>
                            <!-- LINKEDIN END -->
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="rightmnu">
            <form name="loginform" action="index.php" method="post">
                Login:
                <input id="login_input_username" class="login_input" type="text" name="user_name" size="6" required autofocus/>
                Password:
                <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" size="6" required />
                <input type="submit" name="login" value="Log In">
            </form>
        </ul>
    </div>
</div>