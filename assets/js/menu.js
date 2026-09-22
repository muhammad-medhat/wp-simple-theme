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
  /////////////////////////////////////////////////////////
  /*
   * --------------------------------------------------
   * Category Navigation
   * --------------------------------------------------
   */

  const categoryLinks = document.querySelectorAll(".category-link");

  // const categories = document.querySelectorAll(".menu-category");
  const categories = document.querySelectorAll('[id^="menu-category-"]');

  const CATEGORY_STORAGE_KEY = "restaurant_menu_category";

  /*
   * --------------------------------------------------
   * Set active category
   * --------------------------------------------------
   */
  function setActiveCategory(categoryId) {
    categoryLinks.forEach((link) => {
      const isActive = link.getAttribute("href") === `#${categoryId}`;

      link.classList.toggle("active", isActive);
    });
  }

  /*
   * --------------------------------------------------
   * Click category
   * --------------------------------------------------
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
       * Save selected category
       */
      localStorage.setItem(CATEGORY_STORAGE_KEY, categoryId);

      /*
       * Update active category
       */
      setActiveCategory(categoryId.substring(1));

      /*
       * Keep clicked tab visible
       */
      link.scrollIntoView({
        behavior: "smooth",
        block: "nearest",
        inline: "center",
      });

      /*
       * Scroll to category
       *
       * CSS scroll-margin-top handles
       * the sticky header + navigation.
       */
      category.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    });
  });

  /*
   * --------------------------------------------------
   * Restore last selected category
   * --------------------------------------------------
   */

  const savedCategory = localStorage.getItem(CATEGORY_STORAGE_KEY);

  if (savedCategory) {
    const savedLink = document.querySelector(
      `.category-link[href="${savedCategory}"]`,
    );

    const savedSection = document.querySelector(savedCategory);

    if (savedLink && savedSection) {
      /*
       * Activate saved category immediately
       */
      savedLink.classList.add("active");

      /*
       * Wait until the page has rendered before
       * scrolling to the saved category.
       */
      setTimeout(() => {
        savedSection.scrollIntoView({
          behavior: "auto",
          block: "start",
        });

        savedLink.scrollIntoView({
          behavior: "auto",
          block: "nearest",
          inline: "center",
        });
      }, 100);
    }
  }

  /////////////////////////////////////////////////////////

  /*
   * --------------------------------------------------
   * Update active category while scrolling
   * --------------------------------------------------
   */
  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          // console.log(entry);
          if (!entry.isIntersecting) {
            return;
          }
          const categoryId = entry.target.id;

          /*
           * Update active category
           */
          categoryLinks.forEach((link) => {
            const isActive = link.getAttribute("href") === `#${categoryId}`;

            link.classList.toggle("active", isActive);

            /*
             * Save the category that becomes active
             * while the user scrolls.
             */
            if (isActive) {
              localStorage.setItem(CATEGORY_STORAGE_KEY, `#${categoryId}`);

              /*
               * Automatically move the active tab
               * into view.
               */
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
    console.log("observer", observer);

    categories.forEach((category) => {
      observer.observe(category);
    });
  }
  //logo visible on scroll
  window.addEventListener("scroll", function () {
    const element = document.getElementById("nav-logo");

    if (window.scrollY > 300) {
      element.classList.add("is-visible");
    } else {
      element.classList.remove("is-visible");
    }
  });
  //display the title number in arabic
  const arTitle = document.querySelector(".restaurant-name-ar");

  const textWithStandardNumbers = arTitle.innerText;
  const textWithArabicNumbers = textWithStandardNumbers.replace(
    /\d/g,
    (digit) => {
      return Number(digit).toLocaleString("ar-EG");
    },
  );
  arTitle.innerText = textWithArabicNumbers;
  //first letter uppercase
  //doesn't work
  const descElement = document.querySelector(".restaurant-description-en");
  // debugger;
  const text = descElement.textContent.trim();

  // Lowercase everything, then uppercase just index 0
  descElement.textContent =
    text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
});
