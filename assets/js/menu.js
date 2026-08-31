document.addEventListener("DOMContentLoaded", () => {
  const languageSwitcher = document.getElementById("language-switcher");

  if (!languageSwitcher) {
    return;
  }

  /*
   * Get saved language.
   *
   * Default:
   * Arabic if the WordPress site is RTL.
   * English otherwise.
   */
  const savedLanguage = localStorage.getItem("restaurant_menu_language");

  const defaultLanguage =
    savedLanguage || (document.documentElement.dir === "rtl" ? "ar" : "en");

  /**
   * Set active language
   */
  function setLanguage(language, save = true) {
    const html = document.documentElement;

    const isArabic = language === "ar";

    /*
     * Update document direction
     */
    html.setAttribute("dir", isArabic ? "rtl" : "ltr");

    /*
     * Update document language
     */
    html.setAttribute("lang", isArabic ? "ar" : "en");

    /*
     * Store user's preference
     */
    if (save) {
      localStorage.setItem("restaurant_menu_language", language);
    }

    /*
     * Tell the rest of the frontend
     * which language is currently active.
     */
    document.body.setAttribute("data-menu-language", language);

    /*
     * Update switcher accessibility
     */
    languageSwitcher.setAttribute(
      "aria-label",
      isArabic ? "Switch to English" : "التبديل إلى العربية",
    );
  }

  /*
   * Clicking the switch toggles
   * between Arabic and English.
   */
  languageSwitcher.addEventListener("click", () => {
    const currentLanguage = document.documentElement.lang;

    const newLanguage = currentLanguage === "ar" ? "en" : "ar";

    setLanguage(newLanguage);
  });

  /*
   * Initialize language.
   */
  setLanguage(defaultLanguage, false);

  /*
   * --------------------------------------------------
   * Category Navigation
   * --------------------------------------------------
   */

  const categoryLinks = document.querySelectorAll(".category-link");

  const categories = document.querySelectorAll(".menu-category");

  /*
   * Click category
   */
  categoryLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();

      const categoryId = link.getAttribute("href");

      const category = document.querySelector(categoryId);

      if (!category) {
        return;
      }

      /*
       * Update active category
       */
      categoryLinks.forEach((item) => {
        item.classList.remove("active");
      });

      link.classList.add("active");

      /*
       * Scroll to category.
       *
       * CSS scroll-margin-top handles
       * the sticky header + navigation.
       */
      category.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });

      /*
       * Keep clicked tab visible
       */
      link.scrollIntoView({
        behavior: "smooth",
        block: "nearest",
        inline: "center",
      });
    });
  });

  /*
   * Update active category while scrolling.
   */
  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          const categoryId = entry.target.id;

          categoryLinks.forEach((link) => {
            const isActive = link.getAttribute("href") === `#${categoryId}`;

            link.classList.toggle("active", isActive);

            /*
             * Automatically move the
             * active tab into view.
             */
            if (isActive) {
              link.scrollIntoView({
                behavior: "smooth",
                block: "nearest",
                inline: "center",
              });
            }
          });
        });
      },
      {
        rootMargin: "-140px 0px -55% 0px",
        threshold: 0,
      },
    );

    categories.forEach((category) => {
      observer.observe(category);
    });
  }
});
