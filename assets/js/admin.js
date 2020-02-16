import hljs from 'highlight.js/lib/highlight';
import json from 'highlight.js/lib/languages/json';
import 'highlight.js/styles/atom-one-dark.css';
import '../sass/domain/admin/index.sass';

hljs.registerLanguage('javascript', json);
hljs.initHighlightingOnLoad();