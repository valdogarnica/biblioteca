<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <style>
        body {
        margin: 0;
        background-color: #252842;
        height: 100vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        align-items: center;
        font-family: "Ubuntu", sans-serif;
        }

        .planet {
        transform-style: preserve-3d;
        position: relative;
        }
        .planet:after, .planet:before {
        content: "";
        position: absolute;
        background: linear-gradient(to top, transparent, rgba(255, 255, 255, 0.05));
        border-radius: 50%;
        transform: translateZ(-40em);
        }
        .planet:after {
        top: calc(50% - 18em);
        left: calc(50% - 18em);
        width: 36em;
        height: 36em;
        animation-delay: 2s;
        }
        .planet:before {
        top: calc(50% - 25em);
        left: calc(50% - 25em);
        width: 50em;
        height: 50em;
        }
        .planet .inner {
        transform: rotate3d(0, 0, 1, -30deg) translateZ(1em);
        position: absolute;
        top: calc(50% - 13em);
        left: calc(50% - 13em);
        width: 26em;
        height: 26em;
        background: linear-gradient(90deg, #804d2f 50%, #b46c42 50%);
        border-radius: 50%;
        overflow: hidden;
        }
        .planet .inner:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(transparent 66%, rgba(0, 0, 0, 0.1) 66.1%);
        }
        @media (max-width: 1200px) {
        .planet {
            font-size: 0.75em;
        }
        }
        @media (max-width: 950px) {
        .planet {
            font-size: 0.5em;
        }
        }
        @media (max-width: 600px) {
        .planet {
            font-size: 0.4em;
        }
        }

        .ring {
        position: absolute;
        top: calc(50% - 19em);
        left: calc(50% - 20em);
        width: 42em;
        height: 42em;
        border-radius: 50%;
        background: radial-gradient(transparent 50%, #bac33b 50.1%, #bac33b 60%, #c4cc56 60.1%);
        transform: rotateX(78deg) rotateY(-30deg) translateY(-3.125px);
        }

        /* prettier-ignore */
        .surface {
        margin: -1.4em auto 0;
        border-radius: 1.5em;
        width: 14em;
        height: 1.5em;
        background-color: #9a5c38;
        box-shadow: 9.2em 1.5em #b46c42, -11em 1.5em #804d2f, 0em 1.5em #9a5c38, 2em 3em #9a5c38, -2em 3em #9a5c38, 12.5em 4.5em #b46c42, -8em 4.5em #804d2f, 0 4.5em #9a5c38, 1em 6em #9a5c38, 10.5em 7.5em #b46c42, -10em 7.5em #804d2f, 0 7.5em #9a5c38, 3em 9em #9a5c38, -3em 9em #9a5c38, 14em 10.5em #b46c42, -6.8em 10.5em #804d2f, 2em 10.5em #9a5c38, 2em 12em #9a5c38, -0.5em 12em #9a5c38, 10em 13.5em #b46c42, -8.4em 13.5em #804d2f, -2em 13.5em #9a5c38, -2em 15em #9a5c38, 6.3em 16.5em #b46c42, -11.6em 16.5em #804d2f, -6em 16.5em #9a5c38, 0em 18em #9a5c38, 5em 16.5em #b46c42, -12em 16.5em #804d2f, -6em 16.5em #9a5c38, 0em 18em #9a5c38, 10.5em 19.5em #b46c42, -9.6em 19.5em #804d2f, 0em 19.5em #9a5c38, -1.3em 21em #9a5c38, 3em 21em #9a5c38, 8em 22.5em #b46c42, -11.4em 22.5em #804d2f, 0em 22.5em #9a5c38, 0em 24em #9a5c38, 12em 25.5em #b46c42, -8em 25.5em #804d2f, 0em 25.5em #9a5c38, 2.2em 27em #9a5c38, 12em 28.5em #b46c42, -10em 28.5em #804d2f, 0em 28.5em #9a5c38, 0em 30em #9a5c38;
        }

        .moon {
        position: absolute;
        top: -16em;
        left: 6em;
        width: 8em;
        height: 8em;
        background: radial-gradient(at bottom left, #804d2f 50%, #9a5c38 50.1%, #9a5c38 70%, #b46c42 70.1%);
        border-radius: 50%;
        overflow: hidden;
        transform: translateZ(22em);
        animation: moon 7s linear infinite;
        }
        .moon:after, .moon:before {
        content: "";
        position: absolute;
        }
        .moon:after {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(transparent 64%, rgba(0, 0, 0, 0.1) 64.1%);
        }
        .moon:before {
        top: 2.5em;
        left: 2.2em;
        width: 1em;
        height: 1em;
        background-color: #804d2f;
        border-radius: 50%;
        }

        span {
        font-size: 32em;
        font-weight: bold;
        position: absolute;
        top: 0;
        transform: translateY(-50%);
        }
        span:nth-of-type(1) {
        right: 0.55em;
        color: #9a5c38;
        }
        span:nth-of-type(2) {
        left: 0.5em;
        color: #b46c42;
        }
        @media (max-width: 460px) {
        span {
            display: none;
        }
        }

        .alt {
        position: fixed;
        bottom: 1.25em;
        font-size: 4.5em;
        font-weight: bold;
        margin: 0;
        color: #eee;
        letter-spacing: 0.2em;
        }
        @media (min-width: 461px) {
        .alt {
            display: none;
        }
        }

        .info {
        position: fixed;
        bottom: 1.8em;
        font-size: 2.4em;
        font-weight: bold;
        margin: 0;
        color: #eee;
        letter-spacing: 0.2em;
        }
        @media (max-width: 460px) {
        .info {
            bottom: 1em;
        }
        }

        .stars, .stars:after, .stars:before {
        position: fixed;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        background-color: #eee;
        animation: blink 5s infinite ease-in-out;
        }

        .stars:after, .stars:before {
        content: "";
        display: block;
        }

        .s1 {
        top: -15em;
        left: -40em;
        }
        .s1:after {
        animation-delay: 0.5s;
        top: 10em;
        left: 24em;
        }
        .s1:before {
        top: 20em;
        left: -15em;
        }

        .s2 {
        animation-delay: 0.25s;
        top: -30em;
        left: 80em;
        font-size: 0.6em;
        }
        .s2:after {
        top: 20em;
        left: 60em;
        }
        .s2:before {
        animation-delay: 0.5s;
        top: 16em;
        left: -52em;
        }

        .s3 {
        animation-delay: 0.5s;
        top: -30em;
        left: 60em;
        font-size: 0.5em;
        }
        .s3:after {
        animation-delay: 0.75s;
        top: -46em;
        left: -30em;
        }
        .s3:before {
        animation-delay: 0.25s;
        top: 36em;
        left: 38em;
        }

        .s4 {
        top: -30em;
        left: -30em;
        font-size: 0.3em;
        }
        .s4:after {
        animation-delay: 0.5s;
        top: -50em;
        left: 30em;
        }
        .s4:before {
        top: 34em;
        left: 22em;
        }

        @keyframes blink {
        0% {
            opacity: 0.85;
        }
        25% {
            opacity: 0.4;
        }
        50% {
            opacity: 0.85;
        }
        75% {
            opacity: 0.4;
        }
        100% {
            opacity: 0.85;
        }
        }
        @keyframes moon {
        0% {
            top: 13em;
            left: -13em;
            transform: translateZ(-30em);
        }
        1% {
            transform: translateZ(30em);
        }
        50% {
            top: -19em;
            left: 7em;
            transform: translateZ(30em);
        }
        51% {
            transform: translateZ(-30em);
        }
        60% {
            transform: scale(0.8);
        }
        95% {
            transform: scale(0.8);
        }
        100% {
            top: 13em;
            left: -13em;
            transform: translateZ(-30em);
        }
        }
    </style>
    <title>404</title>
</head>
<body>
    <div class="planet">
        <div class="inner">
            <div class="surface"></div>
        </div>
        <div class="ring"></div>
        <div class="moon"></div>
        <span>4</span>
        <span>4</span>
        <div class="stars s1"></div>
        <div class="stars s2"></div>
        <div class="stars s3"></div>
        <div class="stars s4"></div>
    </div>
    <p class="alt">404</p>
    <p class="info">Perdido en el Espacio?</p>
</body>
</html>