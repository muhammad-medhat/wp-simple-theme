document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const languageSwitcher = document.querySelector("#language-switcher");

  const categoryLinks = document.querySelectorAll(".category-link");

  /*
   * -----------------------------------------------
   * Language
   * -----------------------------------------------
   */

  const savedLanguage = localStorage.getItem("rm_menu_language") || "ar";

  function setLanguage(language) {
    if (language !== "ar" && language !== "en") {
      language = "ar";
    }

    body.dataset.menuLanguage = language;

    document.documentElement.lang = language;

    document.documentElement.dir = language === "ar" ? "rtl" : "ltr";

    localStorage.setItem("rm_menu_language", language);

    /*
     * Mark selected language
     */

    document
      .querySelectorAll(".language-switcher__option")
      .forEach((option) => {
        option.classList.toggle("active", option.dataset.language === language);
      });
  }

  setLanguage(savedLanguage);

  if (languageSwitcher) {
    languageSwitcher.addEventListener("click", () => {
      const currentLanguage = body.dataset.menuLanguage || "ar";

      const newLanguage = currentLanguage === "ar" ? "en" : "ar";

      setLanguage(newLanguage);
    });
  }

  /*
   * -----------------------------------------------
   * Category navigation
   * -----------------------------------------------
   */

  categoryLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();

      const targetId = link.dataset.categoryTarget;

      const target = document.getElementById(targetId);

      if (!target) {
        return;
      }

      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });

      categoryLinks.forEach((item) => {
        item.classList.remove("active");
      });

      link.classList.add("active");
    });
  });

  /*
   * -----------------------------------------------
   * Active category while scrolling
   * -----------------------------------------------
   */

  const categories = document.querySelectorAll(".menu-category");

  if (categories.length && categoryLinks.length) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          const categoryId = entry.target.id;

          categoryLinks.forEach((link) => {
            link.classList.toggle(
              "active",
              link.dataset.categoryTarget === categoryId,
            );
          });
        });
      },
      {
        root: null,

        /*
         * Account for the sticky
         * header + category bar.
         */
        rootMargin: "-140px 0px -60% 0px",

        threshold: 0,
      },
    );

    categories.forEach((category) => {
      observer.observe(category);
    });
  }
});
