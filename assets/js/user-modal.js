    // JavaScript to handle modal functionality
    const modal = document.getElementById("userModal");
    const addReviewButton = document.getElementById("editUser");
    const closeModal = document.getElementById("closeModal");

    addReviewButton.onclick = function () {
        modal.style.display = "block";
    };

    closeModal.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
    