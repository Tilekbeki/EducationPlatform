const checkBtn = document.querySelectorAll('.questions__controllers-check'),
      closeBtn = document.querySelectorAll('.questions__modal-close');


closeBtn.forEach(close => {
    close.addEventListener('click', ()=>{
        close.parentElement.parentElement.parentElement.style.display='none';
    });
});      
checkBtn.forEach(btn => {
    btn.addEventListener('click', ()=>{
        btn.nextElementSibling.style.display = 'flex';
    })
});