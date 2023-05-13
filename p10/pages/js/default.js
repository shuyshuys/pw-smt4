class Footer extends HTMLElement {
    connectedCallback() {
        this.innerHTML =
            `
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css" />            
            <div class="container mt-3">
            <div class="row">
                <div class="col-md-11 text-center">
                    <p>&copy;2023 All Rights Reserved by <a href="https://www.github.com/shuyshuys/" target="_blank">Ahmad Yazid Isnandar</a></p>
                </div>
                <div class="col-md-1 text-right">
                    <a href="https://github.com/shuyshuys"><i class="fa-brands fa-square-github"></i></a>
                    <a href="https://id.linkedin.com/in/ahmyaz-id"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="https://instagram.com/shuyshuys"><i class="fa-brands fa-square-instagram"></i></a>
                </div>
            </div>
            </div>`
    }
}

customElements.define('reserved-by', Footer);