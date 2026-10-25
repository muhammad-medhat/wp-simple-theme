(() => {
  document.addEventListener("DOMContentLoaded", () => {
    const menu = document.querySelector(".menu-design--classic .menu__content");

    if (!menu) return;

    const categories = Array.from(
      menu.querySelectorAll(":scope > .menu-category"),
    );

    if (!categories.length) return;

    // Preserve the original category order for rebuilding.
    const originalOrder = [...categories];

    function arrangeCategories() {
      const isDesktop = window.innerWidth >= 768;

      // Remove old generated columns and restore categories.
      menu.querySelectorAll(".menu-column").forEach((column) => {
        column.remove();
      });

      originalOrder.forEach((category) => menu.appendChild(category));

      if (!isDesktop) {
        menu.style.display = "block";
        return;
      }

      menu.style.display = "grid";
      menu.style.gridTemplateColumns = "repeat(2, minmax(0, 1fr))";
      menu.style.gap = "0 28px";

      const columns = [
        document.createElement("div"),
        document.createElement("div"),
      ];

      columns.forEach((column) => {
        column.className = "menu-column";
        column.style.minWidth = "0";
      });

      menu.replaceChildren(...columns);

      // Assign each category to the currently shorter column.
      originalOrder.forEach((category) => {
        const firstHeight = columns[0].offsetHeight;
        const secondHeight = columns[1].offsetHeight;

        const target = firstHeight <= secondHeight ? columns[0] : columns[1];

        target.appendChild(category);
      });
    }

    let resizeTimer;

    window.addEventListener("resize", () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(arrangeCategories, 150);
    });

    arrangeCategories();
  });

  function initMenuMasonry() {
    console.log("initMenuMasonry...");
    const menu = document.querySelector(".menu-design--classic .menu__content");
    if (!menu) return;

    // Capture the original category order once.
    const originalCategories = Array.from(menu.children).filter((element) =>
      element.classList.contains("menu-category"),
    );

    if (!originalCategories.length) return;

    let resizeTimer;
    let layoutRunning = false;

    function restoreOriginalOrder() {
      menu.classList.remove("menu-is-masonry");

      // Remove generated columns and restore the categories.
      menu.replaceChildren(...originalCategories);
    }

    function balanceColumns() {
      if (layoutRunning) return;
      layoutRunning = true;

      try {
        // Mobile: one column, in original order.
        if (window.innerWidth < 768) {
          restoreOriginalOrder();
          return;
        }

        // Create two independent columns.
        const left = document.createElement("div");
        const right = document.createElement("div");

        left.className = "menu-column";
        right.className = "menu-column";

        menu.replaceChildren(left, right);
        menu.classList.add("menu-is-masonry");

        // Preserve category order while assigning each category
        // to whichever column is currently shorter.
        originalCategories.forEach((category) => {
          const leftHeight = left.getBoundingClientRect().height;
          const rightHeight = right.getBoundingClientRect().height;

          const target = leftHeight <= rightHeight ? left : right;

          target.appendChild(category);
        });
      } finally {
        layoutRunning = false;
      }
    }

    // Wait for web fonts and category images before measuring heights.
    async function waitForAssets() {
      if (document.fonts && document.fonts.ready) {
        await document.fonts.ready;
      }

      const images = Array.from(menu.querySelectorAll("img"));

      await Promise.all(
        images.map((image) => {
          if (image.complete) {
            return Promise.resolve();
          }

          return new Promise((resolve) => {
            image.addEventListener("load", resolve, {
              once: true,
            });
            image.addEventListener("error", resolve, {
              once: true,
            });
          });
        }),
      );
    }

    // Re-layout after the initial content is ready.
    waitForAssets().then(balanceColumns);

    // Re-layout when moving between mobile and desktop widths.
    window.addEventListener("resize", () => {
      clearTimeout(resizeTimer);

      resizeTimer = setTimeout(async () => {
        await waitForAssets();
        balanceColumns();
      }, 180);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initMenuMasonry, {
      once: true,
    });
  } else {
    initMenuMasonry();
  }
})();
