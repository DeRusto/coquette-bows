<style>
  /* ===== Linen + coquette bow background override ===== */
  body {
    background: #efe8da !important;
  }

  #linen-bow-bg {
    position: fixed;
    inset: 0;
    z-index: -1;
    overflow: hidden;
    pointer-events: none;
    background-color: #efe8da;
  }

  /* Fractal noise grain */
  #linen-bow-bg::before {
    content: "";
    position: absolute;
    inset: -10%;
    background-image: url({{themeAsset('noise.svg')}});
    background-size: 180px 180px;
    mix-blend-mode: multiply;
    opacity: 0.35;
  }

  /* Woven crosshatch */
  #linen-bow-bg::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
      repeating-linear-gradient(90deg,
        rgba(0,0,0,0.05) 0px, transparent 1px,
        transparent 2px, rgba(0,0,0,0.05) 3px),
      repeating-linear-gradient(0deg,
        rgba(0,0,0,0.05) 0px, transparent 1px,
        transparent 2px, rgba(0,0,0,0.05) 3px),
      radial-gradient(ellipse at 30% 20%, rgba(255,255,255,0.25) 0%, transparent 60%);
    background-size: 4px 4px, 4px 4px, cover;
    mix-blend-mode: multiply;
  }

  .coquette-bow {
    position: absolute;
    background-image: url({{themeAsset('Bows.svg')}});
    background-repeat: no-repeat;
    filter: drop-shadow(0 1px 1px rgba(0,0,0,0.08));
  }
</style>

<div id="linen-bow-bg"></div>

<script>
(function () {
  var BOW_COUNT = 22;
  var MIN_SIZE = 55, MAX_SIZE = 110;
  var MIN_OPACITY = 0.35, MAX_OPACITY = 0.65;
  var COLS = 3, ROWS = 4;
  var CELL_ASPECT = COLS / ROWS; // sheet is square, so cell height/width = COLS/ROWS

  var layer = document.getElementById('linen-bow-bg');
  if (!layer) return;

  for (var i = 0; i < BOW_COUNT; i++) {
    var col = Math.floor(Math.random() * COLS);
    var row = Math.floor(Math.random() * ROWS);

    var el = document.createElement('div');
    el.className = 'coquette-bow';

    var size = MIN_SIZE + Math.random() * (MAX_SIZE - MIN_SIZE);
    var opacity = MIN_OPACITY + Math.random() * (MAX_OPACITY - MIN_OPACITY);

    el.style.width = size + 'px';
    el.style.height = (size * CELL_ASPECT) + 'px';
    el.style.backgroundSize = (COLS * 100) + '% ' + (ROWS * 100) + '%';
    el.style.backgroundPosition =
      (col / (COLS - 1) * 100) + '% ' + (row / (ROWS - 1) * 100) + '%';
    el.style.top = (Math.random() * 100) + '%';
    el.style.left = (Math.random() * 100) + '%';
    el.style.transform = 'rotate(' + (Math.random() * 360) + 'deg)';
    el.style.opacity = opacity;

    layer.appendChild(el);
  }
})();
</script>
