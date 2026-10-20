document.addEventListener("DOMContentLoaded", function () {
  const languageSwitcher = document.getElementById("language-switcher");

  const LANGUAGE_STORAGE_KEY = "restaurant_menu_language";

  /*
   * ---------------------------------------------------------
   * Set active language
   * ---------------------------------------------------------
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
     * Tell the frontend which language
     * is currently active.
     */

    document.body.setAttribute("data-menu-language", language);

    /*
     * Save user's language preference
     */

    if (save) {
      localStorage.setItem(LANGUAGE_STORAGE_KEY, language);
    }

    /*
     * Update language buttons
     *
     * This works for Modern, Elegant and Dark
     * as long as they use:
     *
     * .language-switcher__option
     * data-language="ar"
     * data-language="en"
     */

    if (languageSwitcher) {
      const languageButtons = languageSwitcher.querySelectorAll(
        ".language-switcher__option",
      );

      languageButtons.forEach((button) => {
        const buttonLanguage = button.getAttribute("data-language");

        const isActive = buttonLanguage === language;

        button.classList.toggle("active", isActive);

        /*
         * Accessibility
         */

        button.setAttribute("aria-pressed", isActive ? "true" : "false");
      });

      /*
       * Update switcher accessibility label
       */

      languageSwitcher.setAttribute(
        "aria-label",
        isArabic ? "Switch to English" : "التبديل إلى العربية",
      );
    }
  }

  /*
   * ---------------------------------------------------------
   * Language button clicks
   * ---------------------------------------------------------
   */

  if (languageSwitcher) {
    const languageButtons = languageSwitcher.querySelectorAll(
      ".language-switcher__option",
    );

    languageButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const language = button.getAttribute("data-language");

        if (language !== "ar" && language !== "en") {
          return;
        }
        // debugger;

        setLanguage(language);
      });
    });
  }

  /*
   * ---------------------------------------------------------
   * Initialize language
   * ---------------------------------------------------------
   *
   * Arabic is the default language for the menu.
   *
   * If the user previously selected a language,
   * restore that language.
   */

  const savedLanguage = localStorage.getItem(LANGUAGE_STORAGE_KEY);

  const defaultLanguage =
    savedLanguage === "en" || savedLanguage === "ar" ? savedLanguage : "ar";

  setLanguage(defaultLanguage, false);

  // ..................................................................................
  const mobileSwitcher = document.getElementById("mobile-language");
  if (!mobileSwitcher) {
    return;
  }

  const toggle = mobileSwitcher.querySelector(".mobile-language__toggle");
  // debugger;

  const options = mobileSwitcher.querySelector(".mobile-language__options");

  let hideTimer;

  function showSwitcher() {
    mobileSwitcher.classList.remove("is-hidden");

    clearTimeout(hideTimer);

    hideTimer = setTimeout(function () {
      options.hidden = true;
      toggle.setAttribute("aria-expanded", "false");
      mobileSwitcher.classList.add("is-hidden");
    }, 5000);
  }

  toggle.addEventListener("click", function () {
    showSwitcher();

    options.hidden = !options.hidden;

    toggle.setAttribute("aria-expanded", String(!options.hidden));
  });

  // Reappear when the user interacts with a menu item.
  document.addEventListener("click", function (event) {
    if (event.target.closest(".product, .item, .category-banner")) {
      showSwitcher();
    }

    // Also support keyboard navigation.
    document.addEventListener("focusin", function (event) {
      if (event.target.closest(".product, .item, .category-banner")) {
        showSwitcher();
      }
    });

    // Close after a language is selected.
    options.addEventListener("click", function (event) {
      console.log("===========");
      if (event.target.closest("[data-language]")) {
        options.hidden = true;
        toggle.setAttribute("aria-expanded", "false");
        setLanguage(
          event.target.closest("[data-language]").getAttribute("data-language"),
        );
        showSwitcher();
      }
    });

    // Show on initial page load, then hide after five seconds.
    showSwitcher();
  });
});
