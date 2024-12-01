const editor = document.getElementById('editor');
// const imageInput = document.getElementById('imageInput');
const addImageBtn = document.getElementById('addImageBtn');
const blogForm = document.getElementById('blogForm');
var index = 0;
const preview = document.getElementById("preview");

addImageBtn.addEventListener('click', () => {
    const newInput = document.createElement('input');
    newInput.type='file';
    newInput.accept='image/*';
    newInput.style.display='none';
    
    newInput.addEventListener("change", (event)=>{
        var file = event.target.files[0];
        if (file) {
            newInput.name=`image_${index}`;
            // newInput.id=`image_${index}`;   //use this id, add event listener to delete input field when user deletes image from the content.

            const blobUrl = URL.createObjectURL(file);

            const wrapperDiv = document.createElement('div');
            editor.appendChild(wrapperDiv);

            const image = document.createElement('img');
            image.className='uploaded-image';
            image.dataset.image= `${index}`;
            image.src = blobUrl;
            wrapperDiv.appendChild(image);

            const newLine = document.createElement('div');
            const br = document.createElement('br');
            newLine.appendChild(br);
            editor.appendChild(newLine);

            editor.focus();
            const range = document.createRange();
            const selection = window.getSelection();
            range.setStartAfter(newLine);
            range.setEndAfter(newLine);
            selection.removeAllRanges();
            selection.addRange(range);

            blogForm.appendChild(newInput);
            alert("Dynamic image form added properly with the index: " + index);
            index++;
        } else {
            alert("ERROR:file_not_selected. New input form was not created.");
            // newInput.remove();
        }
    }, {once:true});
    
    newInput.click();
});

function showCurr(){
    alert(editor.innerHTML);
}

function submitForm(){

}

function constructForm(){

}

const previewModal = document.getElementById('previewModal');
const previewModalElement = new bootstrap.Modal(previewModal);
// function showPreview(){
//     previewModalElement.show();
//     previewModalElement.hide();
//     previewModalElement.toggle();
// }

previewModal.addEventListener('show.bs.modal', function () {
    console.log('Modal is about to be shown');
});

previewModal.addEventListener('shown.bs.modal', function () {
    console.log('Modal is fully shown');
});

previewModal.addEventListener('hide.bs.modal', function () {
    console.log('Modal is about to be hidden');
});

previewModal.addEventListener('hidden.bs.modal', function () {
    console.log('Modal is fully hidden');
});