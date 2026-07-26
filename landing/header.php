<?php
if (!isset($title)) {
    $title = "Mardira Business Center";
}
date_default_timezone_set("Asia/Jakarta");
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title; ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    /* ============ TOKENS ============ */
    :root {
      --blue: #1e4e96;
      --blue-deep: #0f2e5c;
      --blue-light: #3e71c4;
      --gold: #f6b800;
      --gold-light: #ffd666;
      --white: #ffffff;
      --gray: #f5f7fa;
      --dark: #1b1f23;
      --radius: 24px;
      --radius-sm: 14px;
      --shadow-soft: 0 20px 60px rgba(15, 46, 92, 0.1);
      --shadow-strong: 0 30px 80px rgba(15, 46, 92, 0.2);
      --bg: #f5f7fa;
      --text: #1b1f23;
      --text-soft: #5b6472;
      --card-bg: rgba(255, 255, 255, 0.72);
      --glass-border: rgba(255, 255, 255, 0.5);
      --nav-bg: rgba(255, 255, 255, 0.65);
      --ease: cubic-bezier(0.22, 1, 0.36, 1);
    }

    body.dark {
      --bg: #080d18;
      --text: #eef1f6;
      --text-soft: #96a0b3;
      --card-bg: rgba(22, 31, 51, 0.6);
      --glass-border: rgba(255, 255, 255, 0.08);
      --nav-bg: rgba(10, 15, 26, 0.65);
      --shadow-soft: 0 20px 60px rgba(0, 0, 0, 0.35);
      --shadow-strong: 0 30px 90px rgba(0, 0, 0, 0.5);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      font-size: 15px;
      scroll-behavior: smooth;
    }

    body {
      font-family: "Inter", sans-serif;
      font-size: 15px;
      line-height: 1.55;
      background: var(--bg);
      color: var(--text);
      overflow-x: hidden;
      transition:
        background 0.4s var(--ease),
        color 0.4s var(--ease);
    }

    h1,
    h2,
    h3,
    h4 {
      font-family: "Space Grotesk", sans-serif;
      letter-spacing: -0.02em;
    }

    img {
      max-width: 100%;
      display: block;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    button {
      font-family: inherit;
      cursor: pointer;
      border: none;
      background: none;
      color: inherit;
    }

    .container {
      max-width: 1240px;
      margin: 0 auto;
      padding: 0 24px;
    }

    .grid12 {
      display: grid;
      grid-template-columns: repeat(12, 1fr);
      gap: 24px;
    }

    section {
      position: relative;
    }

    .section-pad {
      padding: 70px 0;
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--blue);
      background: rgba(30, 78, 150, 0.08);
      padding: 8px 16px;
      border-radius: 100px;
      margin-bottom: 20px;
    }

    body.dark .eyebrow {
      color: var(--gold-light);
      background: rgba(246, 184, 0, 0.1);
    }

    .section-title {
      font-size: clamp(22px, 2.8vw, 30px);
      font-weight: 700;
      line-height: 1.15;
      margin-bottom: 14px;
    }

    .section-sub {
      font-size: 14px;
      color: var(--text-soft);
      max-width: 620px;
      line-height: 1.6;
    }

    .center {
      text-align: center;
      margin-left: auto;
      margin-right: auto;
    }

    /* ============ SCROLL PROGRESS ============ */
    #scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      width: 0%;
      background: linear-gradient(90deg, var(--blue), var(--gold));
      z-index: 9999;
      transition: width 0.05s linear;
    }

    /* ============ NAVBAR ============ */
    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      padding: 18px 0;
      transition: all 0.4s var(--ease);
    }

    .nav-inner {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--nav-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 100px;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 28px;
      padding-right: 14px;
      box-shadow: 0 8px 32px rgba(15, 46, 92, 0.06);
      transition: all 0.4s var(--ease);
    }

    header.scrolled .nav-inner {
      box-shadow: var(--shadow-soft);
    }

    .logo {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      font-family: "Space Grotesk";
      font-weight: 700;
      font-size: 18px;
      width: fit-content;
    }

    .logo-img {
      height: 46px;
      width: auto;
      display: block;
    }

    .footer-logo-img {
      height: 70px;
      width: auto;
      display: block;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-links>a,
    .nav-item {
      padding: 10px 16px;
      border-radius: 100px;
      font-size: 14.5px;
      font-weight: 500;
      color: var(--text);
      position: relative;
      transition: 0.25s;
    }

    .nav-links>a:hover,
    .nav-item:hover {
      background: rgba(30, 78, 150, 0.08);
      color: var(--blue);
    }

    body.dark .nav-links>a:hover,
    body.dark .nav-item:hover {
      background: rgba(246, 184, 0, 0.12);
      color: var(--gold-light);
    }

    .has-mega {
      position: relative;
    }

    .mega-menu {
      position: absolute;
      top: calc(100% + 16px);
      left: 50%;
      transform: translateX(-50%) translateY(8px);
      width: 640px;
      background: var(--card-bg);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid var(--glass-border);
      border-radius: 20px;
      box-shadow: var(--shadow-strong);
      padding: 22px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 12px;
      opacity: 0;
      visibility: hidden;
      transition: 0.3s var(--ease);
      pointer-events: none;
    }

    .has-mega:hover .mega-menu {
      opacity: 1;
      visibility: visible;
      transform: translateX(-50%) translateY(0);
      pointer-events: auto;
    }

    .mega-item {
      padding: 16px;
      border-radius: 14px;
      transition: 0.25s;
    }

    .mega-item:hover {
      background: rgba(30, 78, 150, 0.06);
      transform: translateY(-2px);
    }

    .mega-item .mi-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--blue), var(--blue-light));
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
    }

    .mega-item .mi-icon svg {
      width: 18px;
      height: 18px;
      stroke: #fff;
    }

    .mega-item h4 {
      font-size: 14.5px;
      margin-bottom: 4px;
    }

    .mega-item p {
      font-size: 12.5px;
      color: var(--text-soft);
      line-height: 1.4;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .icon-btn {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(30, 78, 150, 0.06);
      transition: 0.25s;
    }

    .icon-btn:hover {
      background: rgba(30, 78, 150, 0.14);
      transform: translateY(-1px);
    }

    .icon-btn svg {
      width: 17px;
      height: 17px;
      stroke: var(--text);
    }

    .search-wrap {
      display: flex;
      align-items: center;
      background: rgba(30, 78, 150, 0.06);
      border-radius: 100px;
      overflow: hidden;
      transition: 0.35s var(--ease);
    }

    .search-wrap input {
      width: 0;
      opacity: 0;
      border: none;
      background: transparent;
      outline: none;
      padding: 0;
      font-size: 13.5px;
      color: var(--text);
      transition: 0.35s var(--ease);
    }

    .search-wrap.open {
      padding-left: 14px;
    }

    .search-wrap.open input {
      width: 150px;
      opacity: 1;
      padding: 0 6px;
    }

    .lang-switch {
      display: flex;
      background: rgba(30, 78, 150, 0.06);
      border-radius: 100px;
      padding: 3px;
      gap: 2px;
    }

    .lang-btn {
      padding: 6px 12px;
      border-radius: 100px;
      font-size: 12px;
      font-weight: 700;
      color: var(--text-soft);
      transition: 0.25s;
    }

    .lang-btn.active {
      background: var(--blue);
      color: #fff;
    }

    .nav-cta {
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      color: #fff;
      padding: 11px 22px;
      border-radius: 100px;
      font-size: 14px;
      font-weight: 600;
      margin-left: 6px;
      box-shadow: 0 8px 24px rgba(30, 78, 150, 0.3);
      transition: 0.3s var(--ease);
      white-space: nowrap;
    }

    .nav-cta:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(30, 78, 150, 0.4);
    }

    /* ============ BUTTONS ============ */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 15px 28px;
      border-radius: 100px;
      font-weight: 600;
      font-size: 15px;
      transition: 0.35s var(--ease);
      position: relative;
      overflow: hidden;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      color: #fff;
      box-shadow: 0 10px 30px rgba(30, 78, 150, 0.35);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 16px 40px rgba(30, 78, 150, 0.45);
    }

    .btn-ghost {
      border: 1.5px solid rgba(30, 78, 150, 0.25);
      color: var(--text);
      background: rgba(255, 255, 255, 0.4);
    }

    .btn-ghost:hover {
      border-color: var(--blue);
      background: rgba(30, 78, 150, 0.06);
      transform: translateY(-3px);
    }

    .btn-gold {
      background: linear-gradient(135deg, var(--gold), #e0a400);
      color: var(--blue-deep);
      box-shadow: 0 10px 30px rgba(246, 184, 0, 0.4);
    }

    .btn-gold:hover {
      transform: translateY(-3px);
      box-shadow: 0 16px 40px rgba(246, 184, 0, 0.5);
    }

    .btn svg {
      width: 16px;
      height: 16px;
      transition: 0.3s;
    }

    .btn:hover svg {
      transform: translateX(3px);
    }

    /* ============ HERO ============ */
    .hero {
      padding: 120px 0 70px;
      position: relative;
      overflow: hidden;
    }

    .mesh-bg {
      position: absolute;
      inset: 0;
      z-index: -2;
      overflow: hidden;
    }

    .mesh-bg span {
      position: absolute;
      border-radius: 50%;
      filter: blur(90px);
      opacity: 0.55;
      animation: drift 18s ease-in-out infinite alternate;
    }

    .mesh-bg span:nth-child(1) {
      width: 520px;
      height: 520px;
      background: var(--blue);
      top: -160px;
      left: -120px;
      animation-delay: 0s;
    }

    .mesh-bg span:nth-child(2) {
      width: 420px;
      height: 420px;
      background: var(--gold);
      top: 60px;
      right: -140px;
      animation-delay: 3s;
      opacity: 0.35;
    }

    .mesh-bg span:nth-child(3) {
      width: 380px;
      height: 380px;
      background: var(--blue-light);
      bottom: -160px;
      left: 30%;
      animation-delay: 6s;
      opacity: 0.3;
    }

    @keyframes drift {
      0% {
        transform: translate(0, 0) scale(1);
      }

      100% {
        transform: translate(40px, 60px) scale(1.15);
      }
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.05fr 1fr;
      gap: 60px;
      align-items: center;
    }

    .hero-kicker {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 13px;
      font-weight: 600;
      color: var(--blue);
      text-transform: uppercase;
      letter-spacing: 0.12em;
      margin-bottom: 22px;
    }

    .hero-kicker .dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--gold);
      box-shadow: 0 0 12px var(--gold);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0.4;
      }
    }

    .hero h1 {
      font-size: clamp(28px, 3.8vw, 42px);
      line-height: 1.04;
      font-weight: 700;
      margin-bottom: 18px;
    }

    .hero h1 .l1 {
      display: block;
      color: var(--blue-deep);
    }

    body.dark .hero h1 .l1 {
      color: #fff;
    }

    .hero h1 .l2 {
      display: block;
      background: linear-gradient(100deg, var(--blue) 10%, var(--gold) 90%);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero-tagline {
      font-size: 15px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 10px;
    }

    .hero-desc {
      font-size: 14px;
      color: var(--text-soft);
      line-height: 1.7;
      max-width: 480px;
      margin-bottom: 28px;
    }

    .hero-actions {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
    }

    .hero-visual {
      position: relative;
      height: 420px;
    }

    #hero-svg {
      width: 100%;
      height: 100%;
      overflow: visible;
    }

    .node circle.core {
      fill: url(#coreGrad);
      filter: drop-shadow(0 0 18px rgba(30, 78, 150, 0.55));
    }

    .node circle.primary {
      fill: var(--white);
      stroke: var(--blue);
      stroke-width: 2.5;
      cursor: pointer;
      transition: 0.3s;
    }

    body.dark .node circle.primary {
      fill: #131c30;
    }

    .node.active circle.primary {
      stroke: var(--gold);
      filter: drop-shadow(0 0 16px rgba(246, 184, 0, 0.7));
      transform: scale(1.08);
      transform-box: fill-box;
      transform-origin: center;
    }

    .node circle.secondary {
      fill: var(--gold);
      opacity: 0.85;
      transition: 0.3s;
    }

    .node.active circle.secondary {
      filter: drop-shadow(0 0 8px rgba(246, 184, 0, 0.8));
      opacity: 1;
    }

    .link {
      stroke: url(#lineGrad);
      stroke-width: 1.6;
      opacity: 0.45;
      transition: 0.3s;
      stroke-dasharray: 5 6;
      animation: dash 6s linear infinite;
    }

    .link.active {
      opacity: 1;
      stroke-width: 2.2;
      filter: drop-shadow(0 0 6px rgba(246, 184, 0, 0.6));
    }

    @keyframes dash {
      to {
        stroke-dashoffset: -200;
      }
    }

    .node-label {
      font-family: "Space Grotesk", sans-serif;
      font-size: 13px;
      font-weight: 700;
      fill: var(--blue-deep);
      pointer-events: none;
    }

    body.dark .node-label {
      fill: #fff;
    }

    .sub-label {
      font-family: "Inter";
      font-size: 9.5px;
      fill: var(--text-soft);
      pointer-events: none;
    }

    .core-label {
      font-family: "Space Grotesk";
      font-size: 15px;
      font-weight: 700;
      fill: #fff;
      pointer-events: none;
    }

    .hero-tooltip {
      position: absolute;
      min-width: 210px;
      background: var(--card-bg);
      backdrop-filter: blur(18px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 14px 16px;
      box-shadow: var(--shadow-strong);
      opacity: 0;
      pointer-events: none;
      transition: 0.25s var(--ease);
      transform: translateY(8px);
      z-index: 5;
    }

    .hero-tooltip.show {
      opacity: 1;
      transform: translateY(0);
    }

    .hero-tooltip h5 {
      font-size: 13.5px;
      margin-bottom: 4px;
      color: var(--blue);
    }

    body.dark .hero-tooltip h5 {
      color: var(--gold-light);
    }

    .hero-tooltip p {
      font-size: 12px;
      color: var(--text-soft);
      line-height: 1.5;
    }

    /* ============ TRUSTED BY ============ */
    .trusted {
      padding: 60px 0;
      border-top: 1px solid rgba(30, 78, 150, 0.08);
      border-bottom: 1px solid rgba(30, 78, 150, 0.08);
    }

    .trusted-label {
      font-size: 12.5px;
      text-transform: uppercase;
      letter-spacing: 0.14em;
      color: var(--text-soft);
      text-align: center;
      margin-bottom: 34px;
      font-weight: 600;
    }

    .trusted-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 36px;
    }

    .trusted-item {
      font-family: "Space Grotesk";
      font-weight: 700;
      font-size: 16px;
      color: var(--text-soft);
      opacity: 0.5;
      filter: grayscale(1);
      transition: 0.3s;
      display: flex;
      flex-direction: column;   /* Logo di atas */
      align-items: center;      /* Posisi di tengah */
      text-align: center;
      gap: 10px;
    }

    .trusted-item:hover {
      opacity: 1;
      filter: grayscale(0);
      color: var(--blue);
    }


    .trusted-logo{
        height: 120px;
        width: auto;
    }

    .trusted-item span{
        font-size: 16px;
        font-weight: 600;
    }

    /* ============ ABOUT ============ */
    .about-card {
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 28px;
      padding: 32px;
      box-shadow: var(--shadow-soft);
      position: relative;
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 28px;
      align-items: center;
    }

    .about-card::before {
      content: "";
      position: absolute;
      top: -100px;
      right: -100px;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle,
          rgba(246, 184, 0, 0.18),
          transparent 70%);
    }

    .about-network {
      position: relative;
      height: 280px;
    }

    /* ============ BUSINESS UNITS ============ */
    .units-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
      margin-top: 56px;
    }

    .unit-card {
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius);
      padding: 24px 20px;
      box-shadow: var(--shadow-soft);
      transition: 0.45s var(--ease);
      position: relative;
      overflow: hidden;
    }

    .unit-card::before {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: var(--radius);
      padding: 1.5px;
      background: linear-gradient(135deg,
          var(--blue),
          transparent 40%,
          var(--gold));
      -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      opacity: 0;
      transition: 0.4s;
    }

    .unit-card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: var(--shadow-strong);
    }

    .unit-card:hover::before {
      opacity: 1;
    }

    .unit-icon {
      width: 64px;
      height: 64px;
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      margin-bottom: 26px;
      box-shadow: 0 12px 30px rgba(30, 78, 150, 0.35);
      transition: 0.4s var(--ease);
    }

    .unit-card:nth-child(3) .unit-icon {
      background: linear-gradient(135deg, var(--gold), #d99a00);
      box-shadow: 0 12px 30px rgba(246, 184, 0, 0.35);
    }

    .unit-card:hover .unit-icon {
      transform: rotate(-6deg) scale(1.08);
    }

    .unit-icon svg {
      width: 28px;
      height: 28px;
      stroke: #fff;
      fill: none;
    }

    .unit-card h3 {
      font-size: 22px;
      margin-bottom: 10px;
    }

    .unit-tag {
      font-size: 12px;
      font-weight: 600;
      color: var(--gold);
      text-transform: uppercase;
      letter-spacing: 0.08em;
      display: block;
      margin-bottom: 6px;
    }

    .unit-list {
      list-style: none;
      margin: 16px 0 26px;
      color: var(--text-soft);
      font-size: 14px;
      line-height: 2;
    }

    .unit-list li {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .unit-list li::before {
      content: "";
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--blue);
    }

    .unit-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-weight: 600;
      font-size: 14.5px;
      color: var(--blue);
    }

    body.dark .unit-link {
      color: var(--gold-light);
    }

    .unit-link svg {
      width: 15px;
      height: 15px;
      transition: 0.3s;
    }

    .unit-card:hover .unit-link svg {
      transform: translateX(4px);
    }

    /* ============ WHY CHOOSE ============ */
    .why-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-top: 56px;
    }

    .why-card {
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius-sm);
      padding: 30px 26px;
      transition: 0.35s var(--ease);
      backdrop-filter: blur(16px);
    }

    .why-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-soft);
      border-color: rgba(30, 78, 150, 0.25);
    }

    .why-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      background: rgba(30, 78, 150, 0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 18px;
    }

    .why-icon svg,
    .why-icon i.fa-solid {
      width: 22px;
      height: 22px;
      color: var(--blue);
      stroke: var(--blue);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
    }

    body.dark .why-icon {
      background: rgba(246, 184, 0, 0.1);
    }

    body.dark .why-icon svg,
    body.dark .why-icon i.fa-solid {
      color: var(--gold-light);
      stroke: var(--gold-light);
    }

    body.dark .why-icon svg {
      stroke: var(--gold-light);
    }

    .why-card h4 {
      font-size: 16.5px;
      margin-bottom: 8px;
    }

    .why-card p {
      font-size: 13.5px;
      color: var(--text-soft);
      line-height: 1.6;
    }

    /* ============ STATS ============ */
    .stats-section {
      background: linear-gradient(120deg,
          var(--blue-deep),
          var(--blue) 60%,
          #2f5fa8);
      border-radius: 40px;
      padding: 80px 60px;
      position: relative;
      overflow: hidden;
      margin: 0 32px;
    }

    .stats-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 20% 20%,
          rgba(246, 184, 0, 0.25),
          transparent 45%),
        radial-gradient(circle at 80% 80%,
          rgba(255, 255, 255, 0.12),
          transparent 40%);
    }

    .stats-grid {
      position: relative;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      text-align: center;
    }

    .stat-num {
      font-family: "Space Grotesk";
      font-size: clamp(38px, 4vw, 56px);
      font-weight: 700;
      color: #fff;
      line-height: 1;
    }

    .stat-num span {
      color: var(--gold-light);
    }

    .stat-label {
      color: rgba(255, 255, 255, 0.75);
      font-size: 14px;
      margin-top: 10px;
      font-weight: 500;
    }

    .stats-title {
      position: relative;
      text-align: center;
      color: #fff;
      margin-bottom: 56px;
    }

    .stats-title h2 {
      font-size: clamp(26px, 3vw, 36px);
      margin-bottom: 10px;
    }

    .stats-title p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 15px;
    }

    /* ============ PROCESS TIMELINE ============ */
    .timeline {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 0;
      margin-top: 70px;
      position: relative;
    }

    .timeline::before {
      content: "";
      position: absolute;
      top: 26px;
      left: 8%;
      right: 8%;
      height: 2px;
      background: linear-gradient(90deg, var(--blue), var(--gold));
      opacity: 0.35;
    }

    .tl-step {
      position: relative;
      text-align: center;
      padding: 0 12px;
    }

    .tl-dot {
      width: 54px;
      height: 54px;
      border-radius: 50%;
      margin: 0 auto 22px;
      position: relative;
      z-index: 2;
      background: var(--card-bg);
      border: 2px solid var(--blue);
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Space Grotesk";
      font-weight: 700;
      color: var(--blue);
      transition: 0.4s var(--ease);
      box-shadow: 0 0 0 8px var(--bg);
    }

    .tl-step:hover .tl-dot {
      background: var(--blue);
      color: #fff;
      transform: scale(1.12);
      box-shadow:
        0 0 24px rgba(30, 78, 150, 0.5),
        0 0 0 8px var(--bg);
    }

    .tl-step h4 {
      font-size: 15.5px;
      margin-bottom: 8px;
    }

    .tl-step p {
      font-size: 12.5px;
      color: var(--text-soft);
      line-height: 1.5;
    }

    /* ============ PROJECTS ============ */
    .masonry {
      columns: 3 220px;
      column-gap: 26px;
      margin-top: 56px;
    }

    .proj-card {
      break-inside: avoid;
      margin-bottom: 26px;
      border-radius: var(--radius);
      overflow: hidden;
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      box-shadow: var(--shadow-soft);
      transition: 0.4s var(--ease);
    }

    .proj-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-strong);
    }

    .proj-media {
      height: 180px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .proj-media.h-tall {
      height: 250px;
    }

    .proj-media svg {
      width: 56px;
      height: 56px;
      stroke: #fff;
      opacity: 0.9;
      position: relative;
      z-index: 1;
    }

    .proj-media::after {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 30% 20%,
          rgba(255, 255, 255, 0.18),
          transparent 60%);
    }

    .proj-media.m-blue {
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
    }

    .proj-media.m-gold {
      background: linear-gradient(135deg, var(--gold), #d99a00);
    }

    .proj-media.m-navy {
      background: linear-gradient(135deg, #0f2e5c, #08192f);
    }

    .proj-body {
      padding: 24px;
    }

    .proj-cat {
      font-size: 11.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--gold);
    }

    .proj-body h4 {
      font-size: 17px;
      margin: 8px 0 10px;
    }

    .proj-body p {
      font-size: 13px;
      color: var(--text-soft);
      line-height: 1.55;
      margin-bottom: 16px;
    }

    .proj-link {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--blue);
      display: inline-flex;
      gap: 6px;
      align-items: center;
    }

    body.dark .proj-link {
      color: var(--gold-light);
    }

    /* ============ TESTIMONIALS ============ */
    .testi-wrap {
      position: relative;
      max-width: 760px;
      margin: 56px auto 0;
    }

    .testi-track {
      overflow: hidden;
    }

    .testi-slides {
      display: flex;
      transition: transform 0.55s var(--ease);
    }

    .testi-slide {
      min-width: 100%;
      padding: 6px;
    }

    .testi-card {
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 28px;
      padding: 44px;
      text-align: center;
      box-shadow: var(--shadow-soft);
    }

    .testi-stars {
      color: var(--gold);
      font-size: 18px;
      margin-bottom: 18px;
      letter-spacing: 3px;
    }

    .testi-quote {
      font-size: 17px;
      line-height: 1.7;
      color: var(--text);
      margin-bottom: 26px;
    }

    .testi-person {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 14px;
    }

    .testi-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Space Grotesk";
      font-weight: 700;
      color: #fff;
      background: linear-gradient(135deg, var(--blue), var(--gold));
    }

    .testi-name {
      font-weight: 700;
      font-size: 14.5px;
    }

    .testi-role {
      font-size: 12.5px;
      color: var(--text-soft);
    }

    .testi-nav {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 28px;
    }

    .testi-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: rgba(30, 78, 150, 0.25);
      transition: 0.3s;
    }

    /* Support Font Awesome icons inside project media */
    .proj-media i.fa-solid {
      font-size: 56px;
      color: #fff;
      opacity: 0.95;
      position: relative;
      z-index: 1;
      padding: 6px;
    }
    .testi-dot.active {
      background: var(--blue);
      width: 26px;
      border-radius: 100px;
    }

    /* Support Font Awesome icons inside unit icon box */
    .unit-icon i.fa-solid {
      font-size: 28px;
      color: #fff;
      line-height: 1;
      position: relative;
      z-index: 1;
      display: inline-block;
    }
    .testi-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: var(--card-bg);
      border: 1px solid var(--glass-border);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: var(--shadow-soft);
      transition: 0.3s;
    }

    .testi-arrow:hover {
      background: var(--blue);
    }

    .testi-arrow:hover svg {
      stroke: #fff;
    }

    .testi-arrow svg {
      width: 16px;
      height: 16px;
      stroke: var(--blue);
    }

    .testi-arrow.prev {
      left: -60px;
    }

    .testi-arrow.next {
      right: -60px;
    }

    @media (max-width: 900px) {
      .testi-arrow {
        display: none;
      }
    }

    /* ============ CTA ============ */
    .cta-section {
      background: linear-gradient(120deg,
          var(--gold),
          #e0a400 65%,
          var(--gold-light));
      border-radius: 32px;
      padding: 56px 32px;
      text-align: center;
      position: relative;
      overflow: hidden;
      margin: 0 32px;
    }

    .cta-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 15% 30%,
          rgba(30, 78, 150, 0.18),
          transparent 45%),
        radial-gradient(circle at 85% 70%,
          rgba(255, 255, 255, 0.35),
          transparent 40%);
    }

    .cta-section h2 {
      position: relative;
      font-size: clamp(30px, 4vw, 46px);
      color: var(--blue-deep);
      margin-bottom: 16px;
    }

    .cta-section p {
      position: relative;
      font-size: 17px;
      color: rgba(15, 46, 92, 0.75);
      max-width: 520px;
      margin: 0 auto 34px;
    }

    .cta-section .btn-primary {
      position: relative;
      background: var(--blue-deep);
      box-shadow: 0 14px 34px rgba(15, 46, 92, 0.4);
    }

    /* ============ FOOTER ============ */
    footer {
      padding: 56px 0 24px;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.4fr 1fr 1fr 1fr;
      gap: 48px;
      padding-bottom: 56px;
      border-bottom: 1px solid rgba(30, 78, 150, 0.1);
    }

    .footer-brand {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .footer-brand .logo {
      display: inline-flex;
      width: fit-content;
      align-self: flex-start;
    }

    .footer-brand p {
      color: var(--text-soft);
      font-size: 14px;
      line-height: 1.7;
      margin: 18px 0 22px;
      max-width: 280px;
    }

    .footer-social {
      display: flex;
      gap: 10px;
    }

    .footer-social a {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: rgba(30, 78, 150, 0.08);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: 0.3s;
    }

    .footer-social a:hover {
      background: var(--blue);
      transform: translateY(-3px);
    }

    .footer-social a:hover svg {
      stroke: #fff;
    }

    .footer-social svg {
      width: 16px;
      height: 16px;
      stroke: var(--blue);
    }

    .footer-col h5 {
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--text-soft);
      margin-bottom: 20px;
    }

    .footer-col a {
      display: block;
      font-size: 14.5px;
      color: var(--text);
      margin-bottom: 14px;
      transition: 0.25s;
    }

    .footer-col a:hover {
      color: var(--blue);
      transform: translateX(3px);
    }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 28px;
      font-size: 13px;
      color: var(--text-soft);
      flex-wrap: wrap;
      gap: 12px;
    }

    /* ============ WHATSAPP FLOAT ============ */
    .wa-float {
      position: fixed;
      bottom: 28px;
      right: 28px;
      width: 58px;
      height: 58px;
      border-radius: 50%;
      background: #25d366;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 900;
      box-shadow: 0 12px 30px rgba(37, 211, 102, 0.45);
      transition: 0.3s var(--ease);
      animation: float 3s ease-in-out infinite;
    }

    .wa-float:hover {
      transform: scale(1.1);
    }

    .wa-float svg {
      width: 28px;
      height: 28px;
      fill: #fff;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-8px);
      }
    }

    /* ============ SCROLL ANIMATIONS ============ */
    [data-animate] {
      opacity: 0;
      transition:
        opacity 0.8s var(--ease),
        transform 0.8s var(--ease),
        filter 0.8s var(--ease);
    }

    [data-animate="fade-up"] {
      transform: translateY(40px);
    }

    [data-animate="zoom"] {
      transform: scale(0.9);
    }

    [data-animate="blur-in"] {
      filter: blur(10px);
    }

    [data-animate].in-view {
      opacity: 1;
      transform: none;
      filter: blur(0);
    }

    @media (max-width: 1024px) {
      .hero-grid {
        grid-template-columns: 1fr;
        text-align: center;
      }

      .hero-desc {
        margin-left: auto;
        margin-right: auto;
      }

      .hero-actions {
        justify-content: center;
      }

      .units-grid,
      .why-grid {
        grid-template-columns: 1fr 1fr;
      }

      .about-card {
        grid-template-columns: 1fr;
      }

      .stats-grid {
        grid-template-columns: 1fr 1fr;
      }

      .timeline {
        grid-template-columns: 1fr 1fr;
      }

      .footer-top {
        grid-template-columns: 1fr 1fr;
      }

      .nav-links,
      .search-wrap,
      .lang-switch {
        display: none;
      }
    }

    @media (max-width: 640px) {

      .units-grid,
      .why-grid,
      .stats-grid {
        grid-template-columns: 1fr;
      }

      .masonry {
        columns: 1;
      }

      .about-card {
        padding: 36px 24px;
      }

      .stats-section,
      .cta-section {
        margin: 0 16px;
        padding: 60px 24px;
      }

      .footer-top {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>
  <div id="scroll-progress"></div>

  <!-- ============ NAVBAR ============ -->
  <header id="site-header">
    <div class="nav-inner">
      <a href="/index.php#home" class="logo">
        <img src="/assets/logo_header.png" alt="MBC Logo" class="logo-img" />
      </a>
      <nav class="nav-links">
        <a href="/index.php#home" data-en="Home">Beranda</a>
        <a href="/index.php#about" data-en="About">Tentang</a>
        <div class="has-mega">
          <span class="nav-item" data-en="Business Units">Unit Bisnis</span>
          <div class="mega-menu">
            <a class="mega-item" href="/index.php#units">
              <span class="mi-icon"><svg viewBox="0 0 24 24" stroke-width="2" stroke="#fff">
                  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                </svg></span>
              <h4 data-en="Mardira Press">Mardira Press</h4>
              <p data-en="Publishing, ISBN, journals, printing">
                Publikasi, ISBN, jurnal, percetakan
              </p>
            </a>
            <a class="mega-item" href="/index.php#units">
              <span class="mi-icon"><svg viewBox="0 0 24 24" stroke-width="2" stroke="#fff">
                  <circle cx="12" cy="12" r="2.5" />
                  <circle cx="5" cy="6" r="2" />
                  <circle cx="19" cy="6" r="2" />
                  <circle cx="5" cy="18" r="2" />
                  <circle cx="19" cy="18" r="2" />
                  <path d="M10 11 6.5 7.3M14 11l3.5-3.7M10 13l-3.5 3.7M14 13l3.5 3.7" />
                </svg></span>
              <h4 data-en="Mardira Hub">Mardira Hub</h4>
              <p data-en="Coworking, incubation, training">
                Coworking, inkubasi, pelatihan
              </p>
            </a>
            <a class="mega-item" href="/index.php#units">
              <span class="mi-icon"><svg viewBox="0 0 24 24" stroke-width="2" stroke="#fff">
                  <rect x="3" y="4" width="18" height="12" rx="2" />
                  <path d="M8 21h8M12 16v5" />
                  <path d="M8.5 8.5L7 10l1.5 1.5M12.5 8.5L14 10l-1.5 1.5" />
                </svg></span>
              <h4 data-en="Mardira IT Consulting">Mardira IT Consulting</h4>
              <p data-en="IT consulting, software, digital solutions">
                Konsultasi IT, software, solusi digital
              </p>
            </a>
          </div>
        </div>
        <a href="/index.php#why" data-en="Why MBC">Mengapa MBC</a>
        <a href="/index.php#projects" data-en="Projects">Proyek</a>
        <a href="/index.php#contact" data-en="Contact">Kontak</a>
      </nav>
      <div class="nav-right">
        <form action="/search.php" method="get" class="search-wrap" id="searchWrap">
          <button type="button" class="icon-btn" id="searchBtn" aria-label="Search">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
              <circle cx="11" cy="11" r="7" />
              <path d="M21 21l-4.3-4.3" />
            </svg>
          </button>
          <input type="text" name="q" placeholder="Cari..." value="<?= htmlspecialchars($_GET['q'] ?? ''); ?>" />
        </form>
        <div class="lang-switch">
          <button class="lang-btn active" data-lang="id">ID</button>
          <button class="lang-btn" data-lang="en">EN</button>
        </div>
        <button class="icon-btn" id="themeToggle" aria-label="Toggle dark mode">
          <svg id="themeIcon" viewBox="0 0 24 24" fill="none" stroke-width="2">
            <circle cx="12" cy="12" r="5" />
            <path
              d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
          </svg>
        </button>
        <a href="/index.php#contact" class="nav-cta" data-en="Contact Us">Hubungi Kami</a>
        <a href="admin_mbc/login.php" class="nav-cta" data-en="Login">Login</a>
      </div>
    </div>
  </header>
