class DialogBox {
  constructor (props) {
    this.props = props;
  }

  init () {
    this.attachListeners();
  }

  attachListeners () {
    this.props.activation.addEventListener('click', () => {
      this.open();
    });

    this.props.close.addEventListener('click', () => {
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