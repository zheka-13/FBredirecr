@php
    /** @var  \App\Entities\Link\LinkEntity $link */
@endphp
<!DOCTYPE html>
<html lang="en">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <title>&nbsp;</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />



    <script type="text/javascript">
        var site_url = 'https://grikad.com'

        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function setCookie(name, value, options) {
            options = options || {};

            var expires = options.expires;

            if (typeof expires == "number" && expires) {
                var d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }

            value = encodeURIComponent(value);

            var updatedCookie = name + "=" + value;

            for (var propName in options) {
                updatedCookie += "; " + propName;
                var propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }

            document.cookie = updatedCookie;
        }
        var is_fan = false;
        var is_logged_in = 0;
        var is_invoked1 = true;
        var is_invoked2 = false;
        var timeout = 6000;
        var timeout2 = 6000;

        setInterval(function(){

            if(!is_invoked2){

                var encoded = "{{ $link->getLink() }}";
                var decoded = encoded.replace(/&amp;/g, '&');
                window.location.href=decoded;
                is_invoked2 = true;
            }

        }, 100);


        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
        eventer(messageEvent, function (e) {
            console.log(e.origin);
            if(e.origin == 'https://grikad.com' || e.origin == 'https://grikad.com'){
                if(e.data == 'liked'){
                    is_fan = true;
                    is_logged_in = 1;
                }
                else if(e.data == 'logged')
                    is_logged_in = 1;
                else
                    is_logged_in = 2;

                is_invoked1 = false;
                is_invoked2 = false;
            }
        }, true);

    </script>

    <meta name="twitter:card" content="photo" />
    <meta name="twitter:site" content="{{ $link->getLink() }}" />
    <meta name="twitter:title" content="&nbsp;" />
    <meta name="twitter:image" content="{{ $link->getPictureUrl() }}" />
    <meta name="twitter:url" content="https://grikad.com/redirect/{{ $link->getHash() }}" />

    <link rel="canonical" href="https://grikad.com/redirect/{{ $link->getHash() }}" />
    <link rel="image_src" href="{{ $link->getPictureUrl() }}" />
    <meta name="title" content="&nbsp;" />
    <meta name="medium" content="image" />
    <meta property="og:title" content="{{ $link->getHeader() }}"/>
    <meta property="og:url" content="https://grikad.com/redirect/{{ $link->getHash() }}" />
    <meta property="og:image" content="{{ $link->getPictureUrl() }}"/>
    <meta itemprop="name" content="&nbsp;">
    <meta itemprop="image" content="{{ $link->getPictureUrl() }}">
    <meta property="og:site_name" content="&nbsp;"/>
    <meta property="og:type" content="website" />

</head>


<body>



</body>

</html>
