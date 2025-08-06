document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".lc-accordion").forEach(function (accordion) {
        const multiple = accordion.dataset.multiple === "yes";

        accordion.querySelectorAll(".lc-accordion-header").forEach(function (header) {
            header.addEventListener("click", function () {
                const item = header.closest(".lc-accordion-item");
                const content = item.querySelector(".lc-accordion-content");

                const isOpen = item.classList.contains("active");

                if (!multiple) {
                    accordion.querySelectorAll(".lc-accordion-item").forEach(function (i) {
                        i.classList.remove("active");
                        i.querySelector(".lc-accordion-content").style.maxHeight = null;
                        i.querySelector(".lc-accordion-content").style.paddingTop = "0";
                        i.querySelector(".lc-accordion-content").style.paddingBottom = "0";
                    });
                }

                if (!isOpen) {
                    item.classList.add("active");
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.style.paddingTop = "15px";
                    content.style.paddingBottom = "15px";
                } else {
                    item.classList.remove("active");
                    content.style.maxHeight = null;
                    content.style.paddingTop = "0";
                    content.style.paddingBottom = "0";
                }
            });
        });

        // Set max-height on initially active item
        accordion.querySelectorAll(".lc-accordion-item.active .lc-accordion-content").forEach(function (content) {
            content.style.maxHeight = content.scrollHeight + "px";
        });
    });
});
