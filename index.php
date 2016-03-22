<!DOCTYPE HTML>
<!--
	Let's go viral!
-->
<html>
<?php
function console_log( $data ){
  echo '<script>';
  echo 'console.log("Custom log: " + '. json_encode( $data ) .')';
  echo '</script>';
}

    $driverId = explode('drivers=',$_SERVER['QUERY_STRING'])[1];
    $url = 'https://platform.telerik.com/bs-api/v1/EgXwDq7GEgueXESK/Functions/GetDriverById?driverId=' . $driverId;

    $json = file_get_contents($url);
    $obj = json_decode($json);
    $driver = $obj[0];
?>

    <head>
        <title>Гражданите - Помогни му да се извини!</title>
        <meta name="description" content="С мобилното приложение " Гражданите " можеш да снимаш и качиш всеки нарушител на правилника за движение на пътя.">
        <meta name="keywords" content="Гражданите, Пътно Нарушение, Граждански Контрол, Мобилно Приложение, Нарушител, Неправилно Паркиране">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="developer" content="Ivan Mitov">
        <meta name="author" content="Гражданите">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <meta name="og:image" content="<?php echo $driver->Picture; ?>" />
        <meta name="og:title" content="<?php echo $driver->Title; ?>" />
        <meta name="og:description" content="Споделете тази снимка в социалните мрежи и помогнете на нарушителя да се извини! Свалете приложението и чрез опциите " търсене по регистрационен номер " и "радар " проверете дали вие или ваш познат сте снимани в галерията на 'Гражданите'!"/>
        <meta property="og:image" content="<?php echo $driver->Picture; ?>" />
        <!-- Favicons -->
        <link rel="shortcut icon" href="images/icon-40.png">
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script>
            window.driver = <?php echo json_encode($driver); ?>; //Don't forget the extra semicolon!
            console.log(window.driver);
        </script>
    </head>

    <body class="landing">
        <div id="preloader_1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div id="fb-root"></div>

        <!-- Header -->
        <header id="header" class="alt">
            <h1><a href="http://grajdanite.bg/index.html" target="_blank">Гражданите</a></h1>
            <a id="slogan">Снимай и покажи всеки "Гражданин" на пътя!</a>
        </header>

        <!-- Banner -->

        <div>
            <section id="banner" class="wrapper style1">
                <div class="inner">
                    <article class="feature left noapology">
                        <div class="image relative">
                            <img id="viralPic" src=<?php echo $driver->Picture; ?> data-responsive="true">
                            <div class="absolute img_descr">
                                <div class="reg_nr">
                                    <?php echo $driver->LicensePlate ?>
                                </div>
                                <div class="img_clock">
                                    <i class="fa fa-clock-o"></i><span>
                                    <?php
                                    $t = strtotime($driver->CreatedAt);
                                    echo date('M d, y h:m a',$t); 
                                    ?>
                                    </span>
                                </div>
                                <div class="img_report">
                                    <i class="fa fa-bullhorn"></i><span>
                                    <?php
                                        if(isset($driver->Rating))
                                        {
                                            echo $driver->Rating;
                                        }
                                        else
                                        {
                                            echo 0;
                                        }
                                    ?>
                                    </span>
                                </div>
                                <div class="img_views">
                                    <i class="fa fa-eye"></i><span>
                                    <?php
                                        if(isset($driver->ViewCounter))
                                        {
                                            echo $driver->ViewCounter;
                                        }
                                        else
                                        {
                                            echo 0;
                                        }
                                    ?></span>
                                </div>
                            </div>
                            <div class="absolute user_comment">
                                <p><i class="fa fa-quote-right fa-2x"></i> <span><?php echo $driver->Title; ?></span> <i class="fa fa-quote-left fa-2x"></i></p>
                            </div>

                            <div class="apology" style="display:none;">
                                <p>Здравейте Граждани :) Водачът е изпратил лично извинение през приложението "Гражданите" и качилият снимката го е приел. Заради това снимката е скрита.</p>
                            </div>
                        </div>
                        <div class="content">
                            <p id="narusheniq">Извършени нарушения:</p>
                            <ul>
                                <?php
                                if(isset($driver->SelectedTags))
                                {
                                    foreach ($driver->SelectedTags as $tagName)
                                    {
                                        echo "<li>$tagName</li>";
                                    }
                                }
                                ?>
                            </ul>
                            <!--<div id="oceni">
								<p>Оцени:</p>
								<ul class="rating nostar">
									<li id="one" class="lautsprecher"><a href="#" title="1 Рейтинг"><i class="fa fa-bullhorn"></i></a></li>
									<li id="two" class="lautsprecher"><a href="#" title="2 Рейтинг"><i class="fa fa-bullhorn"></i></a></li>
									<li id="three" class="lautsprecher"><a href="#" title="3 Рейтинг"><i class="fa fa-bullhorn"></i></a></li>
									<li id="four" class="lautsprecher"><a href="#" title="4 Рейтинг"><i class="fa fa-bullhorn"></i></a></li>
									<li id="five" class="lautsprecher"><a href="#" title="5 Рейтинг"><i class="fa fa-bullhorn"></i></a></li>
								</ul>
							</div>-->
                            <div id="izvini-se">
                                <p>Помогни му да се <strong>извини!</strong> Харесай и сподели в социалните мрежи:</p>
                            </div>
                            <div id="social_button_wrap">
                                <div id="fb_btn">
                                    <div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                </div>

                                <div id="tweet_btn">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-text="Помогни му да се извини!" data-via="Grajdanite" data-related="Grajdanite" data-hashtags="izvinise">Tweet</a>
                                </div>
                            </div>
                            <div id="download">
                                <p>Провери <strong>дали си сниман</strong>! Свали приложението:</p>
                            </div>
                            <div id="dln_icons">
                                <a id="apple_dln" href="https://itunes.apple.com/app/id930663841"><img src="images/apple-store-download-button.png"></a>
                                <a id="android_dln" href="https://play.google.com/store/apps/details?id=com.xevica.grajdanite&hl=bg"><img src="images/play-store-download-button.png"></a>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
        <!-- Steps -->



        <!-- One -->
        <section id="one" class="wrapper style1">
            <div class="inner">
                <div id="viral_steps" class="">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <p><strong>1.</strong> Свали приложението</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p><strong>2.</strong> Снимай нарушител и качи снимката в галерията на "Гражданите"</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p><strong>3.</strong> Помогни му да се извини! Харесай и сподели линка към неговата снимка</p>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <p><strong>4.</strong> Коментирай и обясни защо е важно за нашето общество нарушителите да осъзнават грешката си</p>
                        </div>
                    </div>
                </div>
                <div class="comments_wrap">
                    <script>
                        document.write("<div class='fb-comments' data-href='" + window.location.href + "' data-num-posts='5' data-width='100%'></div>");

                    </script>
                </div>
            </div>
        </section>

        <!-- Footer -->

        <section class="page-section bg-gray" id="footer">
            <div class="container-fluid relative">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 social-wrap">
                        <a target="_blank" href="https://www.facebook.com/grajdanite"><i class="fa fa-facebook fa-fw social-icon-wrap"></i></a>
                        <a target="_blank" href="https://twitter.com/Grajdanite"><i class="fa fa-twitter fa-fw social-icon-wrap"></i></a>
                    </div>
                </div>
                <div class="row pt-10">
                    <div class="col-md-3 col-sm-6 col-xs-6 align-left pt-10 pr-0">
                        <span class="copyright">2015 &copy; <strong>Гражданите</strong>. Всички права запазени.</span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 footer-text-wrap pt-10 align-center">
                        <a target="_blank" href="http://grajdanite.bg/terms_of_service/index.html"><span>Условия за Ползване и Поверителност</span></a>
                        <span><i class="fa fa-circle"></i></span>
                        <a target="_blank" href="http://grajdanite.bg/FAQ/index.html"><span>Често задавани въпроси</span></a>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 align-right">
                        <img src="images/PoweredByTelerikPlatform.png" title="telerikPlatform" alt="poweredByTelerikPlatform">
                    </div>

                </div>
            </div>
        </section>


        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/handle_approved.js"></script>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId: '418393375032951',
                    xfbml: true,
                    version: 'v2.4'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        </script>
        <script>
            ! function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0],
                    p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + '://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'twitter-wjs');

        </script>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.4&appId=418393375032951";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        </script>
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-58947145-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>

</html>
