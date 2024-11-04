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
  //user account
  const userAccount = document.querySelectorAll("#user-account");
  const userAvatarContainer = document.querySelector(
    ".user-header-avatar-container"
  );

  //header visibility options
  //hide or show user avatar name and image
  headerBody.childNodes.forEach(function (e) {
    if (e.nodeName == "MAIN") {
      let main = e.className;
      if (main === "landing-container") {
        linkItems.style.visibility = "hidden";
        loginSignupContainer.style.visibility = "inherit";
        userAccount[0].style.display = "none";
        userAccount[1].style.display = "none";
        userAvatarContainer.style.display = "none";
      }
    }
  });

  let isUserSectionShown = false;

  //user actions section
  const userActionSection = document.getElementById("user-actions");

  //nav user account button
  userAccount[0].addEventListener("click", function (e) {
    isUserSectionShown = !isUserSectionShown;
    userActionSection.style.display = isUserSectionShown ? "flex" : "none";
    console.log("click");
  });

  userAccount[1].addEventListener("click", function (e) {
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
