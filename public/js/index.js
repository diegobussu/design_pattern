document.addEventListener('DOMContentLoaded', function() { 

    // Gestion de la fênetre de création d'un produit
    const modal = document.getElementById("createModal");
    const createProduct = document.getElementById("createProduct");
    const closeModal = document.getElementById("closeModal");

    let isDragging = false;
    let offset = { x: 0, y: 0 };

    createProduct.addEventListener("click", () => {
        modal.style.display = "block"; 
    });
    
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

    // Gestion de la fênetre de création d'un produit incompatible
    const modal1 = document.getElementById("createOtherModal");
    const createProduct1 = document.getElementById("createOtherProduct");
    const closeModal1 = document.getElementById("closeOtherModal");
    
    createProduct1.addEventListener("click", () => {
        modal1.style.display = "block"; 
    });
    
    modal1.addEventListener("mousedown", (e) => {
        isDragging = true;
        offset.x = e.clientX - modal1.getBoundingClientRect().left;
        offset.y = e.clientY - modal1.getBoundingClientRect().top;
        modal1.style.cursor = "grabbing";
    });
    
    document.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        modal1.style.left = e.clientX - offset.x + "px";
        modal1.style.top = e.clientY - offset.y + "px";
    });
    
    document.addEventListener("mouseup", () => {
        isDragging = false;
        modal1.style.cursor = "grab";
    });

    document.addEventListener("mouseleave", () => {
        if (isDragging) {
            isDragging = false;
            modal1.style.cursor = "grab";
        }
    });
    
    window.addEventListener('click', function (event) {
        if (event.target === modal1) {
            modal1.style.display = "none"; 
        }
    });

    closeModal1.addEventListener("click", () => {
        modal1.style.display = "none"; 
    });

    // Fermeture des alertes flash après 2 secondes
    setTimeout(function() {
        document.querySelectorAll(".alert").forEach(function(alert) {
            alert.style.display = "none";
        });
    }, 2000);
});