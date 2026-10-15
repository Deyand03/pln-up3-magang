import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';

window.Chart = Chart;
window.Alpine = Alpine;

Alpine.start();

const $ = (e) => {
    return document.querySelector(e)
}

document.addEventListener('DOMContentLoaded', () => {
    const navbar = $('#navbar')

    window.addEventListener('scroll', () => {
        if(window.scrollY > 50){
            navbar.classList.add('shadow-lg')
        }else{
            navbar.classList.remove('shadow-lg')
        }
    })


})
