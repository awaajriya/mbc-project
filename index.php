<?php
// File utama website MBC
$title = "Mardira Business Center";
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
      scroll-behavior: smooth;
    }

    body {
      font-family: "Inter", sans-serif;
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
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 32px;
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
      padding: 120px 0;
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
      font-size: clamp(28px, 3.4vw, 44px);
      font-weight: 700;
      line-height: 1.15;
      margin-bottom: 16px;
    }

    .section-sub {
      font-size: 17px;
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


    .logo .mark {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--blue), var(--blue-deep));
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    .logo .mark::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, transparent 40%, var(--gold) 150%);
      opacity: 0.6;
    }

    .logo .mark svg {
      position: relative;
      z-index: 1;
      width: 20px;
      height: 20px;
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
      padding: 180px 0 100px;
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
      font-size: clamp(40px, 5vw, 64px);
      line-height: 1.03;
      font-weight: 700;
      margin-bottom: 26px;
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
      font-size: 19px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 14px;
    }

    .hero-desc {
      font-size: 16.5px;
      color: var(--text-soft);
      line-height: 1.7;
      max-width: 480px;
      margin-bottom: 36px;
    }

    .hero-actions {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
    }

    .hero-visual {
      position: relative;
      height: 560px;
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
    }

    .trusted-item:hover {
      opacity: 1;
      filter: grayscale(0);
      color: var(--blue);
    }

    /* ============ ABOUT ============ */
    .about-card {
      background: var(--card-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 32px;
      padding: 64px;
      box-shadow: var(--shadow-soft);
      position: relative;
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
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
      padding: 40px 32px;
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

    .why-icon svg {
      width: 22px;
      height: 22px;
      stroke: var(--blue);
    }

    body.dark .why-icon {
      background: rgba(246, 184, 0, 0.1);
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

    .testi-dot.active {
      background: var(--blue);
      width: 26px;
      border-radius: 100px;
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
      border-radius: 40px;
      padding: 90px 60px;
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
      padding: 90px 0 32px;
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
      <a href="#home" class="logo">
        <img src="assets/logo_header.png" alt="MBC Logo" class="logo-img" />
      </a>
      <nav class="nav-links">
        <a href="#home" data-en="Home">Beranda</a>
        <a href="#about" data-en="About">Tentang</a>
        <div class="has-mega">
          <span class="nav-item" data-en="Business Units">Unit Bisnis</span>
          <div class="mega-menu">
            <a class="mega-item" href="#units">
              <span class="mi-icon"><svg viewBox="0 0 24 24" stroke-width="2" stroke="#fff">
                  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                </svg></span>
              <h4 data-en="Mardira Press">Mardira Press</h4>
              <p data-en="Publishing, ISBN, journals, printing">
                Publikasi, ISBN, jurnal, percetakan
              </p>
            </a>
            <a class="mega-item" href="#units">
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
            <a class="mega-item" href="#units">
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
        <a href="#why" data-en="Why MBC">Mengapa MBC</a>
        <a href="#projects" data-en="Projects">Proyek</a>
        <a href="#contact" data-en="Contact">Kontak</a>
      </nav>
      <div class="nav-right">
        <div class="search-wrap" id="searchWrap">
          <button class="icon-btn" id="searchBtn" aria-label="Search">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
              <circle cx="11" cy="11" r="7" />
              <path d="M21 21l-4.3-4.3" />
            </svg>
          </button>
          <input type="text" placeholder="Cari..." />
        </div>
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
        <a href="#contact" class="nav-cta" data-en="Contact Us">Hubungi Kami</a>
        <a href="admin_mbc/login.php" class="nav-cta" data-en="Login">Login</a>
      </div>
    </div>
  </header>

  <!-- ============ HERO ============ -->
  <section class="hero" id="home">
    <div class="mesh-bg"><span></span><span></span><span></span></div>
    <div class="container hero-grid">
      <div>
        <div class="hero-kicker">
          <span class="dot"></span>
          <span data-en="Official Business Ecosystem of PMI">Ekosistem Bisnis Resmi PMI</span>
        </div>
        <h1>
          <span class="l1">MARDIRA</span>
          <span class="l1">BUSINESS</span>
          <span class="l2">CENTER</span>
        </h1>
        <p class="hero-tagline" data-en="Empowering Innovation, Business & Entrepreneurship.">
          Empowering Innovation, Business & Entrepreneurship.
        </p>
        <p class="hero-desc"
          data-en="Building an integrated business, innovation, and entrepreneurship ecosystem under Politeknik Mardira Indonesia.">
          Membangun ekosistem bisnis, inovasi, dan kewirausahaan yang
          terintegrasi di bawah Politeknik Mardira Indonesia.
        </p>
        <div class="hero-actions">
          <a href="#units" class="btn btn-primary"><span data-en="Explore Business">Jelajahi Bisnis</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M13 5l7 7-7 7" />
            </svg></a>
          <a href="#contact" class="btn btn-ghost"><span data-en="Contact Us">Hubungi Kami</span></a>
        </div>
      </div>

      <div class="hero-visual" id="heroVisual">
        <svg id="hero-svg" viewBox="0 0 600 600">
          <defs>
            <radialGradient id="coreGrad" cx="35%" cy="30%" r="75%">
              <stop offset="0%" stop-color="#3E71C4" />
              <stop offset="100%" stop-color="#0F2E5C" />
            </radialGradient>
            <linearGradient id="lineGrad" x1="0" y1="0" x2="1" y2="1">
              <stop offset="0%" stop-color="#1E4E96" />
              <stop offset="100%" stop-color="#F6B800" />
            </linearGradient>
          </defs>

          <!-- links: core to primary -->
          <line class="link" data-group="press" x1="300" y1="300" x2="150" y2="165" />
          <line class="link" data-group="hub" x1="300" y1="300" x2="452" y2="165" />
          <line class="link" data-group="store" x1="300" y1="300" x2="300" y2="490" />

          <!-- links: primary to secondary -->
          <line class="link" data-group="press" x1="150" y1="165" x2="55" y2="95" />
          <line class="link" data-group="press" x1="150" y1="165" x2="75" y2="255" />
          <line class="link" data-group="hub" x1="452" y1="165" x2="548" y2="95" />
          <line class="link" data-group="hub" x1="452" y1="165" x2="528" y2="255" />
          <line class="link" data-group="store" x1="300" y1="490" x2="170" y2="555" />
          <line class="link" data-group="store" x1="300" y1="490" x2="430" y2="555" />

          <!-- core node -->
          <g class="node" data-group="center">
            <circle class="core" cx="300" cy="300" r="46" />
            <text class="core-label" x="300" y="306" text-anchor="middle">
              MBC
            </text>
          </g>

          <!-- press -->
          <g class="node" data-group="press" data-title="Mardira Press"
            data-desc="Publikasi buku, ISBN, jurnal ilmiah, dan layanan percetakan profesional.">
            <circle class="primary" cx="150" cy="165" r="32" />
            <text class="node-label" x="150" y="211" text-anchor="middle">
              Press
            </text>
            <circle class="secondary" cx="55" cy="95" r="6" />
            <text class="sub-label" x="55" y="80" text-anchor="middle">
              Publishing
            </text>
            <circle class="secondary" cx="75" cy="255" r="6" />
            <text class="sub-label" x="75" y="272" text-anchor="middle">
              ISBN & Journal
            </text>
          </g>

          <!-- hub -->
          <g class="node" data-group="hub" data-title="Mardira Hub"
            data-desc="Coworking space, inkubasi bisnis, pelatihan, workshop, dan konsultasi.">
            <circle class="primary" cx="452" cy="165" r="32" />
            <text class="node-label" x="452" y="211" text-anchor="middle">
              Hub
            </text>
            <circle class="secondary" cx="548" cy="95" r="6" />
            <text class="sub-label" x="548" y="80" text-anchor="middle">
              Incubator
            </text>
            <circle class="secondary" cx="528" cy="255" r="6" />
            <text class="sub-label" x="528" y="272" text-anchor="middle">
              Training
            </text>
          </g>

          <!-- IT consulting -->
          <g class="node" data-group="store" data-title="Mardira IT Consulting"
            data-desc="Konsultasi IT, pengembangan software, strategi digital, dan integrasi sistem.">
            <circle class="primary" cx="300" cy="490" r="32" />
            <text class="node-label" x="300" y="536" text-anchor="middle">
              IT
            </text>
            <circle class="secondary" cx="170" cy="555" r="6" />
            <text class="sub-label" x="170" y="572" text-anchor="middle">
              Software Dev
            </text>
            <circle class="secondary" cx="430" cy="555" r="6" />
            <text class="sub-label" x="430" y="572" text-anchor="middle">
              Cloud & Systems
            </text>
          </g>
        </svg>
        <div class="hero-tooltip" id="heroTooltip">
          <h5></h5>
          <p></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ TRUSTED BY ============ -->
  <section class="trusted">
    <div class="container">
      <p class="trusted-label" data-en="Supported By">Didukung Oleh</p>
      <div class="trusted-row">
        <div class="trusted-item">Politeknik Mardira Indonesia</div>
        <div class="trusted-item" data-en="Industry Partners">
          Mitra Industri
        </div>
        <div class="trusted-item" data-en="Government">Pemerintah</div>
        <div class="trusted-item">UMKM</div>
        <div class="trusted-item">Startup</div>
        <div class="trusted-item" data-en="Community">Komunitas</div>
      </div>
    </div>
  </section>

  <!-- ============ ABOUT ============ -->
  <section class="section-pad" id="about">
    <div class="container">
      <div class="about-card" data-animate="fade-up">
        <div>
          <span class="eyebrow" data-en="Business Ecosystem">Business Ecosystem</span>
          <h2 class="section-title" data-en="One integrated platform connecting education and industry.">
            Satu platform terintegrasi yang menghubungkan pendidikan dan
            industri.
          </h2>
          <p class="section-sub"
            data-en="MBC is a business development center that connects academics, industry, startups, MSMEs, and communities within a single unified ecosystem.">
            MBC adalah pusat pengembangan bisnis yang menghubungkan akademisi,
            industri, startup, UMKM, dan masyarakat dalam satu ekosistem.
          </p>
        </div>
        <div class="about-network">
          <svg viewBox="0 0 400 280" width="100%" height="100%">
            <g stroke="url(#lineGrad2)" stroke-width="1.4" opacity=".55">
              <line x1="200" y1="140" x2="70" y2="60" />
              <line x1="200" y1="140" x2="330" y2="60" />
              <line x1="200" y1="140" x2="60" y2="210" />
              <line x1="200" y1="140" x2="340" y2="210" />
              <line x1="200" y1="140" x2="200" y2="30" />
              <line x1="200" y1="140" x2="200" y2="250" />
            </g>
            <defs>
              <linearGradient id="lineGrad2" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#1E4E96" />
                <stop offset="100%" stop-color="#F6B800" />
              </linearGradient>
            </defs>
            <circle cx="200" cy="140" r="26" fill="#1E4E96" />
            <circle cx="70" cy="60" r="9" fill="#F6B800" />
            <circle cx="330" cy="60" r="9" fill="#1E4E96" />
            <circle cx="60" cy="210" r="9" fill="#1E4E96" />
            <circle cx="340" cy="210" r="9" fill="#F6B800" />
            <circle cx="200" cy="30" r="7" fill="#F6B800" />
            <circle cx="200" cy="250" r="7" fill="#1E4E96" />
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ BUSINESS UNITS ============ -->
  <section class="section-pad" id="units">
    <div class="container">
      <div class="center" style="max-width: 640px" data-animate="fade-up">
        <span class="eyebrow" data-en="What We Offer">Apa yang Kami Tawarkan</span>
        <h2 class="section-title" data-en="Our Business Units">
          Unit Bisnis Kami
        </h2>
        <p class="section-sub center"
          data-en="Three integrated pillars supporting publication, incubation, and commerce.">
          Tiga pilar terintegrasi yang mendukung publikasi, inkubasi, dan
          perdagangan.
        </p>
      </div>

      <div class="units-grid">
        <div class="unit-card" data-animate="fade-up">
          <div class="unit-icon">
            <svg viewBox="0 0 24 24" stroke-width="2">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
              <path d="M9 7h7M9 11h7" />
            </svg>
          </div>
          <span class="unit-tag">01 · Publishing</span>
          <h3>Mardira Press</h3>
          <ul class="unit-list">
            <li>Publication</li>
            <li>ISBN Registration</li>
            <li>Scientific Journal</li>
            <li>Book Publishing</li>
            <li>Printing</li>
          </ul>
          <a href="#" class="unit-link"><span data-en="Learn More">Pelajari Lebih Lanjut</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
              <path d="M5 12h14M13 5l7 7-7 7" />
            </svg></a>
        </div>

        <div class="unit-card" data-animate="fade-up">
          <div class="unit-icon">
            <svg viewBox="0 0 24 24" stroke-width="2">
              <circle cx="12" cy="12" r="2.5" />
              <circle cx="5" cy="6" r="2" />
              <circle cx="19" cy="6" r="2" />
              <circle cx="5" cy="18" r="2" />
              <circle cx="19" cy="18" r="2" />
              <path d="M10 11 6.5 7.3M14 11l3.5-3.7M10 13l-3.5 3.7M14 13l3.5 3.7" />
            </svg>
          </div>
          <span class="unit-tag">02 · Incubation</span>
          <h3>Mardira Hub</h3>
          <ul class="unit-list">
            <li>Coworking Space</li>
            <li>Business Incubator</li>
            <li>Training</li>
            <li>Workshop & Event</li>
            <li>Consulting</li>
          </ul>
          <a href="#" class="unit-link"><span data-en="Explore">Jelajahi</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
              <path d="M5 12h14M13 5l7 7-7 7" />
            </svg></a>
        </div>

        <div class="unit-card" data-animate="fade-up">
          <div class="unit-icon">
            <svg viewBox="0 0 24 24" stroke-width="2">
              <rect x="3" y="4" width="18" height="12" rx="2" />
              <path d="M8 21h8M12 16v5" />
              <path d="M8.5 8.5L7 10l1.5 1.5M12.5 8.5L14 10l-1.5 1.5" />
            </svg>
          </div>
          <span class="unit-tag" data-en="03 · Consulting">03 · Konsultasi</span>
          <h3>Mardira IT Consulting</h3>
          <ul class="unit-list">
            <li data-en="IT Consulting">Konsultasi IT</li>
            <li data-en="Software Development">Pengembangan Software</li>
            <li data-en="Digital Strategy">Strategi Digital</li>
            <li data-en="Cloud Solutions">Solusi Cloud</li>
            <li data-en="System Integration">Integrasi Sistem</li>
          </ul>
          <a href="#" class="unit-link"><span data-en="Get Consultation">Konsultasi Sekarang</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
              <path d="M5 12h14M13 5l7 7-7 7" />
            </svg></a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ WHY CHOOSE ============ -->
  <section class="section-pad" id="why" style="background: rgba(30, 78, 150, 0.03)">
    <div class="container">
      <div class="center" style="max-width: 640px" data-animate="fade-up">
        <span class="eyebrow" data-en="Our Advantage">Keunggulan Kami</span>
        <h2 class="section-title" data-en="Why Choose MBC">
          Mengapa Memilih MBC
        </h2>
      </div>
      <div class="why-grid">
        <div class="why-card" data-animate="fade-up">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path
                d="M9 18h6M10 22h4M12 2a6 6 0 0 0-4 10.5c.6.5 1 1.3 1 2.1V16h6v-1.4c0-.8.4-1.6 1-2.1A6 6 0 0 0 12 2z" />
            </svg>
          </div>
          <h4 data-en="Innovation">Inovasi</h4>
          <p data-en="Encouraging fresh ideas that turn into real, sustainable ventures.">
            Mendorong ide-ide segar menjadi usaha nyata yang berkelanjutan.
          </p>
        </div>
        <div class="why-card" data-animate="fade-up">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <h4 data-en="Professional Team">Tim Profesional</h4>
          <p data-en="Experienced mentors and advisors guiding every stage of growth.">
            Mentor dan penasihat berpengalaman membimbing setiap tahap
            pertumbuhan.
          </p>
        </div>
        <div class="why-card" data-animate="fade-up">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M8 12h8M12 8v8" />
              <circle cx="12" cy="12" r="10" />
            </svg>
          </div>
          <h4 data-en="Industry Collaboration">Kolaborasi Industri</h4>
          <p data-en="Strong partnerships bridging campus talent with real market needs.">
            Kemitraan kuat menjembatani talenta kampus dengan kebutuhan pasar.
          </p>
        </div>
        <div class="why-card" data-animate="fade-up">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="4" y="4" width="16" height="16" rx="3" />
              <path d="M9 9h6v6H9z" />
              <path d="M4 9h2M4 15h2M18 9h2M18 15h2M9 4v2M15 4v2M9 18v2M15 18v2" />
            </svg>
          </div>
          <h4 data-en="Technology Driven">Berbasis Teknologi</h4>
          <p data-en="Digital infrastructure powering every service in the ecosystem.">
            Infrastruktur digital yang menggerakkan setiap layanan dalam
            ekosistem.
          </p>
        </div>
        <div class="why-card" data-animate="fade-up">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M1 4v6h6M23 20v-6h-6" />
              <path d="M20.5 9A9 9 0 0 0 4.6 5.6L1 10M3.5 15a9 9 0 0 0 15.9 3.4L23 14" />
            </svg>
          </div>
          <h4 data-en="Digital Transformation">Transformasi Digital</h4>
          <p data-en="Modern tools and processes for a more agile business ecosystem.">
            Alat dan proses modern untuk ekosistem bisnis yang lebih adaptif.
          </p>
        </div>
        <div class="why-card" data-animate="fade-up">
          <div class="why-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2l3 6 6.5 1-4.7 4.6L18 20l-6-3.4L6 20l1.2-6.4L2.5 9 9 8z" />
            </svg>
          </div>
          <h4 data-en="Business Incubation">Inkubasi Bisnis</h4>
          <p data-en="Structured programs that turn early ideas into scalable businesses.">
            Program terstruktur mengubah ide awal menjadi bisnis yang siap
            berkembang.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ STATS ============ -->
  <section class="section-pad">
    <div class="stats-section" data-animate="zoom">
      <div class="stats-title">
        <h2 data-en="Growing an Ecosystem That Matters">
          Membangun Ekosistem yang Berdampak
        </h2>
        <p data-en="Numbers that reflect our commitment to collaboration and growth.">
          Angka yang mencerminkan komitmen kami pada kolaborasi dan
          pertumbuhan.
        </p>
      </div>
      <div class="stats-grid">
        <div>
          <div class="stat-num">
            <span class="counter" data-target="250">0</span><span>+</span>
          </div>
          <div class="stat-label" data-en="Business Partners">
            Mitra Bisnis
          </div>
        </div>
        <div>
          <div class="stat-num">
            <span class="counter" data-target="120">0</span><span>+</span>
          </div>
          <div class="stat-label" data-en="Published Books">
            Buku Diterbitkan
          </div>
        </div>
        <div>
          <div class="stat-num">
            <span class="counter" data-target="500">0</span><span>+</span>
          </div>
          <div class="stat-label" data-en="Entrepreneurs Assisted">
            Wirausahawan Dibina
          </div>
        </div>
        <div>
          <div class="stat-num">
            <span class="counter" data-target="30">0</span><span>+</span>
          </div>
          <div class="stat-label" data-en="Industry Collaborations">
            Kolaborasi Industri
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ PROCESS ============ -->
  <section class="section-pad">
    <div class="container">
      <div class="center" style="max-width: 640px" data-animate="fade-up">
        <span class="eyebrow" data-en="How It Works">Cara Kerja</span>
        <h2 class="section-title" data-en="Collaboration Process">
          Proses Kolaborasi
        </h2>
      </div>
      <div class="timeline">
        <div class="tl-step" data-animate="fade-up">
          <div class="tl-dot">1</div>
          <h4 data-en="Idea">Ide</h4>
          <p data-en="Share your concept with our team.">
            Sampaikan konsep Anda kepada tim kami.
          </p>
        </div>
        <div class="tl-step" data-animate="fade-up">
          <div class="tl-dot">2</div>
          <h4 data-en="Consultation">Konsultasi</h4>
          <p data-en="Assessment and strategic direction.">
            Asesmen dan arahan strategis.
          </p>
        </div>
        <div class="tl-step" data-animate="fade-up">
          <div class="tl-dot">3</div>
          <h4 data-en="Development">Pengembangan</h4>
          <p data-en="Building and refining the solution.">
            Membangun dan menyempurnakan solusi.
          </p>
        </div>
        <div class="tl-step" data-animate="fade-up">
          <div class="tl-dot">4</div>
          <h4 data-en="Publication">Publikasi/Komersialisasi</h4>
          <p data-en="Launching to market or publishing.">
            Peluncuran ke pasar atau publikasi.
          </p>
        </div>
        <div class="tl-step" data-animate="fade-up">
          <div class="tl-dot">5</div>
          <h4 data-en="Growth">Pertumbuhan</h4>
          <p data-en="Ongoing support to scale further.">
            Pendampingan berkelanjutan untuk berkembang.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ PROJECTS ============ -->
  <section class="section-pad" id="projects" style="background: rgba(30, 78, 150, 0.03)">
    <div class="container">
      <div class="center" style="max-width: 640px" data-animate="fade-up">
        <span class="eyebrow" data-en="Case Studies">Studi Kasus</span>
        <h2 class="section-title" data-en="Featured Projects">
          Proyek Unggulan
        </h2>
      </div>
      <div class="masonry">
        <div class="proj-card" data-animate="fade-up">
          <div class="proj-media h-tall m-navy">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
            </svg>
          </div>
          <div class="proj-body">
            <span class="proj-cat" data-en="Mardira Press">Mardira Press</span>
            <h4 data-en="National Accredited Journal">
              Jurnal Ilmiah Terakreditasi Nasional
            </h4>
            <p data-en="Supporting lecturers and students in publishing accredited research.">
              Mendukung dosen dan mahasiswa menerbitkan riset terakreditasi.
            </p>
            <a href="#" class="proj-link"><span data-en="View Case Study">Lihat Studi Kasus</span> →</a>
          </div>
        </div>
        <div class="proj-card" data-animate="fade-up">
          <div class="proj-media m-blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <circle cx="12" cy="12" r="2.5" />
              <circle cx="5" cy="6" r="2" />
              <circle cx="19" cy="6" r="2" />
              <circle cx="5" cy="18" r="2" />
              <circle cx="19" cy="18" r="2" />
            </svg>
          </div>
          <div class="proj-body">
            <span class="proj-cat" data-en="Mardira Hub">Mardira Hub</span>
            <h4 data-en="MSME Digitalization Batch 3">
              Inkubasi Digitalisasi UMKM Batch 3
            </h4>
            <p data-en="30 MSMEs onboarded to digital sales channels.">
              30 UMKM diarahkan ke kanal penjualan digital.
            </p>
            <a href="#" class="proj-link"><span data-en="View Case Study">Lihat Studi Kasus</span> →</a>
          </div>
        </div>
        <div class="proj-card" data-animate="fade-up">
          <div class="proj-media h-tall m-gold">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="3" y="4" width="18" height="12" rx="2" />
              <path d="M8 21h8M12 16v5" />
              <path d="M8.5 8.5L7 10l1.5 1.5M12.5 8.5L14 10l-1.5 1.5" />
            </svg>
          </div>
          <div class="proj-body">
            <span class="proj-cat" data-en="Mardira IT Consulting">Mardira IT Consulting</span>
            <h4 data-en="Campus Digital System Integration">
              Integrasi Sistem Digital Kampus
            </h4>
            <p data-en="A unified academic and administration platform built for scale.">
              Platform akademik dan administrasi terpadu yang dibangun untuk
              berkembang.
            </p>
            <a href="#" class="proj-link"><span data-en="View Case Study">Lihat Studi Kasus</span> →</a>
          </div>
        </div>
        <div class="proj-card" data-animate="fade-up">
          <div class="proj-media m-navy">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M12 2l3 6 6.5 1-4.7 4.6L18 20l-6-3.4L6 20l1.2-6.4L2.5 9 9 8z" />
            </svg>
          </div>
          <div class="proj-body">
            <span class="proj-cat" data-en="Mardira Hub">Mardira Hub</span>
            <h4 data-en="AgriTech Startup Cohort">
              Kohort Startup AgriTech Binaan
            </h4>
            <p data-en="From idea to funded pilot in six months.">
              Dari ide menjadi proyek percontohan berdana dalam enam bulan.
            </p>
            <a href="#" class="proj-link"><span data-en="View Case Study">Lihat Studi Kasus</span> →</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ TESTIMONIALS ============ -->
  <section class="section-pad">
    <div class="container">
      <div class="center" style="max-width: 640px" data-animate="fade-up">
        <span class="eyebrow" data-en="Testimonials">Testimoni</span>
        <h2 class="section-title" data-en="Trusted by Our Community">
          Dipercaya oleh Komunitas Kami
        </h2>
      </div>
      <div class="testi-wrap">
        <button class="testi-arrow prev" id="testiPrev">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>
        <button class="testi-arrow next" id="testiNext">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>
        <div class="testi-track">
          <div class="testi-slides" id="testiSlides">
            <div class="testi-slide">
              <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote"
                  data-en="MBC helped me turn a class project into a real product with proper mentorship at every step.">
                  MBC membantu saya mengubah proyek kuliah menjadi produk
                  nyata dengan pendampingan yang tepat di setiap tahap.
                </p>
                <div class="testi-person">
                  <div class="testi-avatar">RA</div>
                  <div>
                    <div class="testi-name">Rangga A.</div>
                    <div class="testi-role" data-en="Student Entrepreneur">
                      Mahasiswa Wirausaha
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi-slide">
              <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote"
                  data-en="Through Mardira Hub, our small business finally has proper branding and an online store.">
                  Melalui Mardira Hub, usaha kecil kami akhirnya memiliki
                  branding yang layak dan toko daring.
                </p>
                <div class="testi-person">
                  <div class="testi-avatar">SN</div>
                  <div>
                    <div class="testi-name">Siti N.</div>
                    <div class="testi-role" data-en="MSME Partner">
                      Mitra UMKM
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi-slide">
              <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote"
                  data-en="Mardira Press made publishing our accredited journal simple, fast, and genuinely professional.">
                  Mardira Press membuat proses penerbitan jurnal terakreditasi
                  kami mudah, cepat, dan benar-benar profesional.
                </p>
                <div class="testi-person">
                  <div class="testi-avatar">DH</div>
                  <div>
                    <div class="testi-name">Dr. Hendra P.</div>
                    <div class="testi-role" data-en="Incubation Advisor">
                      Dosen Pembimbing Inkubasi
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="testi-slide">
              <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote"
                  data-en="A genuine bridge between campus talent and industry — collaborating with MBC has been seamless.">
                  Jembatan yang nyata antara talenta kampus dan industri —
                  berkolaborasi dengan MBC terasa sangat mulus.
                </p>
                <div class="testi-person">
                  <div class="testi-avatar">TW</div>
                  <div>
                    <div class="testi-name">Teguh W.</div>
                    <div class="testi-role" data-en="Industry Partner">
                      Mitra Industri
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testi-nav" id="testiDots"></div>
      </div>
    </div>
  </section>

  <!-- ============ CTA ============ -->
  <section class="section-pad" id="contact">
    <div class="cta-section" data-animate="zoom">
      <h2 data-en="Ready to Build Your Future Business?">
        Siap Membangun Bisnis Masa Depan Anda?
      </h2>
      <p data-en="Join the Mardira Business Center ecosystem today.">
        Bergabunglah dengan ekosistem Mardira Business Center sekarang.
      </p>
      <a href="#" class="btn btn-primary"><span data-en="Get Started">Mulai Sekarang</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 12h14M13 5l7 7-7 7" />
        </svg></a>
    </div>
  </section>

  <!-- ============ FOOTER ============ -->
  <footer>
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <a href="#home" class="logo">
            <img src="assets/logo_footer.png" alt="MBC Logo" class="footer-logo-img" />
          </a>
          <p
            data-en="The official business, innovation, and entrepreneurship ecosystem of Politeknik Mardira Indonesia.">
            Ekosistem bisnis, inovasi, dan kewirausahaan resmi Politeknik
            Mardira Indonesia.
          </p>
          <div class="footer-social">
            <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="2" y="2" width="20" height="20" rx="5" />
                <circle cx="12" cy="12" r="4" />
                <circle cx="17.5" cy="6.5" r="1" />
              </svg></a>
            <a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4V8h4v1.5A6 6 0 0 1 16 8z" />
                <rect x="2" y="9" width="4" height="12" />
                <circle cx="4" cy="4" r="2" />
              </svg></a>
            <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="2" y="5" width="20" height="14" rx="4" />
                <path d="M10 9l5 3-5 3z" />
              </svg></a>
          </div>
        </div>
        <div class="footer-col">
          <h5 data-en="Company">Perusahaan</h5>
          <a href="#about" data-en="About">Tentang</a>
          <a href="#why" data-en="Why MBC">Mengapa MBC</a>
          <a href="#projects" data-en="Projects">Proyek</a>
        </div>
        <div class="footer-col">
          <h5 data-en="Business Units">Unit Bisnis</h5>
          <a href="#units">Mardira Press</a>
          <a href="#units">Mardira Hub</a>
          <a href="#units">Mardira IT Consulting</a>
        </div>
        <div class="footer-col">
          <h5 data-en="Contact">Kontak</h5>
          <a href="#" data-en="hello@mardirabc.id">hello@mardirabc.id</a>
          <a href="#" data-en="+62 22 1234 5678">+62 22 1234 5678</a>
          <a href="#" data-en="Bandung, Indonesia">Bandung, Indonesia</a>
        </div>
      </div>
      <div class="footer-bottom">
        <span data-en="© <?= date('Y'); ?> Mardira Business Center. All rights reserved.">
            © <?= date('Y'); ?> Mardira Business Center. Seluruh hak cipta dilindungi.
        </span>
        <span data-en="A unit of Politeknik Mardira Indonesia">
            Bagian dari Politeknik Mardira Indonesia
        </span>
    </div>
  </footer>

  <a href="https://wa.me/6222123456789" target="_blank" class="wa-float" aria-label="WhatsApp">
    <svg viewBox="0 0 24 24">
      <path
        d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.79.47 3.48 1.29 4.94L2 22l5.29-1.39a9.9 9.9 0 0 0 4.75 1.21h.01c5.46 0 9.91-4.45 9.91-9.91C21.96 6.45 17.51 2 12.04 2zm5.79 14.02c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.13.11-1.82-.12-.42-.14-.96-.32-1.65-.62-2.9-1.25-4.79-4.17-4.94-4.36-.14-.2-1.18-1.57-1.18-3 0-1.42.75-2.12 1.01-2.41.27-.29.58-.36.78-.36.19 0 .39 0 .55.01.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.29.72 1.19 1.55 1.93 1.06.95 1.96 1.24 2.24 1.38.29.14.45.12.62-.07.17-.19.72-.84.91-1.13.19-.29.39-.24.65-.14.27.1 1.68.79 1.97.93.28.14.47.21.54.33.07.12.07.68-.17 1.36z" />
    </svg>
  </a>

  <script>
    // ===== Nav scroll state + scroll progress =====
    const header = document.getElementById("site-header");
    const progressBar = document.getElementById("scroll-progress");
    window.addEventListener("scroll", () => {
      const y = window.scrollY;
      header.classList.toggle("scrolled", y > 20);
      const h = document.documentElement.scrollHeight - window.innerHeight;
      progressBar.style.width = (h > 0 ? (y / h) * 100 : 0) + "%";
    });

    // ===== Search toggle =====
    const searchBtn = document.getElementById("searchBtn");
    const searchWrap = document.getElementById("searchWrap");
    searchBtn.addEventListener("click", () =>
      searchWrap.classList.toggle("open"),
    );

    // ===== Dark mode toggle (in-memory only) =====
    const themeToggle = document.getElementById("themeToggle");
    themeToggle.addEventListener("click", () => {
      document.body.classList.toggle("dark");
    });

    // ===== Language switch =====
    document.querySelectorAll("[data-en]").forEach((el) => {
      if (!el.dataset.id) el.dataset.id = el.textContent;
    });
    document.querySelectorAll(".lang-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        const lang = btn.dataset.lang;
        document
          .querySelectorAll(".lang-btn")
          .forEach((b) => b.classList.toggle("active", b === btn));
        document.querySelectorAll("[data-en]").forEach((el) => {
          el.textContent = lang === "en" ? el.dataset.en : el.dataset.id;
        });
        document.documentElement.lang = lang;
      });
    });

    // ===== Scroll reveal animations =====
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) {
            e.target.classList.add("in-view");
          }
        });
      },
      { threshold: 0.15 },
    );
    document
      .querySelectorAll("[data-animate]")
      .forEach((el) => io.observe(el));

    // ===== Stagger children with a small delay for cards =====
    document
      .querySelectorAll(".units-grid, .why-grid, .timeline, .masonry")
      .forEach((group) => {
        [...group.children].forEach((child, i) => {
          child.style.transitionDelay = i * 0.08 + "s";
        });
      });

    // ===== Counter animation =====
    const counters = document.querySelectorAll(".counter");
    let countersStarted = false;
    function animateCounters() {
      counters.forEach((c) => {
        const target = +c.dataset.target;
        let cur = 0;
        const step = Math.max(1, Math.round(target / 60));
        const tick = () => {
          cur += step;
          if (cur >= target) {
            c.textContent = target;
            return;
          }
          c.textContent = cur;
          requestAnimationFrame(tick);
        };
        tick();
      });
    }
    const statsIo = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting && !countersStarted) {
            countersStarted = true;
            animateCounters();
          }
        });
      },
      { threshold: 0.4 },
    );
    const statsSection = document.querySelector(".stats-section");
    if (statsSection) statsIo.observe(statsSection);

    // ===== Hero network interactivity =====
    const nodes = document.querySelectorAll("#hero-svg .node");
    const links = document.querySelectorAll("#hero-svg .link");
    const tooltip = document.getElementById("heroTooltip");
    const heroVisual = document.getElementById("heroVisual");

    nodes.forEach((node) => {
      const group = node.dataset.group;
      if (group === "center") return;
      node.addEventListener("mouseenter", (e) => {
        document
          .querySelectorAll(`#hero-svg [data-group="${group}"]`)
          .forEach((el) => el.classList.add("active"));
        tooltip.querySelector("h5").textContent = node.dataset.title;
        tooltip.querySelector("p").textContent = node.dataset.desc;
        tooltip.classList.add("show");
        positionTooltip(node);
      });
      node.addEventListener("mouseleave", () => {
        document
          .querySelectorAll(`#hero-svg [data-group="${group}"]`)
          .forEach((el) => el.classList.remove("active"));
        tooltip.classList.remove("show");
      });
    });

    function positionTooltip(node) {
      const circle = node.querySelector("circle.primary");
      const cx = +circle.getAttribute("cx"),
        cy = +circle.getAttribute("cy");
      const svg = document.getElementById("hero-svg");
      const rect = svg.getBoundingClientRect();
      const heroRect = heroVisual.getBoundingClientRect();
      const scaleX = rect.width / 600,
        scaleY = rect.height / 600;
      const left = rect.left - heroRect.left + cx * scaleX + 44;
      const top = rect.top - heroRect.top + cy * scaleY - 30;
      tooltip.style.left = Math.min(left, heroRect.width - 220) + "px";
      tooltip.style.top = Math.max(top, 0) + "px";
    }

    // ===== Mouse parallax on hero visual =====
    document.querySelector(".hero").addEventListener("mousemove", (e) => {
      const rect = heroVisual.getBoundingClientRect();
      const relX = (e.clientX - rect.left - rect.width / 2) / rect.width;
      const relY = (e.clientY - rect.top - rect.height / 2) / rect.height;
      document.getElementById("hero-svg").style.transform =
        `translate(${relX * 12}px, ${relY * 12}px)`;
    });

    // ===== Testimonial carousel =====
    const slidesWrap = document.getElementById("testiSlides");
    const slides = slidesWrap.children;
    const dotsWrap = document.getElementById("testiDots");
    let testiIndex = 0;
    for (let i = 0; i < slides.length; i++) {
      const dot = document.createElement("div");
      dot.className = "testi-dot" + (i === 0 ? " active" : "");
      dot.addEventListener("click", () => goToSlide(i));
      dotsWrap.appendChild(dot);
    }
    function goToSlide(i) {
      testiIndex = (i + slides.length) % slides.length;
      slidesWrap.style.transform = `translateX(-${testiIndex * 100}%)`;
      [...dotsWrap.children].forEach((d, idx) =>
        d.classList.toggle("active", idx === testiIndex),
      );
    }
    document
      .getElementById("testiPrev")
      .addEventListener("click", () => goToSlide(testiIndex - 1));
    document
      .getElementById("testiNext")
      .addEventListener("click", () => goToSlide(testiIndex + 1));
    let testiTimer = setInterval(() => goToSlide(testiIndex + 1), 5500);
    document
      .querySelector(".testi-wrap")
      .addEventListener("mouseenter", () => clearInterval(testiTimer));
    document
      .querySelector(".testi-wrap")
      .addEventListener(
        "mouseleave",
        () =>
          (testiTimer = setInterval(() => goToSlide(testiIndex + 1), 5500)),
      );
  </script>
</body>

</html>