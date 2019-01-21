import { removeElement } from './Helpers';

export default new class Loading {
    constructor() {
        this.id = 'nada-loading';

        this.status = null;
    }

    start() {
        this.render();
    }

    done() {
        this.remove();
    }

    render() {
        if (this.isRendered()) return;

        let circleContainer = document.createElement('div');
        circleContainer.id = this.id;
        circleContainer.innerText = 'Loading';
        document.body.appendChild(circleContainer);
    }

    isRendered() {
        return !!document.getElementById(this.id);
    }

    remove() {
       removeElement(document.getElementById(this.id));
    }
}