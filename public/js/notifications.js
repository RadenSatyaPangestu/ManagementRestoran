// notifications.js
document.addEventListener("DOMContentLoaded", function () {
    console.log("Notifications script loaded");

    // Fetch low stock items
    fetch("http://127.0.0.1:8000/api/low-stock-items")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Failed to fetch notifications");
            }
            return response.json();
        })
        .then((data) => {
            const notificationButton =
                document.querySelector(".btn-notifications");

            if (data.length > 0) {
                // Show notification badge
                const badge = document.createElement("span");
                badge.className =
                    "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger";
                badge.textContent = data.length;
                notificationButton.appendChild(badge);

                // Show notification dropdown
                const dropdown = document.createElement("ul");
                dropdown.className = "dropdown-menu dropdown-menu-end";
                data.forEach((item) => {
                    const listItem = document.createElement("li");
                    listItem.innerHTML = `<a class="dropdown-item" href="#">${item.name} stok rendah (${item.stock})</a>`;
                    dropdown.appendChild(listItem);
                });
                notificationButton.parentNode.appendChild(dropdown);

                // Toggle dropdown visibility
                notificationButton.addEventListener("click", () => {
                    dropdown.classList.toggle("show");
                });
            }
        })
        .catch((error) => {
            console.error("Error fetching notifications:", error);
        });
});
