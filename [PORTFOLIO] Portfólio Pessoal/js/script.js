const Menu = '.menu';
const divMenu = document.querySelector(Menu);
const menuTrigger = document.querySelector('.menu-trigger');

menuTrigger.addEventListener('click', () => {
    setTimeout(() => {
        if (!divMenu.classList.contains('show')) {
            divMenu.classList.add('show');
            document.body.classList.add('menu-visible')
        }
    }, 0)
})

//auto close menu by clicking outside
document.addEventListener('click', (e) => {
    const isClosest = e.target.closest(Menu);
    if (!isClosest && divMenu.classList.contains('show')){
        divMenu.classList.remove('show');
        document.body.classList.remove('menu-visible');
    }
})

//darkmode
const switcherBtn = document.querySelector('#dmswitcher');
const themeMode = localStorage.getItem('theme');

if (themeMode) {
    document.documentElement.setAttribute('data-theme', themeMode);
    if (themeMode === 'dark') {
        switcherBtn.checked = true;
    }
}

function modeSwitch(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark')
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light')
    }
}

switcherBtn.addEventListener('change', modeSwitch, false)

//animation on scroll
const io = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.intersectionRatio > 0) {
            entry.target.classList.add('this')
        }
    })
})

const animation = document.querySelectorAll('.animate');
animation.forEach((el) => {
    io. observe(el);
}) 

