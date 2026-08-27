// Chapter 11 - Arrays and Objects example

const names = ["Scott", "Karen", "Mike"];
names.push("Judy"); // const still allows changing contents
console.log("names:", names);
console.log("first name (index 0):", names[0]);

names.forEach((name) => {
  console.log("Student:", name);
});

const scores = [90, 70, 85, 60];
const curved = scores.map((score) => score + 5);
const passing = scores.filter((score) => score >= 70);
console.log("curved:", curved);
console.log("passing:", passing);

const student = {
  firstName: "Scott",
  lastName: "Shaper",
  course: "CPS276",
  credits: 4
};

console.log("student.firstName:", student.firstName);
student.credits = 3;
console.log("updated student:", student);

const books = [
  { title: "1984", author: "Orwell" },
  { title: "Dune", author: "Herbert" }
];

books.forEach((book) => {
  console.log(`${book.title} by ${book.author}`);
});
