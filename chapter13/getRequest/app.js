// Chapter 13 GET example — detailed comments for first-time learners
async function loadPerson() {
  const result = document.querySelector("#result");

  try {
    // 1) Ask PHP for JSON
    const response = await fetch("php/data.php");

    // 2) Catch HTTP-level failures (404, 500, etc.)
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }

    // 3) Parse JSON. If this throws, read response.text() instead (see phpjson.html).
    const data = await response.json();
    console.log("Parsed data:", data);

    // 4) Update the page (DOM)
    result.textContent = `The name is ${data.name}, the age is ${data.age} and the city is ${data.city}`;
  } catch (error) {
    console.error("Error:", error);
    result.textContent = "Could not load data.";
  }
}

// Don't forget to call it!
loadPerson();
