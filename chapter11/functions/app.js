// Chapter 11 - Functions example

function greet() {
  console.log("Hello");
}

greet(); // parentheses run the function

function greetPerson(name) {
  // return sends a value back to the caller
  return `Hello, ${name}`;
}

console.log(greetPerson("Scott"));

function add(a, b) {
  return a + b;
}

console.log("3 + 4 =", add(3, 4));

function welcome(name = "Guest") {
  return `Welcome, ${name}`;
}

console.log(welcome());
console.log(welcome("Karen"));

const greetArrow = (name) => `Hello, ${name}`;
const addArrow = (a, b) => a + b;

console.log(greetArrow("Mike"));
console.log("10 + 5 =", addArrow(10, 5));

// Extra: letter grade helper
function letterGrade(score) {
  if (score >= 90) return "A";
  if (score >= 80) return "B";
  if (score >= 70) return "C";
  return "F";
}

console.log("letterGrade(92):", letterGrade(92));
console.log("letterGrade(60):", letterGrade(60));
