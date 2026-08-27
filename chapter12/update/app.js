// Chapter 12 - Updating the Page
const updateBtn = document.querySelector("#updateBtn");
const message = document.querySelector("#message");
const alertBox = document.querySelector("#alert");
const names = document.querySelector("#names");

updateBtn.addEventListener("click", () => {
  // 1) Change plain text safely
  message.textContent = "Saved successfully";

  // 2) Reveal and style an alert with Bootstrap classes
  alertBox.classList.remove("d-none");
  alertBox.classList.add("text-danger");

  // 3) Create a new list item and attach it
  const li = document.createElement("li");
  li.textContent = "Scott";
  names.append(li);
});
