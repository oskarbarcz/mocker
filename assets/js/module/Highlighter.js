import hljs from 'highlight.js/lib/highlight';
import json from 'highlight.js/lib/languages/json';

class Highlighter {
  constructor (props) {
    this.props = props;
    this.init();
  }

  init () {
    // make JSON pretty with internal tools
    const code = document.querySelector('code.json');
    const parsed = JSON.parse(code.innerText);

    code.innerText = JSON.stringify(parsed, null, 2);

    // init highlighter
    hljs.registerLanguage('javascript', json);
    hljs.initHighlightingOnLoad();
  }
}

export default Highlighter;