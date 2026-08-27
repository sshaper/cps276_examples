// Chapter 12 - Practice Name List
// Step 1: preventDefault on submit
// Step 2: validate trimmed name
// Step 3: append a new li
// Step 4: optional filter

const form = document.querySelector("#nameForm");
const nameInput = document.querySelector("#nameInput");
const filterInput = document.querySelector("#filterInput");
const error = document.querySelector("#error");
const nameList = document.querySelector("#nameList");

function addName(name) {
  const li = document.createElement("li");
  li.textContent = name; // textContent is safer than innerHTML for user text
  nameList.append(li);
}

function applyFilter() {
  const term = filterInput.value.trim().toLowerCase();
  nameList.querySelectorAll("li").forEach((li) => {
    const match = li.textContent.toLowerCase().includes(term);
    // hide when filtering and this item does not match
    li.classList.toggle("d-none", term !== "" && !match);
  });
}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  error.textContent = "";

  const name = nameInput.value.trim();
  if (!name) {
    error.textContent = "Please enter a name.";
    return;
  }

  addName(name);
  nameInput.value = "";
  applyFilter();
});

filterInput.addEventListener("input", applyFilter);
