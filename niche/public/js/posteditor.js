const editor = document.getElementById('editor');
const blogForm = document.getElementById('blogForm');
var index = 0;

// addImageBtn.addEventListener('click', () => {
//     const newInput = document.createElement('input');
//     newInput.type = 'file';
//     newInput.accept = 'image/*';
//     newInput.style.display = 'none';

//     newInput.addEventListener("change", (event) => {
//         var file = event.target.files[0];
//         if (file) {
//             newInput.name = `image_${index}`;
//             // newInput.id=`image_${index}`;   //use this id, add event listener to delete input field when user deletes image from the content.

//             const blobUrl = URL.createObjectURL(file);

//             const wrapperDiv = document.createElement('div');
//             editor.appendChild(wrapperDiv);

//             const image = document.createElement('img');
//             image.className = 'uploaded-image';
//             image.dataset.image = `${index}`;
//             image.src = blobUrl;
//             wrapperDiv.appendChild(image);

//             const newLine = document.createElement('div');
//             const br = document.createElement('br');
//             newLine.appendChild(br);
//             editor.appendChild(newLine);

//             editor.focus();
//             const range = document.createRange();
//             const selection = window.getSelection();
//             range.setStartAfter(newLine);
//             range.setEndAfter(newLine);
//             selection.removeAllRanges();
//             selection.addRange(range);

//             blogForm.appendChild(newInput);
//             alert("Dynamic image form added properly with the index: " + index);
//             index++;
//         } else {
//             alert("ERROR:file_not_selected. New input form was not created.");
//             // newInput.remove();
//         }
//     }, { once: true });

//     newInput.click();
// });

function createTextSection(event){
    const wrapperAddSection = event.target.closest('.wrapper-add-section');

    const section = document.createElement('div');
    section.classList.add('section');
    
    const textSection = document.createElement('div');
    textSection.classList.add('text-section');
    textSection.contentEditable='true';
    textSection.innerHTML='Text Here';
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
    // alert("pressed");
}

function createMarkedSection(event){
    const wrapperAddSection = event.target.closest('.wrapper-add-section');

    const section = document.createElement('div');
    section.classList.add('section');
    
    const markedSection = document.createElement('div');
    markedSection.classList.add('marked-section');
    markedSection.contentEditable='plaintext-only';
    markedSection.innerHTML='Markdown here';
    section.appendChild(markedSection);

    const newWrapper = wrapperAddSection.cloneNode(true);
    wrapperAddSection.parentElement.insertBefore(newWrapper, wrapperAddSection.nextElementSibling);
    wrapperAddSection.parentElement.insertBefore(section, wrapperAddSection.nextElementSibling);
}

function createImageSection(event){
    const wrapperAddSection = event.target.closest('.wrapper-add-section');
    
    const section = document.createElement('div');
    section.classList.add('section');
    
    const imgSection = document.createElement('div');
    imgSection.classList.add('image-section');
    section.appendChild(imgSection);
    // const imgContainer1 = document.createElement('div');
    // imgContainer1.classList.add('image-container');
    // imgContainer1.dataset.imageId = `${index++}`;
    // imgSection.appendChild(imgContainer1);
    // const plusSign1 = document.createElement('img');
    // plusSign1.classList.add('image-container-plus');
    // plusSign1.src = plusSignURL;
    // imgContainer1.appendChild(plusSign1);
    addImageContainer(imgSection);
    // const imgContainer2 = document.createElement('div');
    // imgContainer2.classList.add('image-container');
    // imgContainer2.dataset.imageId = `${index++}`;
    // imgSection.appendChild(imgContainer2);
    // const plusSign2 = document.createElement('img');
    // plusSign2.classList.add('image-container-plus');
    // plusSign2.src = plusSignURL;
    // imgContainer2.appendChild(plusSign2);
    addImageContainer(imgSection);
    const newWrapper = wrapperAddSection.cloneNode(true);

    // const imageInput1 = document.createElement('input');
    // imageInput1.type = 'file';
    // imageInput1.accept = 'image/*';
    // imageInput1.id = `imageInput_${imgContainer1.dataset.imageId}`;
    // imageInput1.name = `image_${imgContainer1.dataset.imageId}`;
    // imageInput1.style.display = 'none';
    // blogForm.appendChild(imageInput1);

    // const imageInput2 = document.createElement('input');
    // imageInput2.type = 'file';
    // imageInput2.accept = 'image/*';
    // imageInput2.id = `imageInput_${imgContainer2.dataset.imageId}`;
    // imageInput2.name = `image_${imgContainer2.dataset.imageId}`;
    // imageInput2.style.display = 'none';
    // blogForm.appendChild(imageInput2);

    // imageInput1.addEventListener('change', (event) =>{
    //     var file = event.target.files[0];
    //     if (file) {
    //         newInput.name = `image_${index}`;
    //         // newInput.id=`image_${index}`;   //use this id, add event listener to delete input field when user deletes image from the content.

    //         const blobUrl = URL.createObjectURL(file);
    //     } else {
    //         console.log("ERROR: NO FILE SELECTED");
    //     }
    // });
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
    // alert("pressed");
}

function addImageContainer(imgSection){
    const imgContainer = document.createElement('div');
    imgContainer.classList.add('image-container');
    imgContainer.dataset.imageId = `${index++}`;
    imgSection.appendChild(imgContainer);
    const plusSign = document.createElement('img');
    plusSign.classList.add('image-container-plus');
    plusSign.src = plusSignURL;
    imgContainer.appendChild(plusSign);

    const imageInput = document.createElement('input');
    imageInput.type = 'file';
    imageInput.accept = 'image/*';
    imageInput.id = `imageInput_${imgContainer.dataset.imageId}`;
    imageInput.name = `image_${imgContainer.dataset.imageId}`;
    imageInput.style.display = 'none';
    blogForm.appendChild(imageInput);

    imageInput.addEventListener('change', (event) =>{
        var file = event.target.files[0];
        if (file) {
            const blobUrl = URL.createObjectURL(file);
            imgContainer.classList.add('image-container-uploaded');
            imgContainer.classList.remove('image-container');
            plusSign.remove();
            const uploadedImg = document.createElement('img');
            uploadedImg.classList.add('uploaded-image');
            uploadedImg.src = blobUrl;
            imgContainer.appendChild(uploadedImg);
        } else {
            console.log("ERROR: NO FILE SELECTED");
        }
    });
}

editor.addEventListener('click', function(event) {
    if (event.target.matches('.image-container')) {
        const imageId = event.target.dataset.imageId;
        
        let existingInput = document.getElementById(`imageInput_${imageId}`);
        
        if (existingInput) {
            existingInput.click();
        } else {
            console.log("ERROR: NO SUCH INPUT FOUND" + `imageInput_${imageId}`);
        }
    }
});

const previewModal = document.getElementById('previewModal');
const titleInput = document.getElementById('titleInput');
const preview = document.getElementById('preview');

previewModal.addEventListener('show.bs.modal', function () {    //constructs modal before opening
    if (titleInput.value === "") {
        const today = new Date();
        titleInput.value = "My blog " + today.toISOString().split('T')[0];
    }
    preview.innerHTML = '';
    const sections = editor.querySelectorAll('.section');
    sections.forEach(section => {
        let append = false;
        const clonedSection = section.cloneNode(true);
        const clonedTextSection = clonedSection.querySelector('.text-section');
        if(clonedTextSection){
            append=true;
            clonedTextSection.removeAttribute('contentEditable');
            clonedTextSection.innerHTML = DOMPurify.sanitize(clonedTextSection.innerHTML);
        } else {
            const clonedMarkedSection = clonedSection.querySelector('.marked-section');
            if(clonedMarkedSection){
                append=true;
                clonedMarkedSection.removeAttribute('contentEditable');
                clonedMarkedSection.innerHTML = DOMPurify.sanitize(marked.marked(clonedMarkedSection.innerHTML));
            } else {
                const clonedImgSection = clonedSection.querySelector('.image-section');
                const clonedUploadedImg = clonedImgSection.querySelectorAll('.image-container-uploaded');
                if(clonedUploadedImg.length !== 0){
                    append = true;
                    const clonedImgContainer = clonedImgSection.querySelectorAll('.image-container');
                    clonedImgContainer.forEach(imgContainer =>{
                        imgContainer.classList.add('image-container-empty');
                        imgContainer.classList.remove('image-container');
                        imgContainer.innerHTML = '';
                        alert('debug');
                    })
                }
            }
        }
        if(append){
            preview.appendChild(clonedSection);
        }
    });
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
    const contentInput = document.getElementById('content');
    contentInput.value = DOMPurify.sanitize(preview.innerHTML);
    
    const images = preview.querySelectorAll('img');
    images.forEach(image => {
        image.removeAttribute('src');
    });
    const titleInput = document.getElementById('titleInput');
    const title = document.getElementById('title');
    title.value = titleInput.value;
    alert(contentInput.value);
    blogForm.submit();
}

function showCurr() {
    alert(preview.innerHTML);
}