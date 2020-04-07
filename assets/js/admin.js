import hljs from 'highlight.js/lib/highlight';
import json from 'highlight.js/lib/languages/json';
import 'highlight.js/styles/atom-one-light.css';
import '../sass/domain/admin/index.sass';
import DialogBox from './module/DialogBox';
import { exist } from './module/exist';

// JSON syntax highlighting
const details = document.querySelector('.details');

if (exist(details)) {
  if (details.getAttribute('data-hasCode')) {
    // make JSON pretty with internal tools
    const code = document.querySelector('code.json');
    const parsed = JSON.parse(code.innerText);
    code.innerText = JSON.stringify(parsed, null, 2);

    // init highlighter
    hljs.registerLanguage('javascript', json);
    hljs.initHighlightingOnLoad();
  }
}

// Dialog box behavior
const dialogBox = document.querySelector('.dialog');

if (exist(dialogBox)) {
  const box = new DialogBox({
    dialogBox: dialogBox,
    activation: document.querySelector('.details__delete'),
    close: document.querySelector('.dialog__return'),
    proceed: document.querySelector('.dialog__proceed')
  });

  box.init();
}