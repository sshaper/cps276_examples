/*
  Chapter 14 - contacts.js
  Purpose: quick client-side required-field checks BEFORE the form
  posts to PHP. This is NOT security. PHP still validates.

  If a check fails: preventDefault and show a message.
  If checks pass: do nothing and let the normal PHP POST happen.
*/

const form = document.querySelector("#contactForm");
const jsError = document.querySelector("#jsError");

if (form) {
  form.addEventListener("submit", (event) => {
    if (!jsError) {
      return;
    }
    jsError.textContent = "";

    const requiredIds = ["first_name", "last_name", "address", "zip_code", "phone", "email"];
    for (const id of requiredIds) {
      const el = document.querySelector("#" + id);
      if (el && el.value.trim() === "") {
        event.preventDefault();
        jsError.textContent = "Please fill out all required fields before submitting.";
        el.focus();
        return;
      }
    }

    const state = document.querySelector("#state");
    if (state && (state.value === "0" || state.value === "")) {
      event.preventDefault();
      jsError.textContent = "Please select a state.";
      state.focus();
    }
  });
}
