const form = document.getElementById("appointmentForm");

form.addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("save_appointment.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("successMsg").style.display = "block";
        form.reset();
    })
    .catch(err => console.log(err));
});