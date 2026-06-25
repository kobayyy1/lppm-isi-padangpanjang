<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>ISI Padangpanjang - LPPM</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-isi.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISI Padangpanjang - LPPM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .goog-te-banner-frame.skiptranslate,
        .goog-te-banner-frame {
            display: none !important;
        }

        body {
            top: 0px !important;
        }

        iframe.goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-balloon-frame {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#fafafa] text-[#0f2440] antialiased overflow-x-hidden">
    <main>
        @yield('content')
    </main>
    <div id="google_translate_element" style="display: none !important;"></div>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,ar,ja,ko,zh-CN',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let savedLang = localStorage.getItem('goog_lang') || 'id';

            if (savedLang !== 'id') {
                setTimeout(() => {
                    let selectBox = document.querySelector('.goog-te-combo');
                    if (selectBox) {
                        selectBox.value = savedLang;
                        selectBox.dispatchEvent(new Event('change'));
                    }
                }, 700);
            }
        });
    </script>
</body>

</html>
