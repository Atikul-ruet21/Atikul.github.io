// Feature detection
document.documentElement.classList.remove("no-js");

// Theme management
const themeToggle = document.querySelector(".theme-toggle");
const setTheme = (isDark) => {
  document.documentElement.setAttribute(
    "data-theme",
    isDark ? "dark" : "light"
  );
  localStorage.setItem("theme", isDark ? "dark" : "light");
};

// Initialize theme
const savedTheme = localStorage.getItem("theme") || "light";
setTheme(savedTheme === "dark");

// Event listeners
themeToggle.addEventListener("click", () => {
  const isDark = document.documentElement.getAttribute("data-theme") === "dark";
  setTheme(!isDark);
});

// Dynamic content loading
const loadContent = async (path) => {
  try {
    const response = await fetch(`pages/${path}.html`);
    if (!response.ok) throw new Error("Network response was not ok");
    return await response.text();
  } catch (error) {
    console.error("Content load error:", error);
    return "<p>Content unavailable</p>";
  }
};

// Router
window.addEventListener("DOMContentLoaded", async () => {
  const mainContent = document.getElementById("main-content");
  const path = window.location.hash.substring(1) || "home";

  mainContent.innerHTML = await loadContent(path);
  window.scrollTo(0, 0);
});
