function inputCompileStatus(event) {
  const input = event.target;
  if (input.value) input.classList.add("compiled");
  else input.classList.remove("compiled");
}

// Assign event listener to all inputs
const inputs = document.getElementsByClassName("input");
for (let i=0; i<inputs.length; i++) {
  inputs[i].addEventListener("keyup", inputCompileStatus)
}
