document.addEventListener("DOMContentLoaded", function () {
  //is menu icon
  let menuIconState = false;

  //menu button
  const menuIconButton = document.getElementById("menu-icon-button");

  //nav menu container
  const navMenuContainer = document.getElementById("nav-container");

  menuIconButton.addEventListener("click", function (e) {
    menuIconState = !menuIconState;

    // close icon or menu icon
    menuIconButton.src = menuIconState
      ? "./assets/icons/close.svg"
      : "./assets/icons/menu.svg";

    // pop up nav menu
    navMenuContainer.style.display = menuIconState ? "flex" : "none";
  });

  const headerBody = document.getElementById("landing-page");
  const linkItems = document.getElementById("link-items");
  const loginSignupContainer = document.getElementById(
    "login-signup-container"
  );
  const userAccount = document.getElementById("user-account");

  headerBody.childNodes.forEach(function (e) {
    if (e.nodeName == "MAIN") {
      let main = e.className;
      if (main === "landing-container") {
        linkItems.style.visibility = "hidden";
        loginSignupContainer.style.visibility = "inherit";
        userAccount.style.display = "none";
      }
    }
  });

  let isUserSectionShown = false;

  //user account
  const navUserAccount = document.getElementById("user-account");

  //user actions section
  const userActionSection = document.getElementById("user-actions");

  //nav user account button
  navUserAccount.addEventListener("click", function (e) {
    isUserSectionShown = !isUserSectionShown;
    userActionSection.style.display = isUserSectionShown ? "flex" : "none";
    console.log("click");
  });

  //login & signup visibility
  const loginAndSignupVisibility = document.getElementById("login-signup");

  headerBody.childNodes.forEach(function (e) {
    if (e.nodeName == "MAIN") {
      let navItem = e.className; // class=Home, Featured, Categories

      if (navItem === "landing-container") {
        menuIconButton.style.display = "none";
        loginSignupContainer.style.visibility = "visible";
      } else {
        loginSignupContainer.style.display = "none";
      }

      linkItems.childNodes.forEach(function (e) {
        //innerHTML =Home, Featured, Categories
        if (e.innerHTML === navItem) {
          e.style.color = "#e78f81";
        }
      });
    }
  });
});
