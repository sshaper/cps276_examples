async function uploadFile(event) {
  event.preventDefault();
  const responseMessage = document.querySelector("#responseMessage");
  const fileInput = document.querySelector("#fileInput");
  const fileName = document.querySelector("#fileName").value.trim();

  const formData = new FormData();
  formData.append("file", fileInput.files[0]);
  formData.append("fileName", fileName);

  try {
    const response = await fetch("php/upload.php", {
      method: "POST",
      body: formData
    });
    const data = await response.json();
    if (!data.error) {
      responseMessage.innerHTML = `<h2>Response</h2>
        <p>Image name is: ${data.fileName}<br>
        <img src="${data.path}" alt="uploaded image" class="img-fluid"></p>`;
    } else {
      responseMessage.innerHTML = `<h2>Response</h2><p>${data.msg}</p>`;
    }
  } catch (error) {
    console.error(error);
    responseMessage.innerHTML = `<h2>Response</h2><p>Error: ${error}</p>`;
  }
}

document.querySelector("#fileUploadForm").addEventListener("submit", uploadFile);
