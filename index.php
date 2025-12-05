<!DOCTYPE html>
<html>
<head>
    <title>Clinic Form</title>
  
</head>
<style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

/* PAGE BACKGROUND */
body {
    min-height: 100vh;
    background: linear-gradient(135deg, #69b7ff, #a5f3fc);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* FORM CONTAINER */
.form-container {
    background: #ffffff;
    width: 100%;
    max-width: 420px;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    animation: fadeIn 0.6s ease-in-out;
}

/* TITLE */
.form-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #0f172a;
}

/* LABELS */
.form-container label {
    display: block;
    margin-top: 14px;
    margin-bottom: 6px;
    font-weight: bold;
    color: #1e293b;
    font-size: 14px;
}

/* INPUTS, SELECT, TEXTAREA */
.form-container input,
.form-container select,
.form-container textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #cbd5f5;
    outline: none;
    font-size: 14px;
    transition: 0.2s ease;
}

/* FOCUS EFFECT */
.form-container input:focus,
.form-container select:focus,
.form-container textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
}

/* TEXTAREA */
.form-container textarea {
    resize: none;
}

/* BUTTON */
.form-container button {
    width: 100%;
    margin-top: 22px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    background: linear-gradient(135deg, #2563eb, #38bdf8);
    color: #ffffff;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* BUTTON HOVER */
.form-container button:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 15px rgba(37, 99, 235, 0.4);
}

/* MOBILE RESPONSIVE */
@media (max-width: 480px) {
    .form-container {
        margin: 15px;
        padding: 25px 20px;
    }
}

/* ANIMATION */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
<body>

<?php if (isset($_GET['success'])): ?>
    <script>
        <?php if ($_GET['success'] == 1): ?>
            alert("Form submitted successfully!");
        <?php else: ?>
            alert("Error saving data. Please try again.");
        <?php endif; ?>

        if (window.history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('success');
            window.history.replaceState({}, document.title, url.toString());
        }
    </script>
<?php endif; ?>

<div class="form-container">
    <h2>Patient Information Form</h2>

    <form action="process.php" method="post">

        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age</label>
        <input type="number" id="age" name="age" min="0" required>

        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
            <option value="">-- select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required>

        <label for="symptoms">Symptoms / Reason for Visit</label>
        <textarea id="symptoms" name="symptoms" rows="4" required></textarea>

        <label for="payment">Payment Amount (₱)</label>
        <input type="number" id="payment" name="payment" min="0" step="0.01" required>

        <label for="payment_method">Payment Method</label>
        <select id="payment_method" name="payment_method" required>
            <option value="">-- select --</option>
            <option value="Cash">Cash</option>
            <option value="GCash">GCash</option>
        </select>

        <button type="submit">Submit Form</button>

    </form>
</div>

</body>
</html>
