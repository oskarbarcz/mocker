import { exist } from './exist';

class ThemeSwitcher {

  constructor (props) {
    this.props = props;
  }

  init () {
    this.setCurrent();

    // set all event listeners
    this.props.buttons.forEach(button => {
      button.addEventListener('click', event => {
        this.selected = button;
        this.rerenderActive();
        this.switch(button.getAttribute(this.props.themeProperty));
      });
    });
  }

  setCurrent () {
    this.selected = this.props.buttons.find(element => {
      return element.classList.contains(this.props.activeClass);
    });

    // when no option is chose, set first
    if (exist(this.selected)) {
      this.selected = this.props.buttons[0];
      this.rerenderActive();
    }
  }

  rerenderActive () {
    this.props.buttons.forEach(button => {
      button.classList.remove(this.props.activeClass);
      button.disabled = false;
    });

    this.selected.classList.add(this.props.activeClass);
    this.selected.disabled = true;
  }

  switch (variant) {
    console.log('Switch color theme to', variant);
  }
}

export default ThemeSwitcher;