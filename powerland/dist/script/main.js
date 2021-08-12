$(() => {
  class Navigation {
    constructor() {
      this.toggle = false;
      this.headerIniHeight = 0;
      this.subActiveHeight = 0;
      this.burgMenu = $("#burgMenu");
      this.headerContainer = $("#headerContainer");
      this.header = $("#header");
      this.nav = $("#navMobile");
      this.categories = $(".category");
      this.subcategoryContainer = $(".subcategoryContainer");
      this.subcategories = $(".subcategory");
      this.subcategoriesDesk = $(".subcategoryDesk");
      this.subcategoryDeskContainer = $(".subcategoryDeskContainer");
      this.categoriesDesk = $(".categoryDesk");
    }

    showMenu = () => {
      if (!this.toggle) {
        // set open menu
        this.toggle = true;
        // animate height
        gsap.to(this.headerContainer, {
          height: this.headerIniHeight,
        });
        // animate opacity
        gsap.to(this.nav, { opacity: 1 });
        return;
      }

      if (this.toggle) {
        // set close menu
        this.toggle = false;
        // animate height to 0
        gsap.to(this.headerContainer, {
          height: this.header.innerHeight(),
        });
        // animate opacity 0
        gsap.to(this.nav, { opacity: 0 });
        return;
      }
    };

    catEventClick = () => {
      this.categories.on("click", (e) => {
        e.preventDefault();

        const curSubcategoryContainer = $(e.currentTarget).parent().next();

        if (curSubcategoryContainer.hasClass("active")) {
          return;
        }
        // current height of the header container - current active sub ul
        const difference =
          this.headerContainer.innerHeight() - this.subActiveHeight;
        // difference + the sub ul height of the selected category
        const newHeight =
          difference + curSubcategoryContainer.find("ul").innerHeight();
        // remove active class and animate height to 0 of current active sub container, animate opacity to 0 and x position of current sub container ul
        $.each(this.subcategoryContainer, (i, sub) => {
          if ($(sub).hasClass("active")) {
            $(sub).removeClass("active");
            gsap.to(sub, { height: 0 });
            gsap.to($(sub).find("ul"), { opacity: 0, x: 50 });
          }
        });
        // get height of sub container ul of selected category
        const ulHeight = $(e.currentTarget)
          .parent()
          .next()
          .find("ul")
          .innerHeight();
        // animated height of header container to the value of newHeight @ line 50
        gsap.to(this.headerContainer, { height: newHeight });
        // animate selected category sub container height to the value of ulHeight @ line 61
        gsap.to(curSubcategoryContainer, {
          height: ulHeight,
          onComplete: () => {
            // add class after animation
            curSubcategoryContainer.addClass("active");
            // set new value
            this.subActiveHeight = curSubcategoryContainer
              .find("ul")
              .innerHeight();
          },
        });
        // animate ul
        gsap.to($(curSubcategoryContainer).find("ul"), { opacity: 1, x: 0 });
      });
    };

    catDeskEventClick = () => {
      this.categoriesDesk.on("click", (e) => {
        e.preventDefault();
        if ($(e.currentTarget).hasClass("active")) {
          return;
        }

        $.each(this.categoriesDesk, (i, cat) => $(cat).removeClass("active"));

        $(e.currentTarget).addClass("active");

        const curCatData = $(e.currentTarget).attr("data-categorydesk");

        const curSubcategoryContainer = $(e.currentTarget)
          .parent()
          .parent()
          .next()
          .find(".active");

        gsap.to(curSubcategoryContainer, {
          opacity: 0,
          x: 100,
          onComplete: () => {
            curSubcategoryContainer
              .removeClass("block active")
              .addClass("hidden");

            $.each(this.subcategoryDeskContainer, (i, subcatCont) => {
              if (curCatData === $(subcatCont).attr("data-categorydesk")) {
                $(subcatCont).removeClass("hidden").addClass("block active");
                gsap.to(subcatCont, { opacity: 1, x: 0 });
              }
            });
          },
        });
      });
    };

    subcatEventClick = () => {
      this.subcategories.on("click", (e) => {
        e.preventDefault();
        const dataSub = $(e.currentTarget).attr("data-subcategory");
        const dataCat = $(e.currentTarget)
          .parent()
          .parent()
          .parent()
          .prev()
          .find("a")
          .attr("data-category");

        this.toggle = false;
        // animate header container before changing the url of the page
        gsap.to(this.headerContainer, {
          height: this.header.innerHeight(),
          onComplete: () => {
            window.location.href = window.location.pathname.includes(
              "index.php"
            )
              ? `${window.location.pathname}?cat=${dataCat.replace(
                  " ",
                  "+"
                )}&subcat=${dataSub.replace(" ", "+")}`
              : `${window.location.pathname}index.php?cat=${dataCat.replace(
                  " ",
                  "+"
                )}&subcat=${dataSub.replace(" ", "+")}`;
          },
        });
      });
    };

    subcatDeskEventClick = () => {
      this.subcategoriesDesk.on("click", (e) => {
        e.preventDefault();
        const dataSub = $(e.currentTarget).attr("data-subcategorydesk");
        const dataCat = $(e.currentTarget)
          .parent()
          .parent()
          .parent()
          .prev()
          .find("a.active")
          .attr("data-categorydesk");

        window.location.href = window.location.pathname.includes("index.php")
          ? `${window.location.pathname}?cat=${dataCat.replace(
              " ",
              "+"
            )}&subcat=${dataSub.replace(" ", "+")}`
          : `${window.location.pathname}index.php?cat=${dataCat.replace(
              " ",
              "+"
            )}&subcat=${dataSub.replace(" ", "+")}`;
      });
    };

    onload = () => {
      // store initial height of header container
      this.headerIniHeight = this.headerContainer.innerHeight();
      // set height header container to the height of header
      this.headerContainer.innerHeight(this.header.innerHeight());
      // store height of current active subcontainer ul
      this.subActiveHeight = this.categories
        .parent()
        .parent()
        .find(".active")
        .innerHeight();

      this.subcatEventClick();
      this.subcatDeskEventClick();
      this.catEventClick();
      this.catDeskEventClick();
    };

    resize = () => {
      if (window.matchMedia("(min-width: 1024px)").matches) {
        // store initial height of header container
        this.headerIniHeight = this.headerContainer.innerHeight();
        // set height header container to the height of header
        this.headerContainer.innerHeight(this.header.innerHeight());
        return;
      }
      // store initial height of header container
      this.headerIniHeight =
        this.headerContainer.innerHeight() + this.nav.innerHeight();
      // set height header container to the height of header
      this.headerContainer.innerHeight(this.header.innerHeight());
    };
  }

  const navigation = new Navigation();

  navigation.burgMenu.on("click", () => {
    navigation.showMenu();
  });

  $(window).on("load", () => {
    navigation.onload();
  });

  $(window).on("resize", () => {
    navigation.resize();
  });
});
