document.addEventListener('DOMContentLoaded', function() { 
    const modal = document.getElementById("createModal");
    const createProduct = document.getElementById("createProduct");
    const closeModal = document.getElementById("closeModal");
    const validProduct = document.getElementById("validProduct");

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

    validProduct.addEventListener("click", (event) => {
        if (!validateForm()) {
            event.preventDefault();
        } else {
            modal.style.display = "none"; 
        }
    });

    closeModal.addEventListener("click", () => {
        modal.style.display = "none"; 
    });

    function validateForm() {
        var valid = true;

        const model = document.getElementById("model");
        if (model.value.trim() === '' || model.value.length === 0 || model.value.length > 30
        ) {
            alert("Veuillez écrire un nom entre 1 et 30 caractères.");
            valid = false;
        }

        const color = document.getElementById("color");
        if (color.value.trim() === '' || color.value.length === 0 || color.value.length > 30
        ) {
            alert("Veuillez écrire une couleur entre 1 et 30 caractères.");
            valid = false;
        }

        function isValidDateTime(dateTimeString) {
            // Format de date et heure local (ISO 8601)
            const dateTimeRegex = /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/;
        
            // Vérifier si la chaîne de date correspond au format
            return dateTimeRegex.test(dateTimeString);
        }

        const date = document.getElementById("release_year");
        if (!isValidDateTime(date.value)) {
            alert("Veuillez entrer une date valide.");
            valid = false;
        }

        return valid; 
    }

    document.getElementById("capacity").addEventListener("input", function () {
        const capacity = this.value;
        if (capacity < 0 || capacity > 1000) {
            alert("Veuillez entrer une valeur 0 et 1000.");
            this.value = "";
        }
    });
});