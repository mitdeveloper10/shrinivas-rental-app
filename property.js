document.addEventListener("DOMContentLoaded", function () {
    // Select all delete buttons
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Find the parent property card and remove it
            const propertyCard = this.closest(".property");

            if (propertyCard) {
                propertyCard.remove();
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const propertyCard = this.closest(".property");
            const title = propertyCard.querySelector("h3");
            const location = propertyCard.querySelector("p:nth-of-type(1)");
            const price = propertyCard.querySelector("p:nth-of-type(2)");

            // Prompt user for new values
            const newTitle = prompt("Enter new property title:", title.textContent);
            const newLocation = prompt("Enter new location:", location.textContent.replace("Location: ", ""));
            const newPrice = prompt("Enter new price:", price.textContent.replace("Price: ", ""));

            // Update only if user entered a value
            if (newTitle) title.textContent = newTitle;
            if (newLocation) location.textContent = "Location: " + newLocation;
            if (newPrice) price.textContent = "Price: " + newPrice;
        });
    });
});

//add new propertys
document.addEventListener('DOMContentLoaded', function () {
    loadProperties();
});

function openAddPropertyModal() {
    document.getElementById('addPropertyModal').style.display = 'block';
}

function closeAddPropertyModal() {
    document.getElementById('addPropertyModal').style.display = 'none';
}

function openEditModal(propertyId) {
    const property = document.getElementById(propertyId);
    document.getElementById('editPropertyId').value = propertyId;
    document.getElementById('editName').value = property.querySelector('.property-name').innerText;
    document.getElementById('editLocation').value = property.querySelector('.property-location').innerText;
    document.getElementById('editPrice').value = property.querySelector('.property-price').innerText;

    document.getElementById('editPropertyModal').style.display = 'block';
}

function closeEditPropertyModal() {
    document.getElementById('editPropertyModal').style.display = 'none';
}

function deleteProperty(propertyId) {
    if (confirm('Are you sure you want to delete this property?')) {
        document.getElementById(propertyId).remove();
        saveProperties();
    }
}

function saveNewProperty() {
    const propertyName = document.getElementById('propertyName').value;
    const propertyLocation = document.getElementById('propertyLocation').value;
    const propertyPrice = document.getElementById('propertyPrice').value;
    const propertyImages = document.getElementById('propertyImages').files;

    if (!propertyName || !propertyLocation || !propertyPrice || propertyImages.length === 0) {
        alert('All fields are required!');
        return;
    }

    const propertyId = `property-${Date.now()}`;

    let imagePreview = '';
    for (let i = 0; i < propertyImages.length; i++) {
        const url = URL.createObjectURL(propertyImages[i]);
        imagePreview += `<img src="${url}" class="property-image">`;
    }

    const propertyHTML = `
        <div class="property" id="${propertyId}">
            ${imagePreview}
            <div class="property-info">
                <h3 class="property-name">${propertyName}</h3>
                <p class="property-location">${propertyLocation}</p>
                <p class="property-price">${propertyPrice}</p>
                <button class="edit-btn" onclick="openEditModal('${propertyId}')">Edit</button>
                <button class="delete-btn" onclick="deleteProperty('${propertyId}')">Delete</button>
            </div>
        </div>
    `;

    document.getElementById('propertyList').innerHTML += propertyHTML;
    closeAddPropertyModal();
    saveProperties();
}

// Get modal and buttons
const addPropertyModal = document.getElementById("addPropertyModal");
const addPropertyBtn = document.getElementById("openAddPropertyModal");
const closeAddPropertyBtn = document.getElementById("closeAddProperty");

// Open modal function
function openAddPropertyModal() {
    addPropertyModal.classList.add("show-modal");
}

// Close modal function
function closeAddPropertyModal() {
    addPropertyModal.classList.remove("show-modal");
}

// Event listeners
addPropertyBtn.addEventListener("click", openAddPropertyModal);
closeAddPropertyBtn.addEventListener("click", closeAddPropertyModal);



function openEditPropertyModal() {
    document.getElementById("editPropertyModal").classList.add("show-modal");
}

function closeEditPropertyModal() {
    document.getElementById("editPropertyModal").classList.remove("show-modal");
}
