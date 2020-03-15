import hljs from 'highlight.js/lib/highlight';
import json from 'highlight.js/lib/languages/json';
import 'highlight.js/styles/atom-one-light.css';
import '../sass/domain/admin/index.sass';

if (document.querySelector('.details').getAttribute('data-hasCode')) {
  // make JSON pretty with internal tools
  const code = document.querySelector('code.json');
  const parsed = JSON.parse(code.innerText);
  code.innerText = JSON.stringify(parsed, null, 2);

  // init highlighter
  hljs.registerLanguage('javascript', json);
  hljs.initHighlightingOnLoad();
}

