function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'en',autoDisplay:false},'google_translate_element');
}


function googleTranslateElementInit(){
  new google.translate.TranslateElement({pageLanguage:'en',autoDisplay:false},'google_translate_element');
}


(function(){
  const wrap = document.getElementById('heroPollen');
  if (!wrap) return;
  for (let i = 0; i < 26; i++) {
    const d = document.createElement('div');
    d.className = 'pollen-dot';
    const size = 3 + Math.random() * 5;
    const left = Math.random() * 100;
    const delay = Math.random() * 10;
    const dur   = 5 + Math.random() * 9;
    const colors = ['rgba(255,230,100,0.55)','rgba(200,240,160,0.5)','rgba(160,220,255,0.48)','rgba(255,200,80,0.5)'];
    d.style.cssText = `width:${size}px; height:${size}px; left:${left}%; bottom:${8 + Math.random()*62}%; background:${colors[Math.floor(Math.random()*colors.length)]}; animation-duration:${dur}s; animation-delay:${delay}s;`;
    wrap.appendChild(d);
  }
})();