
const buttons = document.querySelectorAll('.btn');
const underline = document.querySelector('.underline');

buttons.forEach(button => {
  button.addEventListener('click', () => {
    // Remove the 'active' class from all buttons
    buttons.forEach(btn => btn.classList.remove('active'));
    
    // Add the 'active' class to the clicked button
    button.classList.add('active');
    
    // Adjust the underline position
    const buttonWidth = button.offsetWidth;
    const buttonLeft = button.offsetLeft;

    underline.style.width = `${buttonWidth}px`;
    underline.style.left = `${buttonLeft}px`;
  });
});

// Set initial position of the underline based on the first button
window.addEventListener('load', () => {
  const firstButton = buttons[0];
  const buttonWidth = firstButton.offsetWidth;
  const buttonLeft = firstButton.offsetLeft;

  underline.style.width = `${buttonWidth}px`;
  underline.style.left = `${buttonLeft}px`;
});

function openposts() {
    document.getElementById('posts-content').classList.remove('hidden');
    document.getElementById('posts-content').classList.add('visible');
    document.getElementById('likes-content').classList.remove('visible');
    document.getElementById('likes-content').classList.add('hidden');

    moveUnderline('btn1');
}

function openlikes() {
    document.getElementById('likes-content').classList.remove('hidden');
    document.getElementById('likes-content').classList.add('visible');
    document.getElementById('posts-content').classList.remove('visible');
    document.getElementById('posts-content').classList.add('hidden');

    moveUnderline('btn2');
}
openposts();