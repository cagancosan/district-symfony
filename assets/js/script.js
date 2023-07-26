window.onload = (event) => {
    let themeSwitcher = document.querySelector("#darkmode-toggle");
    themeSwitcher.addEventListener('click', function () {
        if (themeSwitcher.checked) {
            theme = "dark";
        }
        else {
            theme = "light";
        }
        document.body.classList.toggle("dark", themeSwitcher.checked);
        document.cookie = "theme=" + theme + ";Path=/";
    })
}