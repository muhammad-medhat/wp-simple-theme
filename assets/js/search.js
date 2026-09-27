/* =========================================================
MENU SEARCH
========================================================= */

// const searchContainer = document.getElementById("menu-search");

// const searchInput = document.getElementById("menu-search-input");

// const searchClear = document.getElementById("menu-search-clear");

// const searchEmpty = document.getElementById("menu-search-empty");

// if (searchContainer && searchInput && searchClear && searchEmpty) {
//   const menuItems = document.querySelectorAll(".menu-item-card");

//   const categories = document.querySelectorAll(".menu-category");

//   function updateSearchText(language) {
//     if (language === "ar") {
//       searchInput.placeholder = "ابحث في القائمة...";

//       searchInput.setAttribute("aria-label", "البحث في القائمة");

//       searchClear.setAttribute("aria-label", "مسح البحث");

//       searchEmpty.textContent = "لم يتم العثور على أي صنف.";
//     } else {
//       searchInput.placeholder = "Search menu...";

//       searchInput.setAttribute("aria-label", "Search menu");

//       searchClear.setAttribute("aria-label", "Clear search");

//       searchEmpty.textContent = "No menu items found.";
//     }
//   }

//   function normalizeText(text) {
//     return text.toLowerCase().trim().replace(/\s+/g, " ");
//   }

//   function searchMenu() {
//     const query = normalizeText(searchInput.value);

//     let visibleItems = 0;

//     menuItems.forEach((item) => {
//       if (!query) {
//         item.style.display = "";
//         visibleItems++;
//         return;
//       }

//       const searchableText = normalizeText(item.textContent);

//       const matches = searchableText.includes(query);

//       item.style.display = matches ? "" : "none";

//       if (matches) {
//         visibleItems++;
//       }
//     });

//     /*
//      * Hide categories that contain no
//      * matching menu items.
//      */
//     categories.forEach((category) => {
//       const categoryItems = category.querySelectorAll(".menu-item-card");

//       let hasVisibleItem = false;

//       categoryItems.forEach((item) => {
//         if (item.style.display !== "none") {
//           hasVisibleItem = true;
//         }
//       });

//       category.style.display = hasVisibleItem || !query ? "" : "none";
//     });

//     searchClear.hidden = query === "";

//     searchEmpty.hidden = visibleItems > 0 || query === "";
//   }

//   searchInput.addEventListener("input", searchMenu);

//   searchClear.addEventListener("click", () => {
//     searchInput.value = "";

//     searchMenu();

//     searchInput.focus();
//   });

//   /*
//    * Update search language immediately.
//    */
//   updateSearchText(document.documentElement.lang === "ar" ? "ar" : "en");

//   /*
//    * Update search language whenever
//    * the user switches language.
//    */
//   const languageSwitcher = document.getElementById("language-switcher");

//   if (languageSwitcher) {
//     languageSwitcher.addEventListener("click", () => {
//       setTimeout(() => {
//         updateSearchText(
//           document.documentElement.lang === "ar" ? "ar" : "en",
//         );
//       }, 0);
//     });
//   }
// }
/* =========================================================
MENU SEARCH
========================================================= */

const searchInput = document.getElementById("menu-search-input");

const searchClear = document.getElementById("menu-search-clear");

const searchEmpty = document.getElementById("menu-search-empty");

if (searchInput) {
  const menuItems = document.querySelectorAll(".menu-item-card");

  function normalizeText(text) {
    return text.toString().toLowerCase().trim().replace(/\s+/g, " ");
  }

  function updateSearchLanguage(language) {
    const isArabic = language === "ar";

    searchInput.placeholder = isArabic
      ? "ابحث في القائمة..."
      : "Search menu...";

    searchInput.setAttribute(
      "aria-label",
      isArabic ? "البحث في القائمة" : "Search menu",
    );

    if (searchClear) {
      searchClear.setAttribute(
        "aria-label",
        isArabic ? "مسح البحث" : "Clear search",
      );
    }

    if (searchEmpty) {
      searchEmpty.textContent = isArabic
        ? "لم يتم العثور على أي صنف."
        : "No menu items found.";
    }
  }

  function performSearch() {
    const query = normalizeText(searchInput.value);

    let found = 0;

    menuItems.forEach((item) => {
      /*
       * Search the complete visible text
       * of the product.
       *
       * This includes:
       * - Arabic name
       * - English name
       * - Arabic description
       * - English description
       * - variations
       * - pizza sizes
       */
      const itemText = normalizeText(item.textContent);

      const matches = !query || itemText.includes(query);

      item.hidden = !matches;

      if (matches) {
        found++;
      }
    });

    if (searchClear) {
      searchClear.hidden = query === "";
    }

    if (searchEmpty) {
      searchEmpty.hidden = query === "" || found > 0;
    }
  }

  searchInput.addEventListener("input", performSearch);

  if (searchClear) {
    searchClear.addEventListener("click", () => {
      searchInput.value = "";

      performSearch();

      searchInput.focus();
    });
  }

  /*
   * Initial language.
   */
  updateSearchLanguage(document.documentElement.lang === "ar" ? "ar" : "en");

  /*
   * Update search language when
   * the language is changed.
   */
  const languageSwitcher = document.getElementById("language-switcher");

  if (languageSwitcher) {
    languageSwitcher.addEventListener("click", () => {
      setTimeout(() => {
        updateSearchLanguage(
          document.documentElement.lang === "ar" ? "ar" : "en",
        );
      }, 0);
    });
  }
}
