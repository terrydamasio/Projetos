const display = document.querySelector('#display');
const buttons = document.querySelectorAll('button');
let openParentheses = false;

buttons.forEach((item) => {
    item.onclick = () => {
        if(item.id == 'clear') {
            display.innerText = ''
        } else if (item.id == 'backspace') {
            let string = display.innerText.toString();
            display.innerText = string.substr(0, string.length - 1);
        } else if (item.id == 'equal') {
            let expression = display.innerText;
            if (expression.includes('0/0' && '0%0')) {
                display.innerText = 'Erro';
            } else {
                let result = eval(display.innerText);
                display.innerText = result % 1 === 0 ? result : result.toFixed(2);
            }
        } else if (display.innerText == '' && item.id == 'equal') {
            display.innerText = 'Vazio';
            setTimeout(() => (display.innerText = ''), 2000)
        } else if (item.id == 'parentheses') {
            if (openParentheses) {
                display.innerText += ')';
                openParentheses = false;
            } else {
                display.innerText += '(';
                openParentheses = true;
            }
        } else {
            display.innerText += item.id;
        }
    }
})

const themeToggleBtn = document.querySelector('.theme-toggler');
const calculator = document.querySelector('.calculator');
const toggleIcon = document.querySelector('.toggler-icon');
let isDark = true;
themeToggleBtn.onclick = () => {
    calculator.classList.toggle('dark');
    themeToggleBtn.classList.toggle('active');
    isDark = !isDark;   
}

