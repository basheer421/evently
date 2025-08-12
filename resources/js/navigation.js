document.addEventListener("DOMContentLoaded", function () {
    const menuButton = document.getElementById("menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    const menuIcon = document.getElementById("menu-icon");

    if (menuButton && mobileMenu) {
        menuButton.addEventListener("click", function () {
            const isExpanded =
                menuButton.getAttribute("aria-expanded") === "true";
            menuButton.setAttribute("aria-expanded", !isExpanded);

            // Toggle menu visibility with animation
            if (!isExpanded) {
                mobileMenu.classList.remove("hidden");
                // Give browser time to register the element for animation
                requestAnimationFrame(() => {
                    mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
                });
                // Rotate menu icon
                menuIcon.style.transform = "rotate(90deg)";
            } else {
                mobileMenu.style.maxHeight = "0";
                menuIcon.style.transform = "rotate(0deg)";
                // Wait for animation to finish before hiding
                setTimeout(() => {
                    if (menuButton.getAttribute("aria-expanded") === "false") {
                        mobileMenu.classList.add("hidden");
                    }
                }, 300);
            }
        });
    }
});
