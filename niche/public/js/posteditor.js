const editor = document.getElementById('editor');
const addImageBtn = document.getElementById('addImageBtn');
const blogForm = document.getElementById('blogForm');
var index = 0;

addImageBtn.addEventListener('click', () => {
    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.accept = 'image/*';
    newInput.style.display = 'none';

    newInput.addEventListener("change", (event) => {
        var file = event.target.files[0];
        if (file) {
            newInput.name = `image_${index}`;
            // newInput.id=`image_${index}`;   //use this id, add event listener to delete input field when user deletes image from the content.

            const blobUrl = URL.createObjectURL(file);

            const wrapperDiv = document.createElement('div');
            editor.appendChild(wrapperDiv);

            const image = document.createElement('img');
            image.className = 'uploaded-image';
            image.dataset.image = `${index}`;
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
    }, { once: true });

    newInput.click();
});

const previewModal = document.getElementById('previewModal');
const titleInput = document.getElementById('title');
const preview = document.getElementById('preview');

previewModal.addEventListener('show.bs.modal', function () {    //constructs modal before opening
    if (titleInput.value === "") {
        const today = new Date();
        titleInput.value = "My blog " + today.toISOString().split('T')[0];
    }
    preview.innerHTML = editor.innerHTML;
});

const togglePreview = document.getElementById('togglePreview');
const modalSize = document.getElementById('modal-sizing');

togglePreview.addEventListener('click', function(){
    if(modalSize.classList.contains('laptopPreview')){
        modalSize.classList.remove('laptopPreview');
        modalSize.classList.add('mobilePreview');
    } else {
        modalSize.classList.add('laptopPreview');
    }
});

const content = document.getElementById('content');

function submitForm() {
    const appendTitleInput = document.createElement('input');
    appendTitleInput.value = titleInput.value;
    appendTitleInput.type='text';
    appendTitleInput.name='title';
    appendTitleInput.style.display='none';
    blogForm.appendChild(appendTitleInput);
    
    content.value = editor.innerHTML;
    
    //in the content.value, change the src value for every image, and somehow replace it with the filepath after storing.
    // alert(appendTitleInput.value);
    // blogForm.submit();
}

function createTextSection(event){
    const wrapperAddSection = event.target.closest('.wrapper-add-section');

    const section = document.createElement('div');
    section.classList.add('section');
    
    const textSection = document.createElement('div');
    textSection.classList.add('text-section');
    textSection.contentEditable='true';
    textSection.innerHTML='Lorem Ipsum...';
    section.appendChild(textSection);

    const newWrapper = wrapperAddSection.cloneNode(true);

    // const wrapper = document.createElement('div');
    // wrapper.classList.add('wrapper-add-section');
    // section.appendChild(wrapper);
    
    // const addSection = document.createElement('div');
    // addSection.classList.add('add-section');
    // wrapper.appendChild(addSection);
    
    // addSection.appendChild(document.createElement('hr'));
    
    // const textBtn = document.createElement('button');
    // textBtn.classList.add('btn', 'btn-light', 'rounded-circle', 'm-1');
    // addSection.appendChild(textBtn);
    // const textImg = document.createElement('img');
    // textImg.src=textBoxURL;
    // textBtn.appendChild(textImg);
    
    // const imgBtn = document.createElement('button');
    // imgBtn.classList.add('btn', 'btn-light', 'rounded-circle', 'm-1');
    // addSection.appendChild(imgBtn);
    // const imageImg = document.createElement('img');
    // imageImg.src=imageBoxURL;
    // imgBtn.appendChild(imageImg);
    
    // addSection.appendChild(document.createElement('hr'));
    
    
    // editor.appendChild(section);
    // clickedSection.parentElement.insertBefore(section, clickedSection.nextElementSibling);
    wrapperAddSection.parentElement.insertBefore(newWrapper, wrapperAddSection.nextElementSibling);
    wrapperAddSection.parentElement.insertBefore(section, wrapperAddSection.nextElementSibling);
    alert("pressed");
}

function createImageSection(x){

}

function showCurr() {
    alert(editor.innerHTML);
}