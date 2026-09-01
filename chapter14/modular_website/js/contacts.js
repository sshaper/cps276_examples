/*
  Chapter 14 - contacts.js

  This file is the browser side of the contact manager.
  PHP still validates and talks to MySQL. This file never reloads the page.

  Flow (same as Chapter 13, now talking to controllers):
    User action
      → event handler
      → Fetch JSON to a PHP controller
      → PHP reports every field error in one response (empty and format)
      → update the DOM from the JSON response
*/

/* Show a sentence in green (success) or red (error). Used on both pages. */
function showMessage(element, text, isError) {
  if (!element) {
    return; // Wrong page, or the id is missing in the HTML.
  }
  element.textContent = text; // text, not HTML, so user data cannot inject tags
  element.classList.remove("text-danger", "text-success");
  if (text === "") {
    return; // Clear the line without adding a color class.
  }
  element.classList.add(isError ? "text-danger" : "text-success");
}

/* Wipe per-field messages and red outlines on the Add Contact form. */
function clearFieldErrors() {
  // [id^='error_'] means: any element whose id starts with error_
  const errorBoxes = document.querySelectorAll("[id^='error_']");
  errorBoxes.forEach((box) => {
    box.textContent = "";
  });

  const fields = document.querySelectorAll("#contactForm .form-control, #contactForm .form-select");
  fields.forEach((field) => {
    field.classList.remove("is-invalid"); // Bootstrap red outline
  });
}

/* Put PHP (or client) error messages next to the matching add-form inputs. */
function showFieldErrors(errors) {
  clearFieldErrors();
  if (!errors) {
    return;
  }

  // errors looks like { email: "Enter a valid email address." }
  for (const fieldName in errors) {
    const box = document.querySelector("#error_" + fieldName); // #error_email
    const field = document.querySelector("#" + fieldName);     // #email
    if (box) {
      box.textContent = errors[fieldName];
    }
    if (field) {
      field.classList.add("is-invalid");
    }
  }
}

/* Highlight invalid inputs in one table row after a failed update. */
function showRowFieldErrors(tr, errors) {
  const inputs = tr.querySelectorAll("input[type='text']");
  inputs.forEach((input) => {
    input.classList.remove("is-invalid");
  });

  if (!errors) {
    return;
  }

  for (const fieldName in errors) {
    const field = tr.querySelector("input[name='" + fieldName + "']");
    if (field) {
      field.classList.add("is-invalid");
    }
  }
}

/* Read the add-contact form into a plain object. Keys must match PHP. */
function getFormData() {
  return {
    first_name: document.querySelector("#first_name").value.trim(),
    last_name: document.querySelector("#last_name").value.trim(),
    address: document.querySelector("#address").value.trim(),
    state: document.querySelector("#state").value,
    zip_code: document.querySelector("#zip_code").value.trim(),
    phone: document.querySelector("#phone").value.trim(),
    email: document.querySelector("#email").value.trim()
  };
}

/* Read one table row's inputs plus the contact id stored on the <tr>. */
function getRowData(tr) {
  return {
    id: tr.dataset.id, // set in renderContacts from contact.id
    first_name: tr.querySelector("input[name='first_name']").value.trim(),
    last_name: tr.querySelector("input[name='last_name']").value.trim(),
    address: tr.querySelector("input[name='address']").value.trim(),
    state: tr.querySelector("input[name='state']").value.trim(),
    zip_code: tr.querySelector("input[name='zip_code']").value.trim(),
    phone: tr.querySelector("input[name='phone']").value.trim(),
    email: tr.querySelector("input[name='email']").value.trim()
  };
}

/* Form submit on the Add Contact page. */
async function addContact(event) {
  event.preventDefault(); // Stay on this page. Without this, the browser reloads.

  const acknowledgment = document.querySelector("#acknowledgment");
  showMessage(acknowledgment, "", false);
  clearFieldErrors();

  const payload = getFormData();

  // Always Fetch. If JS stopped on empty fields, PHP would never report
  // format errors (bad phone/email) on the same click.
  try {
    // Same Fetch POST pattern as Chapter 13. URL is now a controller.
    const response = await fetch("controllers/addContact.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json" // Tells PHP the body is JSON text
      },
      body: JSON.stringify(payload) // Object → string for the network
    });

    if (!response.ok) {
      throw new Error("Network response was not ok"); // 404/500, etc.
    }

    const data = await response.json(); // PHP json_encode → JavaScript object
    showMessage(acknowledgment, data.message, data.error);

    if (data.error) {
      showFieldErrors(data.errors); // Server-side field messages
      return;
    }

    clearFieldErrors();
  } catch (error) {
    console.error(error);
    showMessage(acknowledgment, "Could not add the contact.", true);
  }
}

/* Build one read-only table cell. textContent is safe for user data. */
function createTextCell(value) {
  const td = document.createElement("td");
  td.textContent = value;
  return td;
}

/* Build one editable <input type="text"> cell. value is shown; name matches the JSON key. */
function createInputCell(name, value) {
  const td = document.createElement("td");
  const input = document.createElement("input");
  input.type = "text";
  input.classList.add("form-control");
  input.name = name;
  input.value = value; // assigning .value is safe (not innerHTML)
  td.append(input);
  return td;
}

/* Build a table cell that holds an Update or Delete button. */
function createButtonCell(label, className, buttonClass) {
  const td = document.createElement("td");
  const button = document.createElement("button");
  button.type = "button"; // type=button so it does not submit a form
  button.textContent = label;
  button.classList.add("btn", "btn-sm", buttonClass, className);
  td.append(button);
  return td;
}

/* Build table rows from the JSON contacts array.
   data-mode="list"   → plain text (List Contacts page)
   data-mode="update" → inputs + Update/Delete (Update/Delete page)
*/
function renderContacts(contacts) {
  const tbody = document.querySelector("#contactsTableBody");
  const panel = document.querySelector("#contactsPanel");
  const listMessage = document.querySelector("#listMessage");
  const table = document.querySelector("#contactsTable");
  const editable = table && table.dataset.mode === "update";

  tbody.innerHTML = ""; // Clear old rows so a second load does not duplicate them.

  if (!contacts || contacts.length === 0) {
    showMessage(listMessage, "There are no records to display", false);
    if (panel) {
      panel.classList.add("d-none"); // Hide the empty table
    }
    return;
  }

  if (panel) {
    panel.classList.remove("d-none");
  }

  contacts.forEach((contact) => {
    const tr = document.createElement("tr");
    tr.dataset.id = contact.id; // used on the update/delete page

    if (editable) {
      tr.append(createInputCell("first_name", contact.first_name));
      tr.append(createInputCell("last_name", contact.last_name));
      tr.append(createInputCell("address", contact.address));
      tr.append(createInputCell("state", contact.state));
      tr.append(createInputCell("zip_code", contact.zip_code));
      tr.append(createInputCell("phone", contact.phone));
      tr.append(createInputCell("email", contact.email));
      tr.append(createButtonCell("Update", "update-btn", "btn-primary"));
      tr.append(createButtonCell("Delete", "delete-btn", "btn-danger"));
    } else {
      tr.append(createTextCell(contact.first_name));
      tr.append(createTextCell(contact.last_name));
      tr.append(createTextCell(contact.address));
      tr.append(createTextCell(contact.state));
      tr.append(createTextCell(contact.zip_code));
      tr.append(createTextCell(contact.phone));
      tr.append(createTextCell(contact.email));
    }

    tbody.append(tr);
  });
}

/* Fetch GET — load every contact when the list page opens, and after update/delete. */
async function loadContacts(keepMessage) {
  const listMessage = document.querySelector("#listMessage");
  if (!keepMessage) {
    showMessage(listMessage, "Loading contacts...", false);
  }

  try {
    // GET is the default Fetch method, so no method/body is needed.
    const response = await fetch("controllers/listContacts.php");
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    const data = await response.json();
    if (data.error) {
      showMessage(listMessage, data.message, true);
      return;
    }

    if (!keepMessage) {
      showMessage(listMessage, "", false);
    }
    renderContacts(data.contacts); // Must be data.contacts (the JSON contract key)
  } catch (error) {
    console.error(error);
    showMessage(listMessage, "Could not load contacts.", true);
  }
}

/* Update button on one row: Fetch POST so PHP can check every field, then refresh the table. */
async function updateContact(tr) {
  const listMessage = document.querySelector("#listMessage");
  showRowFieldErrors(tr, {});

  const payload = getRowData(tr);

  // Always Fetch so PHP can flag blank fields and bad formats together.
  try {
    const response = await fetch("controllers/updateContact.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(payload)
    });

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    const data = await response.json();
    if (data.error) {
      showRowFieldErrors(tr, data.errors);
      showMessage(listMessage, data.message, true);
      return; // Keep the user's typed values; do not rebuild the table yet.
    }

    await loadContacts(true); // Rebuild rows from MySQL
    showMessage(listMessage, data.message, false); // "Contact updated successfully"
  } catch (error) {
    console.error(error);
    showMessage(listMessage, "Could not update the contact.", true);
  }
}

/* Delete button on one row: Fetch POST that row's id, then refresh the table. */
async function deleteContact(tr) {
  const listMessage = document.querySelector("#listMessage");
  const id = tr.dataset.id;

  try {
    const response = await fetch("controllers/deleteContact.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ id: id }) // one id, not an array
    });

    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    const data = await response.json();
    if (data.error) {
      showMessage(listMessage, data.message, true);
      return;
    }

    await loadContacts(true);
    showMessage(listMessage, data.message, false); // "Contact deleted successfully"
  } catch (error) {
    console.error(error);
    showMessage(listMessage, "Could not delete the contact.", true);
  }
}

/*
  Event delegation: one listener on the tbody handles every Update/Delete button,
  including buttons created later by renderContacts().
*/
function handleRowAction(event) {
  const button = event.target;
  const tr = button.closest("tr");
  if (!tr) {
    return;
  }

  if (button.classList.contains("update-btn")) {
    updateContact(tr);
  }

  if (button.classList.contains("delete-btn")) {
    deleteContact(tr);
  }
}

/*
  One JS file is included on Add Contact, List Contacts, and Update/Delete.
  querySelector returns null if that element is not on the current page.
*/
const contactForm = document.querySelector("#contactForm");
if (contactForm) {
  contactForm.addEventListener("submit", addContact);
}

const contactsTableBody = document.querySelector("#contactsTableBody");
const contactsTable = document.querySelector("#contactsTable");
if (contactsTableBody) {
  // Only the update/delete page has buttons to click.
  if (contactsTable && contactsTable.dataset.mode === "update") {
    contactsTableBody.addEventListener("click", handleRowAction);
  }
  loadContacts(); // Fill the table as soon as this page loads
}
