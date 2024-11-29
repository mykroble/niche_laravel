// DOM Elements
const editor = document.querySelector('.editor');
const imageInput = document.getElementById('imageInput');
const addImageBtn = document.getElementById('addImageBtn');

addImageBtn.addEventListener('click', () => imageInput.click());

// Handle Image Upload
imageInput.addEventListener('change', (event) => {
    editor.focus();
    const selection = window.getSelection();
    const range = selection.getRangeAt(0);
    range.selectNodeContents(editor);  // Select all the contents in the editor
    range.collapse(false);  // Collapse the range to the end (where the caret should be)

    const file = event.target.files[0];
    // const file = null;
    if (file) {
        // Generate a unique identifier for the image
        const uniqueId = `image_${Date.now()}`;
        // Append the identifier as a placeholder to the editor
        const placeholder = document.createTextNode(`{${uniqueId}}`);
        if (selection.rangeCount > 0) {
            alert(range + "," + range.startContainer + "," + range.endContainer);
            if(editor.contains(range.startContainer) || editor.contains(range.endContainer)){
                alert(range);
                range.deleteContents(); // Remove any selected text
                range.insertNode(placeholder);
            }
        }
        imageInput.value='';
    } else {
        alert("File not selected");
    }
});