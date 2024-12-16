const modal = document.getElementById("reviewModal");
const addReviewButton = document.getElementById("addReviewButton");
const closeModal = document.getElementById("closeModal");

addReviewButton.onclick = function () 
{
    modal.style.display = "block";
};

closeModal.onclick = function () 
{
    modal.style.display = "none";
};

window.onclick = function (event) 
{
    if (event.target === modal) 
    {
        modal.style.display = "none";
    }
};