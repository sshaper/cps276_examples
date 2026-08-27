// Chapter 11 - Operators example

let a = 10;
let b = 3;

console.log("a + b =", a + b);
console.log("a % b =", a % b); // remainder

console.log("5 + 5 =", 5 + 5);     // math -> 10
console.log('"5" + 5 =', "5" + 5); // concatenation -> "55"
console.log('Number("5") + 5 =', Number("5") + 5);

console.log("5 === 5:", 5 === 5);
console.log('5 === "5":', 5 === "5"); // false: different types
console.log('5 == "5":', 5 == "5");   // true, but avoid ==

let age = 20;
let hasId = true;

if (age >= 18 && hasId) {
  console.log("Allowed");
}

let name = "";
if (!name) {
  console.log("Name is empty");
}

// Extra: pass/fail
let score = 72;
if (score >= 70) {
  console.log("Pass");
} else {
  console.log("Fail");
}
