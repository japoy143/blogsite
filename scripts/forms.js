document.addEventListener("DOMContentLoaded", function () {
  //is password shown
  let isPasswordShown = false;
  // is confirm password shown
  let isConfirmPasswordShown = false;

  //password input
  const passwordInput = document.getElementById("password-input");
  //confirm password input
  const confirmPasswordInput = document.getElementById(
    "confirm-password-input"
  );

  //password button
  const passwordIcon = document.getElementById("password-button");
  //confirm password button
  const confirmPasswordIcon = document.getElementById(
    "confirm-password-button"
  );

  //password visibility function
  passwordIcon.addEventListener("click", function (e) {
    isPasswordShown = !isPasswordShown;

    //initial password type
    passwordInput.type = isPasswordShown ? "password" : "text";
    //initial password icon
    passwordIcon.src = isPasswordShown
      ? "../../assets/icons/hide.svg"
      : "../../assets/icons/visible.svg";
  });

  //confirm password function
  confirmPasswordIcon.addEventListener("click", function (e) {
    isConfirmPasswordShown = !isConfirmPasswordShown;

    //initial confirm password type
    confirmPasswordInput.type = isConfirmPasswordShown ? "password" : "text";
    //initial confirm password icon
    confirmPasswordIcon.src = isConfirmPasswordShown
      ? "../../assets/icons/hide.svg"
      : "../../assets/icons/visible.svg";
  });
});
