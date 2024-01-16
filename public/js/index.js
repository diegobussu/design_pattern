document.addEventListener('DOMContentLoaded', function() { 
    const modal = document.getElementById("createModal");
    const createProduct = document.getElementById("createProduct");
    const closeModal = document.getElementById("closeModal");

    createProduct.addEventListener("click", () => {
        modal.style.display = "block"; 
    });

    let isDragging = false;
    let offset = { x: 0, y: 0 };
    
    modal.addEventListener("mousedown", (e) => {
        isDragging = true;
        offset.x = e.clientX - modal.getBoundingClientRect().left;
        offset.y = e.clientY - modal.getBoundingClientRect().top;
        modal.style.cursor = "grabbing";
    });
    
    document.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        modal.style.left = e.clientX - offset.x + "px";
        modal.style.top = e.clientY - offset.y + "px";
    });
    
    document.addEventListener("mouseup", () => {
        isDragging = false;
        modal.style.cursor = "grab";
    });

    document.addEventListener("mouseleave", () => {
        if (isDragging) {
            isDragging = false;
            modal.style.cursor = "grab";
        }
    });
    
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = "none"; 
        }
    });

    closeModal.addEventListener("click", () => {
        modal.style.display = "none"; 
    });

    setTimeout(function() {
        document.querySelectorAll(".alert").forEach(function(alert) {
            alert.style.display = "none";
        });
    }, 2000);
});