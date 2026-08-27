// Guided solutions for Chapter 11 practice.
// Try the exercises yourself first.

// Exercise 1
const firstName = "Scott";
const course = "CPS276";
const enrolled = true;
console.log(`${firstName} is enrolled in ${course}: ${enrolled}`);

// Exercise 2
const score = 72;
if (score >= 70) {
  console.log("pass");
} else {
  console.log("fail");
}

// Exercise 3
const rawEmail = "  Scott.Shaper@WCCNet.edu ";
const email = rawEmail.trim().toLowerCase();
console.log(email);
console.log(email.includes("@"));

// Exercise 4
const students = [
  { name: "Ava", score: 91 },
  { name: "Ben", score: 74 },
  { name: "Cara", score: 88 }
];
const topStudents = students.filter((student) => student.score >= 80);
console.log(topStudents);

// Exercise 5
function letterGrade(value) {
  if (value >= 90) return "A";
  if (value >= 80) return "B";
  if (value >= 70) return "C";
  return "F";
}
console.log(letterGrade(95), letterGrade(82), letterGrade(71), letterGrade(60));

// Challenge
function passingNames(list) {
  return list
    .filter((student) => student.score >= 70)
    .map((student) => student.name)
    .join(", ");
}
console.log(passingNames(students));
