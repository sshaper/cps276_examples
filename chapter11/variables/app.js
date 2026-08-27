// Chapter 11 - Variables example
// Open index.html, press F12, read each log message.

let firstName = "Scott"; // can change later because of let
let age = 45;            // number — no quotes
const school = "WCC";    // will not be reassigned

firstName = "Karen";     // allowed with let
// school = "UM";        // would throw an error

let title = "CPS276";
let seats = 24;
let isOpen = true;
let middleName;          // undefined — declared, not set
let selected = null;     // empty on purpose

console.log("firstName:", firstName);
console.log("school:", school);
console.log("typeof title:", typeof title);
console.log("typeof seats:", typeof seats);
console.log("typeof isOpen:", typeof isOpen);
console.log("middleName:", middleName);
console.log("selected:", selected);

// Extra demo: a counter needs let
let clicks = 0;
clicks += 1;
clicks += 1;
console.log("clicks after two updates:", clicks);
