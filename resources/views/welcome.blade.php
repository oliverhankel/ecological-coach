<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="Richte deinen Coach-Zugang ein und lege dein Team an.">
    <title>Smart Ecological Coach</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <style>
        :root {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #1c2520;
            background: #fff;
        }

        * { box-sizing: border-box; }
        body { min-width: 0; margin: 0; }
        a { color: inherit; }
        a:focus-visible { outline: 3px solid #176b43; outline-offset: 4px; border-radius: 3px; }
        .page { min-height: 100svh; display: flex; flex-direction: column; }
        .container { width: min(100% - 48px, 1200px); margin-inline: auto; }
        .header { border-bottom: 1px solid #e5e9e6; }
        .header-inner { min-height: 88px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: inline-flex; align-items: center; gap: 12px; min-width: 0; color: #1c2520; font-size: 17px; font-weight: 700; letter-spacing: -0.025em; text-decoration: none; }
        .brand svg { width: 37px; height: 37px; flex: none; }
        .header-link { flex: none; color: #176b43; font-size: 15px; font-weight: 600; text-decoration: none; }
        .header-link:hover, .secondary-link:hover { text-decoration: underline; text-underline-offset: 4px; }
        main { flex: 1; }
        .hero { padding: clamp(78px, 10vw, 140px) 0 0; text-align: center; }
        h1 { margin: 0; font-size: clamp(2rem, 7.4vw, 5.5rem); font-weight: 750; line-height: 1.09; letter-spacing: -0.055em; }
        h1 span { display: block; }
        h1 .accent { color: #176b43; }
        .intro { margin: 30px auto 0; color: #536159; font-size: clamp(1rem, 2.2vw, 1.25rem); line-height: 1.5; }
        .primary-link { display: inline-flex; align-items: center; justify-content: center; gap: 18px; min-height: 56px; margin-top: 34px; padding: 0 25px; border-radius: 8px; background: #176b43; color: #fff; font-size: 16px; font-weight: 650; text-decoration: none; }
        .primary-link:hover { background: #105634; }
        .primary-link:focus-visible { outline-offset: 5px; }
        .primary-link svg { width: 18px; height: 18px; flex: none; }
        .login-prompt { margin: 20px 0 0; color: #536159; font-size: 14px; }
        .secondary-link { color: #176b43; font-weight: 650; text-decoration: none; }
        .steps { padding: clamp(84px, 11vw, 148px) 0 clamp(80px, 10vw, 126px); }
        .steps-list { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 28px; margin: 0; padding: 0; list-style: none; }
        .step { position: relative; display: flex; align-items: center; justify-content: center; gap: 14px; min-width: 0; font-size: 16px; font-weight: 600; white-space: nowrap; }
        .step:not(:last-child)::after { position: absolute; top: 50%; left: calc(100% + 1px); width: 26px; height: 1px; background: #d9e2dc; content: ""; }
        .step-number { display: inline-grid; width: 38px; height: 38px; flex: none; place-items: center; border: 1.5px solid #176b43; border-radius: 50%; color: #176b43; font-size: 14px; font-weight: 700; }
        .footer { border-top: 1px solid #e5e9e6; }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; gap: 24px; min-height: 84px; color: #65736a; font-size: 13px; }
        .footer-items { display: flex; flex-wrap: wrap; gap: 14px 26px; }

        @media (max-width: 640px) {
            .container { width: min(100% - 36px, 1200px); }
            .header-inner { min-height: 72px; gap: 12px; }
            .brand { gap: 8px; font-size: 13px; }
            .brand svg { width: 32px; height: 32px; }
            .header-link { font-size: 13px; }
            .hero { padding-top: 84px; }
            .intro { max-width: 310px; margin-top: 23px; }
            .primary-link { margin-top: 28px; }
            .steps { padding-block: 90px; }
            .steps-list { grid-template-columns: 1fr; gap: 24px; width: max-content; max-width: 100%; margin-inline: auto; }
            .step { justify-content: flex-start; }
            .step::after { display: none; }
            .footer-inner { align-items: flex-start; flex-direction: column; justify-content: center; gap: 15px; padding-block: 26px; }
        }
    </style>
</head>
<body>
<div class="page">
    <header class="header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}" aria-label="Smart Ecological Coach – Startseite">
                <svg viewBox="0 0 40 40" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="19" fill="#176b43"/>
                    <g fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.7">
                        <circle cx="20" cy="20" r="16.5"/>
                        <path d="M20 3.5v33M3.5 20h33M8.3 8.3c8.7 4.8 8.7 18.6 0 23.4M31.7 8.3c-8.7 4.8-8.7 18.6 0 23.4"/>
                    </g>
                </svg>
                <span>Smart Ecological Coach</span>
            </a>
            @auth
                <a class="header-link" href="{{ route('dashboard') }}">Zur Übersicht</a>
            @else
                <a class="header-link" href="{{ route('login') }}">Anmelden</a>
            @endauth
        </div>
    </header>

    <main>
        <section class="container hero" aria-labelledby="hero-title">
            <h1 id="hero-title">
                <span>Dein Team.</span>
                <span>Dein Coaching.</span>
                <span class="accent">Ein klarer Start.</span>
            </h1>
            <p class="intro">Richte deinen Coach-Zugang ein und lege dein Team an.</p>
            @auth
                <a class="primary-link" href="{{ route('dashboard') }}">
                    Zur Teamübersicht
                    <svg viewBox="0 0 20 20" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><path d="M3 10h13m-5-5 5 5-5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"/></svg>
                </a>
            @else
                <a class="primary-link" href="{{ route('register') }}">
                    Als Coach registrieren
                    <svg viewBox="0 0 20 20" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><path d="M3 10h13m-5-5 5 5-5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"/></svg>
                </a>
                <p class="login-prompt">Schon registriert? <a class="secondary-link" href="{{ route('login') }}">Anmelden</a></p>
            @endauth
        </section>

        <section class="container steps" aria-label="In drei Schritten starten">
            <ol class="steps-list" role="list">
                <li class="step"><span class="step-number">1</span><span>Registrieren</span></li>
                <li class="step"><span class="step-number">2</span><span>Team anlegen</span></li>
                <li class="step"><span class="step-number">3</span><span>Coaching starten</span></li>
            </ol>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <span>Smart Ecological Coach</span>
            <div class="footer-items">
                <span>Impressum</span>
                <span>Datenschutz</span>
                <span>Kontakt</span>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
