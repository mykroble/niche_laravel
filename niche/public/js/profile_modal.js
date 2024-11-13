document.addEventListener('DOMContentLoaded', function() {

function openModal(x){
    switch(x){
        case 1:
            modal = document.getElementById('modal_basic_info');
            modalStyle = window.getComputedStyle(modal);
            // alert(modalStyle.display);
        if(modalStyle.display === "none"){
            modal.style.display = "flex";
        } else {
            modal.style.display = "none";
        }
        break;
    }
}

function cancelModal(x, event){

    switch(x){
        case 1:
            modal = document.getElementById('modal_basic_info');
            form = document.getElementById('modal_basic_info_form');
            form.reset();
            modal.style.display = "none";
            break;
    }
    
    event.preventDefault();
}

window.openModal = openModal;
window.cancelModal = cancelModal;
});