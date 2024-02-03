
document.addEventListener('DOMContentLoaded', (event) => {

    document.getElementById('Nutripolls_partners').onclick = function() {
        var partner = document.querySelector('.partner');
        partner.style.visibility = 'visible';
        partner.classList.add('show');
    };
    
    document.getElementById('closeButton').onclick = function() {
        var partner = document.querySelector('.partner');
        partner.classList.remove('show');
        setTimeout(() => {
        partner.style.visibility = 'hidden';
        }, 500); // 確保這個數值與你的 CSS 中的 transition 時間相匹配
    };
})