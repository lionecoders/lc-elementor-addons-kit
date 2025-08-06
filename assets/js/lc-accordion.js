(function () {
    function initAccordion(scope) {
        const accordions = scope.querySelectorAll(".lc-accordion");

        accordions.forEach(function (accordion) {
            const multiple = accordion.dataset.multiple === "yes";
            let maxHeight = 0;

            accordion.querySelectorAll(".lc-accordion-content").forEach(function (content) {
                content.style.maxHeight = "none";
                const height = content.scrollHeight;
                if (height > maxHeight) {
                    maxHeight = height;
                }
                content.style.maxHeight = null;
            });

            accordion.querySelectorAll(".lc-accordion-header").forEach(function (header) {
                header.addEventListener("click", function () {
                    const item = header.closest(".lc-accordion-item");
                    const content = item.querySelector(".lc-accordion-content");
                    const isOpen = item.classList.contains("active");

                    if (!multiple) {
                        accordion.querySelectorAll(".lc-accordion-item").forEach(function (i) {
                            i.classList.remove("active");
                            const c = i.querySelector(".lc-accordion-content");
                            if (c) {
                                c.style.maxHeight = null;
                                c.style.paddingTop = "0";
                                c.style.paddingBottom = "0";
                            }
                        });
                    }

                    if (!isOpen) {
                        item.classList.add("active");
                        content.style.maxHeight = maxHeight + "px";
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

            accordion.querySelectorAll(".lc-accordion-item.active .lc-accordion-content").forEach(function (content) {
                content.style.maxHeight = maxHeight + "px";
                content.style.paddingTop = "15px";
                content.style.paddingBottom = "15px";
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        initAccordion(document);
    });

    window.addEventListener("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/lc-kit-accordion.default", function ($scope) {
            initAccordion($scope[0]);
        });
    });
})();