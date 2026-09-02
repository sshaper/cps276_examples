/*
  Chapter 13 mini-app
  Flow:
  1) loadNotes() GET php/list.php
  2) renderNotes() builds <li> items
  3) addNote() POST php/add.php then re-render
  Notes are stored in the MySQL table named miniapp.
*/


const noteText = document.querySelector("#noteText");
const noteList = document.querySelector("#noteList");
const message = document.querySelector("#message");

async function parseJsonResponse(response) {
  const raw = await response.text();
  console.log("PHP response:", raw);
  return JSON.parse(raw);
}

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
    const data = await parseJsonResponse(response);
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
    const data = await parseJsonResponse(response);
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

async function deleteNotes() {
  try {
    const response = await fetch("php/delete.php");
    const data = await parseJsonResponse(response);
    noteList.innerHTML = "";
    message.textContent = data.message;
  } catch (error) {
    console.error(error);
    message.textContent = "Could not delete notes.";
  }
}

addNoteButton.addEventListener("click", addNote);
deleteNotesButton.addEventListener("click", deleteNotes);
loadNotes();
