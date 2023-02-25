class Header extends HTMLElement {
    connectedCallback() {
        this.innerHTML = 
        `<header>
        <h1>Profil Saya</h1>
        <nav>
          <a href="./home.html">Home</a>
          <a href="./pendidikan.html">Pendidikan</a>
          <a href="./jadwal-kuliah.html">Jadwal Kuliah</a>
          <a href="./aktivitas.html">Aktivitas</a>
          <a href="./prestasi.html">Prestasi</a>
          <a href="./hobi.html">Hobi</a>
        </nav>
      </header>`
    }
}

customElements.define('header-component', Header);