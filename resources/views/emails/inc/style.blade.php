<style>

    /* Base */

    .font-prompt {
        font-family: 'Prompt', sans-serif !important;
    }

    body,
    body *:not(html):not(style):not(br):not(tr):not(code) {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
            'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        box-sizing: border-box;
    }

    body {
        background-color: #ffffff;
        color: #74787e;
        height: 100%;
        hyphens: auto;
        line-height: 1.4;
        margin: 0;
        -moz-hyphens: auto;
        -ms-word-break: break-all;
        width: 100% !important;
        -webkit-hyphens: auto;
        -webkit-text-size-adjust: none;
        word-break: break-all;
        word-break: break-word;
    }

    p,
    ul,
    ol,
    blockquote {
        line-height: 1.4;
        text-align: left;
    }

    a {
        color: #3869d4;
    }

    a img {
        border: none;
    }

    /* Typography */

    h1 {
        color: #3d4852;
        font-size: 19px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
    }

    h2 {
        color: #3d4852;
        font-size: 16px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
    }

    h3 {
        color: #3d4852;
        font-size: 14px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
    }

    p {
        color: #3d4852;
        font-size: 16px;
        line-height: 1.5em;
        margin-top: 0;
        text-align: left;
    }

    p.sub {
        font-size: 12px;
    }

    img {
        max-width: 100%;
    }

    /* Layout */

    .wrapper {
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .content {
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    /* Header */

    .header {
        padding: 0px;
        text-align: center;
    }

    .inner-header {
        background-color: #0c2c38;
        margin: 0 auto;
        padding: 0;
        max-width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-max-width: 570px;
    }

    .header-logo {max-height: 50px;display: inline;float: left; margin-right: 10px;}
    .header-title {display: block;margin-top: 8px; font-size: 130%; color: white;}

    .header a {
        color: #bbbfc3;
        font-size: 19px;
        font-weight: bold;
        text-decoration: none;
        text-shadow: 0 1px 0 white;
    }

    /* Body */

    .body {
        background-color: #ffffff;
        border-bottom: 1px solid #edeff2;
        border-top: 1px solid #edeff2;
        margin: 0;
        padding: 0;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .inner-body {
        background-color: #ffffff;
        margin: 0 auto;
        padding: 0;
        max-width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-max-width: 570px;
    }

    /* Subcopy */

    .subcopy {
        border-top: 1px solid #edeff2;
        margin-top: 25px;
        padding-top: 25px;
    }

    .subcopy p {
        font-size: 12px;
    }

    /* Footer */

    .footer {
        margin: 0 auto;
        padding: 0;
        text-align: center;
        max-width: 570px;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-max-width: 570px;
    }

    .footer p {
        color: #aeaeae;
        font-size: 12px;
        text-align: center;
    }

    /* Tables */

    .table table {
        margin: 30px auto;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .table th {
        border-bottom: 1px solid #edeff2;
        padding-bottom: 8px;
        margin: 0;
    }

    .table td {
        color: #74787e;
        font-size: 15px;
        line-height: 18px;
        padding: 10px 0;
        margin: 0;
    }

    .content-cell {
        padding: 15px;
        border: 1px solid rgba(0,0,0, .07);
        border-collapse: collapse;
        font-weight: 500;
    }

    /* Buttons */

    .action {
        margin: 30px auto;
        padding: 0;
        text-align: center;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .button {
        border-radius: 3px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
        color: #fff;
        display: inline-block;
        text-decoration: none;
        -webkit-text-size-adjust: none;
    }

    .button-blue,
    .button-primary {
        background-color: #0085af;
        border-top: 10px solid #0085af;
        border-right: 18px solid #0085af;
        border-bottom: 10px solid #0085af;
        border-left: 18px solid #0085af;
    }

    .button-green,
    .button-success {
        background-color: #38c172;
        border-top: 10px solid #38c172;
        border-right: 18px solid #38c172;
        border-bottom: 10px solid #38c172;
        border-left: 18px solid #38c172;
    }

    .button-red,
    .button-error {
        background-color: #e3342f;
        border-top: 10px solid #e3342f;
        border-right: 18px solid #e3342f;
        border-bottom: 10px solid #e3342f;
        border-left: 18px solid #e3342f;
    }

    /* Panels */

    .panel {
        margin: 0 0 21px;
    }

    .panel-content {
        background-color: #f1f5f8;
        padding: 16px;
    }

    .panel-item {
        padding: 0;
    }

    .panel-item p:last-of-type {
        margin-bottom: 0;
        padding-bottom: 0;
    }

    /* Promotions */

    .promotion {
        background-color: #ffffff;
        border: 2px dashed #9ba2ab;
        margin: 0;
        margin-bottom: 25px;
        margin-top: 25px;
        padding: 24px;
        width: 100%;
        -premailer-cellpadding: 0;
        -premailer-cellspacing: 0;
        -premailer-width: 100%;
    }

    .promotion h1 {
        text-align: center;
    }

    .promotion p {
        font-size: 15px;
        text-align: center;
    }

    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (min-width: 500px) {
        .show-sm {display: none;}
/*        .show-md {display: table-row;}*/
        .button {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 499px) {
        .header-logo {max-height: 44px;}
/*        .show-sm {display: table-cell;}*/
/*        .show-md {display: none;}*/
        .header-title {
            margin-top: 5px;
        }
        .button {
            width: 100% !important;
        }
    }

    .theme-color {color: #00AEEF !important;}
    hr.short-line {background-color: #00AEEF;}
    .text-theme {color: #00AEEF !important;}

    /* text colors */
    .text-darkcyan {color: darkcyan;}
    .text-coral {color: coral;}
    .text-crimson {color: crimson;}

    .fw500 {font-weight: 600;}

    .table-responsive {
        font-size: 85%;
    }
    
</style>