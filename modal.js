
const confirmationModal = document.querySelector(".confirmationModal");
const span = document.querySelector(".close");
const btn = document.querySelector(".openModal");

span.onclick = function() {
    confirmationModal.style.display = "none";
  }

function openModal() {
    confirmationModal.style.display = "block";
}

function closeModal() {
    confirmationModal.style.display = "none";
}