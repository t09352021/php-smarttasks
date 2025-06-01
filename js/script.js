document.addEventListener('DOMContentLoaded', () => {
    const pwShowHide = document.querySelectorAll(".eye-icon");

    pwShowHide.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", () => {
            const passwordField = eyeIcon.previousElementSibling;
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace("bx-show", "bx-hide");
            }
        });
    });
});