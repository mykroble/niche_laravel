document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.btn');
  const underline = document.querySelector('.underline');

  // Make the first button active by default
  const firstButton = document.getElementById('btn1');
  firstButton.classList.add('active');



  underline.style.width = `${firstButton.offsetWidth}px`;
  underline.style.left = `${firstButton.offsetLeft}px`;


  buttons.forEach(button => {
    button.addEventListener('click', () => {

      buttons.forEach(btn => btn.classList.remove('active'));


      button.classList.add('active');


      underline.style.width = `${button.offsetWidth}px`;
      underline.style.left = `${button.offsetLeft}px`;
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
  }


  function openlikes() {
    document.getElementById('likes-content').classList.remove('hidden');
    document.getElementById('likes-content').classList.add('visible');
    document.getElementById('posts-content').classList.remove('visible');
    document.getElementById('posts-content').classList.add('hidden');
  }


  window.openposts = openposts;
  window.openlikes = openlikes;

  // Ensure posts content is shown by default
  openposts();
});
