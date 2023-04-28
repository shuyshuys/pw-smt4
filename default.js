class Footer extends HTMLElement {
    connectedCallback() {
        this.innerHTML =
            `<div class="container">
            <div class="row">
                <div class="col text-center">
                    <p>2023 All Rights Reserved by <a href="https://www.github.com/shuyshuys/" target="_blank">Ahmad
                            Yazid Isnandar</a></p>
                </div>
            </div>
            </div>`
    }
}

customElements.define('footer-component', Footer);