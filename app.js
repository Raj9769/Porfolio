// Example: Simple form validation for the contact form
document.querySelector("form").addEventListener("submit", function(event) {
    let name = document.querySelector('input[name="name"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let message = document.querySelector('textarea[name="message"]').value;

    if (!name || !email || !message) {
        alert("Please fill out all fields!");
        event.preventDefault();  // Prevent form submission
    }
});
