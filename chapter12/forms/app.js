// Chapter 12 - Forms and preventDefault
const form = document.querySelector("#greetForm");
const firstName = document.querySelector("#firstName");
const result = document.querySelector("#result");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // without this, the page reloads

  const name = firstName.value.trim();
  if (!name) {
    result.textContent = "Please enter a name.";
    return; // stop the function here
  }

  result.textContent = `Hello, ${name}`;
});
