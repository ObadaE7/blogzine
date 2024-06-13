import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

window.Echo.channel("post-liked-channel").listen(".post-liked", (data) => {
    console.log("Post liked:", data);

    // Update the badge count
    const badge = document.getElementById("notificationBadge");
    let count = parseInt(badge.textContent);
    badge.textContent = count + 1;

    // Create the new notification item
    const notificationItem = document.createElement("li");

    const notificationContent = `
     <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/${data.user.avatar}') }}" class="avatar w-75 ps-2" alt="">
        </div>
        <div class="col-md-8 d-flex flex-column">
             <span>${data.user.fname} ${data.user.lname}</span>
            <span>liked your post</span>
        </div>
     </div>
    `;

    notificationItem.innerHTML = notificationContent;

    // Append the new notification to the dropdown
    const notificationDropdown = document.getElementById("notificationDropdown");
    notificationDropdown.appendChild(notificationItem);
});

