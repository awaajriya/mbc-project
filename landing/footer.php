<footer>
  <div class="container">
    <div class="footer-top">
      <div class="footer-brand">
        <a href="#home" class="logo">
          <img src="/assets/logo_footer.png" alt="MBC Logo" class="footer-logo-img" />
        </a>
        <p data-en="The official business, innovation, and entrepreneurship ecosystem of Politeknik Mardira Indonesia.">
          Ekosistem bisnis, inovasi, dan kewirausahaan resmi Politeknik Mardira Indonesia.
        </p>
        <div class="footer-social">
          <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="2" width="20" height="20" rx="5" />
              <circle cx="12" cy="12" r="4" />
              <circle cx="17.5" cy="6.5" r="1" />
            </svg></a>
          <a href="#" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4V8h4v1.5A6 6 0 0 1 16 8z" />
              <rect x="2" y="9" width="4" height="12" />
              <circle cx="4" cy="4" r="2" />
            </svg></a>
          <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
  </div>
</footer>

<a href="https://wa.me/6222123456789" target="_blank" class="wa-float" aria-label="WhatsApp">
  <svg viewBox="0 0 24 24">
    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.79.47 3.48 1.29 4.94L2 22l5.29-1.39a9.9 9.9 0 0 0 4.75 1.21h.01c5.46 0 9.91-4.45 9.91-9.91C21.96 6.45 17.51 2 12.04 2zm5.79 14.02c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.13.11-1.82-.12-.42-.14-.96-.32-1.65-.62-2.9-1.25-4.79-4.17-4.94-4.36-.14-.2-1.18-1.57-1.18-3 0-1.42.75-2.12 1.01-2.41.27-.29.58-.36.78-.36.19 0 .39 0 .55.01.18.01.42-.07.65.5.24.58.82 2 .89 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.29.72 1.19 1.55 1.93 1.06.95 1.96 1.24 2.24 1.38.29.14.45.12.62-.07.17-.19.72-.84.91-1.13.19-.29.39-.24.65-.14.27.1 1.68.79 1.97.93.28.14.47.21.54.33.07.12.07.68-.17 1.36z" />
  </svg>
</a>

<script>
  const header = document.getElementById("site-header");
  const progressBar = document.getElementById("scroll-progress");
  window.addEventListener("scroll", () => {
    const y = window.scrollY;
    header.classList.toggle("scrolled", y > 20);
    const h = document.documentElement.scrollHeight - window.innerHeight;
    progressBar.style.width = (h > 0 ? (y / h) * 100 : 0) + "%";
  });

  const searchBtn = document.getElementById("searchBtn");
  const searchWrap = document.getElementById("searchWrap");
  searchBtn.addEventListener("click", () => searchWrap.classList.toggle("open"));

  const themeToggle = document.getElementById("themeToggle");
  themeToggle.addEventListener("click", () => {
    document.body.classList.toggle("dark");
  });

  document.querySelectorAll("[data-en]").forEach((el) => {
    if (!el.dataset.id) el.dataset.id = el.textContent;
  });
  document.querySelectorAll(".lang-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const lang = btn.dataset.lang;
      document.querySelectorAll(".lang-btn").forEach((b) => b.classList.toggle("active", b === btn));
      document.querySelectorAll("[data-en]").forEach((el) => {
        el.textContent = lang === "en" ? el.dataset.en : el.dataset.id;
      });
      document.documentElement.lang = lang;
    });
  });

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) e.target.classList.add("in-view");
      });
    },
    { threshold: 0.15 }
  );
  document.querySelectorAll("[data-animate]").forEach((el) => io.observe(el));

  document.querySelectorAll(".units-grid, .why-grid, .timeline, .masonry").forEach((group) => {
    [...group.children].forEach((child, i) => {
      child.style.transitionDelay = i * 0.08 + "s";
    });
  });

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
    { threshold: 0.4 }
  );
  const statsSection = document.querySelector(".stats-section");
  if (statsSection) statsIo.observe(statsSection);

  const nodes = document.querySelectorAll("#hero-svg .node");
  const tooltip = document.getElementById("heroTooltip");
  const heroVisual = document.getElementById("heroVisual");

  nodes.forEach((node) => {
    const group = node.dataset.group;
    if (group === "center") return;
    node.addEventListener("mouseenter", () => {
      document.querySelectorAll(`#hero-svg [data-group="${group}"]`).forEach((el) => el.classList.add("active"));
      tooltip.querySelector("h5").textContent = node.dataset.title;
      tooltip.querySelector("p").textContent = node.dataset.desc;
      tooltip.classList.add("show");
      positionTooltip(node);
    });
    node.addEventListener("mouseleave", () => {
      document.querySelectorAll(`#hero-svg [data-group="${group}"]`).forEach((el) => el.classList.remove("active"));
      tooltip.classList.remove("show");
    });
  });

  function positionTooltip(node) {
    const circle = node.querySelector("circle.primary");
    const cx = +circle.getAttribute("cx"), cy = +circle.getAttribute("cy");
    const svg = document.getElementById("hero-svg");
    const rect = svg.getBoundingClientRect();
    const heroRect = heroVisual.getBoundingClientRect();
    const scaleX = rect.width / 600, scaleY = rect.height / 600;
    const left = rect.left - heroRect.left + cx * scaleX + 44;
    const top = rect.top - heroRect.top + cy * scaleY - 30;
    tooltip.style.left = Math.min(left, heroRect.width - 220) + "px";
    tooltip.style.top = Math.max(top, 0) + "px";
  }

  document.querySelector(".hero").addEventListener("mousemove", (e) => {
    const rect = heroVisual.getBoundingClientRect();
    const relX = (e.clientX - rect.left - rect.width / 2) / rect.width;
    const relY = (e.clientY - rect.top - rect.height / 2) / rect.height;
    document.getElementById("hero-svg").style.transform = `translate(${relX * 12}px, ${relY * 12}px)`;
  });

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
    [...dotsWrap.children].forEach((d, idx) => d.classList.toggle("active", idx === testiIndex));
  }
  document.getElementById("testiPrev").addEventListener("click", () => goToSlide(testiIndex - 1));
  document.getElementById("testiNext").addEventListener("click", () => goToSlide(testiIndex + 1));
  let testiTimer = setInterval(() => goToSlide(testiIndex + 1), 5500);
  document.querySelector(".testi-wrap").addEventListener("mouseenter", () => clearInterval(testiTimer));
  document.querySelector(".testi-wrap").addEventListener("mouseleave", () => (testiTimer = setInterval(() => goToSlide(testiIndex + 1), 5500)));
</script>
</body>
</html>
