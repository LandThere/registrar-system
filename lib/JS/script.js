const body = document.querySelector("body");
const modeToggle = body.querySelector(".mode-toggle");
const sidebar = body.querySelector("nav");
const sidebarToggle = body.querySelector(".sidebar-toggle");

let getStatus = localStorage.getItem("status");
if (getStatus && getStatus === "open") {
  sidebar.classList.toggle("close");
}

sidebarToggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");

  // Close the dropdown menu when sidebar is closed
  if (sidebar.classList.contains("close")) {
    localStorage.setItem("status", "close");
    closeDropdownMenu();
  } else {
    localStorage.setItem("status", "open");
  }
});

// Get the dropdown menu and toggle elements
const dropdownMenu = document.querySelector('.dropdown-menu');
const dropdownToggle = document.querySelector('.dropdown-toggle');

// Hide the dropdown menu by default
dropdownMenu.style.display = 'none';

// Check if the dropdown menu should be open based on its stored state
const isDropdownOpen = localStorage.getItem('isDropdownOpen');
if (isDropdownOpen === 'true') {
  openDropdownMenu();
}

// Add a click event listener to the dropdown toggle element
dropdownToggle.addEventListener('click', function() {
  if (dropdownMenu.style.display === 'none') {
    openDropdownMenu();
  } else {
    closeDropdownMenu();
  }
});

function openDropdownMenu() {
  // Set the dropdown menu state to open
  localStorage.setItem('isDropdownOpen', 'true');

  // Update the dropdown menu and toggle elements
  dropdownMenu.style.display = 'block';
  dropdownToggle.classList.add('open');
  dropdownToggle.querySelector('.bi-caret-right-fill').style.transform = 'rotate(90deg)';
}

function closeDropdownMenu() {
  // Set the dropdown menu state to closed
  localStorage.setItem('isDropdownOpen', 'false');

  // Update the dropdown menu and toggle elements
  dropdownMenu.style.display = 'none';
  dropdownToggle.classList.remove('open');
  dropdownToggle.querySelector('.bi-caret-right-fill').style.transform = 'rotate(0deg)';
}

