// Chapter 12 - Selecting Elements
// Open the page and the console.

const message = document.querySelector("#message"); // id selector
const firstNote = document.querySelector(".note");  // first class match
const allNotes = document.querySelectorAll(".note"); // all matches

console.log("message element:", message);
console.log("firstNote element:", firstNote);
console.log("allNotes length:", allNotes.length);

if (message) {
  message.textContent = "Selected with querySelector";
}
