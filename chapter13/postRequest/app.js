// Chapter 13 POST example
async function submitData(event) {
  event.preventDefault(); // stay on page
  const result = document.querySelector("#result");

  // Build a plain object from the form fields
  const payload = {
    name: document.querySelector("#name").value.trim(),
    age: document.querySelector("#age").value.trim(),
    city: document.querySelector("#city").value.trim()
  };

  try {
    const response = await fetch("php/submit.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      // object -> JSON text for the request body
      body: JSON.stringify(payload)
    });

    const data = await response.json();
    console.log("Server response:", data);

    result.innerHTML = `<h2>${data.message}</h2>
      <p>The name is ${data.received.name}, the age is ${data.received.age}, and the city is ${data.received.city}</p>`;
  } catch (error) {
    console.error("Error:", error);
    result.textContent = "Submit failed.";
  }
}

document.querySelector("#dataForm").addEventListener("submit", submitData);
