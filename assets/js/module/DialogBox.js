class DialogBox {
  constructor (props) {
    this.props = props;
  }

  init (windowData) {
    // attach correct remove link
    this.props.proceed.href = this.props.activation.getAttribute('data-href');
    this.attachListeners();
  }

  attachListeners () {
    this.props.activation.addEventListener('click', event => {
      this.open();
    });

    this.props.close.addEventListener('click', event => {
      this.close();
    });
  }

  open () {
    this.props.dialogBox.classList.remove('dialog--hidden');
    this.props.dialogBox.setAttribute('aria-hidden', 'false');
  }

  close () {
    this.props.dialogBox.classList.add('dialog--hidden');
    this.props.dialogBox.setAttribute('aria-hidden', 'true');

  }
}

export default DialogBox;