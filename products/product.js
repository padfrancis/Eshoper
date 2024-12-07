var modal = document.getElementById("productModal");
var modalBtn = document.getElementById("addProductButton");
var closeBtn = document.getElementById("closeModal");
modalBtn.addEventListener("click", openModal);
closeBtn.addEventListener("click", closeModal);
window.addEventListener("click", outsideClick);

        function openModal() {
            modal.style.display = "block";
        }

        // Function to close modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Function to close modal if outside click
        function outsideClick(e) {
            if (e.target == modal) {
                modal.style.display = "none";
            }
        }

