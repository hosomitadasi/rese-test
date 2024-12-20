const target = document.getElementById("hamburger");
target.addEventListener('click', () => {
  target.classList.toggle('active');
  const menu = document.getElementById("menu");
  menu.classList.toggle('active');
});

function toggleChangeForm(event, id) {
        event.preventDefault();
        const form = document.getElementById(`change-form-${id}`);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }