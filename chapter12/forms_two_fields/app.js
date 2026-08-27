// Extra Chapter 12 demo: validate two fields before greeting.
const form = document.querySelector("#greetForm");
const result = document.querySelector("#result");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // stay on this page

  const first = document.querySelector("#firstName").value.trim();
  const last = document.querySelector("#lastName").value.trim();

  if (!first || !last) {
    result.textContent = "First and last name are required.";
    return;
  }

  result.textContent = `Hello, ${first} ${last}`;
});
