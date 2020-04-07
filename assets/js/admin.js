import ClipboardJS from 'clipboard/dist/clipboard.min';
import '../sass/domain/admin/index.sass';
import DialogBox from './module/DialogBox';
import { exist } from './module/exist';
import Highlighter from './module/Highlighter';

// JSON syntax highlighting
const details = document.querySelector('.details');

if (exist(details)) {
  new Highlighter();
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

// copy to clipboard
if (exist(details)) {
  new ClipboardJS('.details__copy-icon');
}