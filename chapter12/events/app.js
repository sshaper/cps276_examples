// Chapter 12 - Events
const greetBtn = document.querySelector("#greetBtn");
const out = document.querySelector("#out");
const nameInput = document.querySelector("#nameInput");
const preview = document.querySelector("#preview");

// Click event: run only when the button is clicked
greetBtn.addEventListener("click", () => {
  out.textContent = "Hello from JavaScript";
  console.log("greetBtn click handler ran");
});

// Input event: run as the user types
nameInput.addEventListener("input", () => {
  preview.textContent = `Hello, ${nameInput.value}`;
});
