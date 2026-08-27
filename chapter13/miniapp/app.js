/*
  Chapter 13 mini-app
  Flow:
  1) loadNotes() GET list.php
  2) renderNotes() builds <li> items
  3) addNote() POST add.php then re-render
*/

const noteForm = document.querySelector("#noteForm");
const noteText = document.querySelector("#noteText");
const noteList = document.querySelector("#noteList");
const message = document.querySelector("#message");

function renderNotes(notes) {
  noteList.innerHTML = "";
  notes.forEach((note) => {
    const li = document.createElement("li");
    li.textContent = note;
    noteList.append(li);
  });
}

async function loadNotes() {
  try {
    const response = await fetch("php/list.php");
    const data = await response.json();
    if (data.error) {
      message.textContent = data.message;
      return;
    }
    renderNotes(data.items);
  } catch (error) {
    console.error(error);
    message.textContent = "Could not load notes.";
  }
}

async function addNote(event) {
  event.preventDefault();
  message.textContent = "";
  const text = noteText.value.trim();
  if (!text) {
    message.textContent = "Please enter a note.";
    return;
  }

  try {
    const response = await fetch("php/add.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ note: text })
    });
    const data = await response.json();
    message.textContent = data.message;
    if (!data.error) {
      noteText.value = "";
      renderNotes(data.items);
    }
  } catch (error) {
    console.error(error);
    message.textContent = "Could not add note.";
  }
}

noteForm.addEventListener("submit", addNote);
loadNotes();
