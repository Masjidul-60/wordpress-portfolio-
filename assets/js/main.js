(function () {
  'use strict';
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* header + mobile menu */
  var header = $('.site-header');
  var toggle = $('.nav-toggle');
  function onScroll() { header.classList.toggle('is-solid', window.scrollY > 24); }
  onScroll(); window.addEventListener('scroll', onScroll, { passive: true });
  if (toggle) {
    toggle.addEventListener('click', function () {
      var open = document.body.classList.toggle('nav-open');
      toggle.setAttribute('aria-expanded', open);
      toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    });
    function closeMenu() { document.body.classList.remove('nav-open'); toggle.setAttribute('aria-expanded', 'false'); toggle.setAttribute('aria-label', 'Open menu'); }
    $$('.nav a').forEach(function (a) { a.addEventListener('click', closeMenu); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && document.body.classList.contains('nav-open')) { closeMenu(); toggle.focus(); } });
    window.addEventListener('resize', function () { if (window.innerWidth > 1100) closeMenu(); });
  }

  /* active nav link */
  var spies = $$('[data-spy]');
  if (spies.length && 'IntersectionObserver' in window) {
    var map = {};
    spies.forEach(function (a) { map[a.getAttribute('data-spy')] = a; });
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          spies.forEach(function (a) { a.classList.remove('is-active'); a.removeAttribute('aria-current'); });
          if (map[e.target.id]) { map[e.target.id].classList.add('is-active'); map[e.target.id].setAttribute('aria-current', 'true'); }
        }
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    Object.keys(map).forEach(function (id) { var el = document.getElementById(id); if (el) io.observe(el); });
  }

  /* hero video: respect reduced motion */
  var vid = $('.hero__video');
  if (vid && reduce) { vid.removeAttribute('autoplay'); vid.pause(); }

  /* project filter */
  var fbtns = $$('.filters button');
  fbtns.forEach(function (b) {
    b.addEventListener('click', function () {
      var f = b.getAttribute('data-filter');
      fbtns.forEach(function (x) { x.classList.toggle('is-on', x === b); });
      $$('.proj').forEach(function (p) { p.hidden = !(f === 'all' || p.getAttribute('data-cat') === f); });
    });
  });

  /* gallery lightbox */
  var links = $$('.gallery .gal a');
  if (links.length) {
    var idx = 0;
    var lb = document.createElement('div');
    lb.className = 'lightbox'; lb.setAttribute('role', 'dialog'); lb.setAttribute('aria-modal', 'true'); lb.setAttribute('aria-label', 'Image viewer');
    lb.innerHTML = '<button class="lb-close" aria-label="Close">✕</button><button class="lb-prev" aria-label="Previous">‹</button><img alt=""><p></p><button class="lb-next" aria-label="Next">›</button>';
    document.body.appendChild(lb);
    var img = $('img', lb), cap = $('p', lb);
    function show(i) {
      idx = (i + links.length) % links.length;
      img.src = links[idx].getAttribute('href');
      img.alt = links[idx].getAttribute('data-caption') || '';
      cap.textContent = img.alt;
    }
    function open(i) { show(i); lb.classList.add('is-open'); $('.lb-close', lb).focus(); }
    function close() { lb.classList.remove('is-open'); links[idx].focus(); }
    links.forEach(function (a, i) { a.addEventListener('click', function (e) { e.preventDefault(); open(i); }); });
    $('.lb-close', lb).addEventListener('click', close);
    $('.lb-prev', lb).addEventListener('click', function () { show(idx - 1); });
    $('.lb-next', lb).addEventListener('click', function () { show(idx + 1); });
    lb.addEventListener('click', function (e) { if (e.target === lb) close(); });
    document.addEventListener('keydown', function (e) {
      if (!lb.classList.contains('is-open')) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') show(idx - 1);
      if (e.key === 'ArrowRight') show(idx + 1);
    });
  }

  /* EEG rhythm explorer (illustrative simulation) */
  var cv = $('#eeg-canvas');
  if (cv) {
    var ctx = cv.getContext('2d');
    var inputs = ['delta', 'theta', 'alpha', 'beta'].map(function (k) { return $('#band-' + k); });
    var outs = ['delta', 'theta', 'alpha', 'beta'].map(function (k) { return $('[data-out="' + k + '"]'); });
    var freq = [2, 6, 10, 20], weight = [1, .75, .65, .38], phase = [0.4, 1.9, 3.1, 5.2];
    var t = 0, visible = true, w = 0, h = 0, last = 0;
    function size() {
      var dpr = window.devicePixelRatio || 1;
      w = cv.clientWidth; h = cv.clientHeight;
      cv.width = w * dpr; cv.height = h * dpr; ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }
    function amps() { return inputs.map(function (el) { return el.value / 100; }); }
    function draw() {
      var a = amps(), x, i, v, y;
      ctx.clearRect(0, 0, w, h);
      ctx.strokeStyle = 'rgba(255,255,255,.05)'; ctx.lineWidth = 1;
      for (x = 0; x < w; x += 60) { ctx.beginPath(); ctx.moveTo(x + .5, 0); ctx.lineTo(x + .5, h); ctx.stroke(); }
      for (y = 0; y < h; y += 60) { ctx.beginPath(); ctx.moveTo(0, y + .5); ctx.lineTo(w, y + .5); ctx.stroke(); }
      ctx.strokeStyle = 'rgba(255,255,255,.12)'; ctx.beginPath(); ctx.moveTo(0, h / 2); ctx.lineTo(w, h / 2); ctx.stroke();
      ctx.lineWidth = 2; ctx.lineJoin = 'round'; ctx.strokeStyle = '#6ea8ff'; ctx.shadowColor = 'rgba(110,168,255,.7)'; ctx.shadowBlur = 12;
      ctx.beginPath();
      for (x = 0; x <= w; x += 2) {
        var tt = t + x / w * 4; v = 0;
        for (i = 0; i < 4; i++) v += a[i] * weight[i] * Math.sin(6.2832 * freq[i] * tt + phase[i]);
        v += .06 * Math.sin(6.2832 * 37 * tt + 1.3) + .04 * Math.sin(6.2832 * 53 * tt + .2);
        y = h / 2 - v * h * .2;
        y = Math.max(8, Math.min(h - 8, y));
        if (x === 0) ctx.moveTo(x, y); else ctx.lineTo(x, y);
      }
      ctx.stroke(); ctx.shadowBlur = 0;
    }
    function loop(ts) {
      if (visible && !reduce) { t += Math.min(.05, (ts - last) / 1000) * .6; draw(); }
      last = ts; requestAnimationFrame(loop);
    }
    function sync() { inputs.forEach(function (el, i) { outs[i].textContent = el.value + '%'; }); draw(); }
    inputs.forEach(function (el) { el.addEventListener('input', function () { $$('.presets button').forEach(function (b) { b.classList.remove('is-on'); }); sync(); }); });
    $$('.presets button').forEach(function (b) {
      b.addEventListener('click', function () {
        b.getAttribute('data-preset').split(',').forEach(function (n, i) { inputs[i].value = n; });
        $$('.presets button').forEach(function (x) { x.classList.toggle('is-on', x === b); });
        sync();
      });
    });
    window.addEventListener('resize', function () { size(); draw(); });
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (e) { visible = e[0].isIntersecting; }, { threshold: 0 }).observe(cv);
    }
    size(); sync(); requestAnimationFrame(loop);
  }
})();
