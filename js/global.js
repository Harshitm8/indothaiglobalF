/* ── Google Translate (Auto Language Switcher) ── */
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    autoDisplay: false,
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}

(function () {
  // Inject the hidden Google Translate container
  var div = document.createElement('div');
  div.id = 'google_translate_element';
  div.style.display = 'none';
  document.body.appendChild(div);

  // Load Google Translate script
  var s = document.createElement('script');
  s.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
  s.async = true;
  document.head.appendChild(s);

  // Wire up your existing langBtn to trigger translation
  document.addEventListener('DOMContentLoaded', function () {
    var langOptions = document.getElementById('langOptionsScroll');
    if (!langOptions) return;

    langOptions.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-lang-code]');
      if (!btn) return;
      var code = btn.getAttribute('data-lang-code');
      // Trigger Google Translate cookie
      var select = document.querySelector('.goog-te-combo');
      if (select) {
        select.value = code;
        select.dispatchEvent(new Event('change'));
      }
    });
  });
})();

