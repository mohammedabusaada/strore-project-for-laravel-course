    document.addEventListener("DOMContentLoaded", function () {
        const themeToggleButtons = document.querySelectorAll("[data-bs-theme-value]");
        const currentTheme = localStorage.getItem("theme") || "auto";

        function applyTheme(theme) {
            document.documentElement.setAttribute("data-bs-theme", theme);
            localStorage.setItem("theme", theme);

            themeToggleButtons.forEach(btn => {
                btn.classList.remove("active");
                btn.setAttribute("aria-pressed", "false");
                if (btn.getAttribute("data-bs-theme-value") === theme) {
                    btn.classList.add("active");
                    btn.setAttribute("aria-pressed", "true");
                }
            });
        }

        applyTheme(currentTheme);

        themeToggleButtons.forEach(btn => {
            btn.addEventListener("click", function () {
                const selectedTheme = this.getAttribute("data-bs-theme-value");
                applyTheme(selectedTheme);
            });
        });
    });