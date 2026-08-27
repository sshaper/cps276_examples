const student = {
  name: "Scott",
  course: "CPS276",
  score: 92
};

const asText = JSON.stringify(student, null, 2);
const backAgain = JSON.parse(asText);

const books = [
  { title: "1984", author: "Orwell" },
  { title: "Dune", author: "Herbert" }
];

let lines = [];
lines.push("Stringified student:");
lines.push(asText);
lines.push("");
lines.push("Parsed name: " + backAgain.name);
lines.push("");
lines.push("Books:");
JSON.parse(JSON.stringify(books)).forEach((book) => {
  lines.push(`${book.title} by ${book.author}`);
});

document.querySelector("#output").textContent = lines.join("\n");
console.log(asText);
console.log(backAgain);
