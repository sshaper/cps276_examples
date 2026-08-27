// Chapter 11 - Conditionals and Loops example

let score = 82;

if (score >= 90) {
  console.log("A");
} else if (score >= 80) {
  console.log("B"); // 82 hits this branch
} else if (score >= 70) {
  console.log("C");
} else {
  console.log("Needs improvement");
}

let age = 20;
let status = age >= 18 ? "adult" : "minor";
console.log("status:", status);

for (let i = 0; i < 5; i++) {
  console.log("for loop i:", i);
}

const colors = ["red", "green", "blue"];
for (const color of colors) {
  console.log("color:", color);
}

// Extra: sum an array
const nums = [5, 10, 15];
let total = 0;
for (const n of nums) {
  total += n;
}
console.log("total:", total);
