let colors = [
  "#CDDBDB",
  "#E3CBEB",
  "#BEDBE7",
  "#FAC0D8",
  "#C0E8DD",
  "#E4D7DE",
  "#F1C6CF",
  "#C9C9ED",
]; // Define your colors as hexadecimal or RGB values
let currentColorIndex = 0; // Start with the first color

// Simulate new data insertion (replace this with actual code to fetch data from the database)
function simulateNewData() {
  // For demonstration purposes, let's say new data is added every 3 seconds
  setInterval(() => {
    addCard();
  }, 3000);
}

function addCard() {
  let container = document.getElementById("container");
  let card = document.createElement("div");
  card.classList.add("card");
  card.style.backgroundColor = colors[currentColorIndex]; // Set background color
  card.textContent = "Card " + (container.children.length + 1);
  container.appendChild(card);

  // Update current color index for the next card
  currentColorIndex = (currentColorIndex + 1) % colors.length;
}

// Start simulating new data insertion
simulateNewData();
