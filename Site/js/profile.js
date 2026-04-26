const API_BASE_URL = "/API/public";
const API_KEY = "e8f1997c763";

const currentUser = JSON.parse(sessionStorage.getItem("user"));
const profileForm = document.getElementById("profileForm");

/**
 * Renders profile form.
 */
function renderProfile() {
    let html = `
        <form id="updateProfileForm">
            <div class="mb-3">
                <label for="employee_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="employee_name" value="${currentUser.employee_name}" required>
            </div>
            <div class="mb-3">
                <label for="employee_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="employee_email" value="${currentUser.employee_email}" required>
            </div>
            <div class="mb-3">
                <label for="employee_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="employee_password" placeholder="Leave blank to keep current">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    `;
    profileForm.innerHTML = html;

    document.getElementById("updateProfileForm").addEventListener("submit", updateProfile);
}

/**
 * Updates profile.
 */
async function updateProfile(event) {
    event.preventDefault();

    const name = document.getElementById("employee_name").value;
    const email = document.getElementById("employee_email").value;
    const password = document.getElementById("employee_password").value;

    const data = { employee_name: name, employee_email: email };
    if (password) data.employee_password = password;

    const response = await fetch(`${API_BASE_URL}/bikestores/employees/${currentUser.employee_id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-API-Key": API_KEY
        },
        body: JSON.stringify(data)
    });

    if (response.ok) {
        alert("Profile updated successfully");
        // Update sessionStorage
        currentUser.employee_name = name;
        currentUser.employee_email = email;
        sessionStorage.setItem("user", JSON.stringify(currentUser));
        location.reload();
    } else {
        alert("Failed to update profile");
    }
}

renderProfile();