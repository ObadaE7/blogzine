function initSwiper() {
    const swiperEl = document.querySelector("swiper-container");
    Object.assign(swiperEl, {
        slidesPerView: 4,
        spaceBetween: 30,
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 5,
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 25,
            },
        },
        injectStyles: [
            `
            .swiper-button-next,
            .swiper-button-prev {
              width: 26px;
              height: 26px;
              padding: 10px;
              border-radius: 50%;
              color: var(--bs-white);
              background:-webkit-backdrop-filter: blur(5px);
              backdrop-filter: blur(5px);
              background: rgba(0, 0, 0, 0.4) !important;
            }
        `,
        ],
    });
    swiperEl.initialize();
}

function togglePassword() {
    document.addEventListener("DOMContentLoaded", () => {
        const icons = document.querySelectorAll(".icon-password");
        icons.forEach((icon) => {
            icon.addEventListener("click", () => {
                const passwordInput = icon
                    .closest("div")
                    .querySelector(
                        'input[type="password"], input[type="text"]'
                    );

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.style.setProperty("--icon-content", '"\\F33E"');
                } else {
                    passwordInput.type = "password";
                    icon.style.setProperty("--icon-content", '"\\F33F"');
                }
            });
        });
    });
}


function toggleSidebar() {
    const dashboardWrapper = document.querySelector(".dashboard__wrapper");
    const isCollapsed = dashboardWrapper.classList.toggle("collapsed");
    localStorage.setItem("sidebarCollapsed", isCollapsed);
}

document.addEventListener("DOMContentLoaded", function () {
    const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
    const dashboardWrapper = document.querySelector(".dashboard__wrapper");
    if (isCollapsed) {
        dashboardWrapper.classList.add("collapsed");
    }
});
