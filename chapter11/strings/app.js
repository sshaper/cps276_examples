// Chapter 11 - Strings example

let course = "CPS276";
let place = "Washtenaw";
let message = `Welcome to ${course} at ${place}`;
console.log(message);

let raw = "  scott@wccnet.edu  ";
let email = raw.trim().toLowerCase(); // clean form-like input

console.log("cleaned email:", email);
console.log("length:", email.length); // property, not length()
console.log("includes @ ?", email.includes("@"));
console.log("slice(0, 5):", email.slice(0, 5));
console.log("split(@):", email.split("@"));

let tags = ["php", "js", "mysql"];
console.log("joined tags:", tags.join(", "));

// Extra: full name cleanup
let first = "  Scott ";
let last = " Shaper";
let fullName = `${first.trim()} ${last.trim()}`;
console.log("fullName:", fullName);
