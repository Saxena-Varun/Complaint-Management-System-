<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "cms", 3307);
if (!$conn) die("Connection failed: " . mysqli_connect_error());

// Temporarily disable STRICT mode
mysqli_query($conn, "SET SESSION sql_mode = ''");

// Fix invalid default for lastUpdationDate
mysqli_query($conn, "ALTER TABLE tblcomplaints MODIFY lastUpdationDate timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()");

// 1. Alter tblcomplaints to add city and address. 
// We check if they exist first.
$res = mysqli_query($conn, "SHOW COLUMNS FROM tblcomplaints LIKE 'city'");
if (mysqli_num_rows($res) == 0) {
    mysqli_query($conn, "ALTER TABLE tblcomplaints ADD COLUMN city VARCHAR(255) AFTER state");
}
$res = mysqli_query($conn, "SHOW COLUMNS FROM tblcomplaints LIKE 'address'");
if (mysqli_num_rows($res) == 0) {
    mysqli_query($conn, "ALTER TABLE tblcomplaints ADD COLUMN address TEXT AFTER city");
}

// 2. Empty category, subcategory, state
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
mysqli_query($conn, "TRUNCATE TABLE category");
mysqli_query($conn, "TRUNCATE TABLE subcategory");
mysqli_query($conn, "TRUNCATE TABLE state");
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");

// 3. Insert specific Indian states
$states = [
    "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", 
    "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", 
    "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", 
    "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal", "Andaman and Nicobar Islands", "Chandigarh", 
    "Dadra and Nagar Haveli and Daman and Diu", "Delhi", "Jammu and Kashmir", "Ladakh", "Lakshadweep", "Puducherry"
];

foreach ($states as $s) {
    $stmt = mysqli_prepare($conn, "INSERT INTO state (stateName, stateDescription, postingDate) VALUES (?, '', NOW())");
    mysqli_stmt_bind_param($stmt, "s", $s);
    mysqli_stmt_execute($stmt);
}

// 4. Insert categories and subcategories
$categories = [
    "Infrastructure & Roads (PWD)" => ["Potholes", "Broke Road", "Cracked Surface", "Water logging on Road", "Damaged Foothpath", "Missing / Broken Divider", "Road Marking Faded", "Construction Delay", "Illegal Road Blocking", "Others"],
    "Electricity" => ["Street Light", "Flickering Light", "Broken Pole", "Exposed Wires", "Transformer Issue", "Power Cut / No Electricity", "Low Voltage", "Electric Pole Damage", "Others"],
    "Water Supply & Drainage" => ["No Water Supply", "Water Leakage", "Dirty / Contaminated Water", "Low Water Pressure", "Burst Pipe", "Drain Blockage", "Overflowing Drain", "Open Drain Issue", "Others"],
    "Sanitation and Garbage" => ["Garbage Not Collected", "Overflowing Dustbin", "Garbage on Road", "Dead Animal Waste", "Public Toilet Dirty", "No Dustbin Available", "Waste Burning", "Sewage Smell", "Others"],
    "Environment & Pollution" => ["Air Pollution", "Water Pollution", "Noise Pollution", "Illegal Tree Cutting", "Dust Pollution", "Industrial Pollution", "Waste Dumping", "River/Lake Pollution", "Others"],
    "Police & Traffic" => ["Traffic Jam", "Illegal Parking", "Signal Not Working", "Rash Driving", "Road Accident", "Theft / Robbery", "Harassment", "Suspicious Activity", "Others"],
    "Health & Public Safety" => ["Unhygienic Area", "Mosquito Breeding", "Open Medical Waste", "Food Safety Violation", "Unsafe Drinking Water", "Disease Outbreak", "Stray Dogs Threat", "Others"],
    "Education" => ["Poor Infrastructure", "Teacher Absence", "Cleanliness Issue", "No Electricity/Water in School", "Safety Issue", "Fee Complaint", "Others"],
    "Municipal Services" => ["Birth/Death Certificate Issue", "Property Tax Issue", "Encroachment", "Illegal Construction", "Building Safety Issue", "Drain Cleaning Delay", "Others"],
    "Housing & Urban Planning" => ["Illegal Construction", "Building Plan Approval Delay", "Encroachment", "Slum Area Issue", "Housing Scheme Issue", "Others"],
    "Emergency Services" => ["Fire Hazard", "No Fire Safety Equipment", "Emergency Response Delay", "Disaster Issue (Flood/Earthquake)", "Others"],
    "Animal Control" => ["Stray Dogs", "Stray Cattle", "Animal Attack", "Dead Animal Removal", "Animal Abuse", "Others"],
    "Transport Department" => ["Bus Not Stopping", "Overcrowding", "Rash Driving (Public Transport)", "Route Issue", "Ticket Issue", "Others"],
    "Telecom & Internet" => ["No Network", "Slow Internet", "Call Drop", "Tower Issue", "Broadband Not Working", "Others"],
    "Others" => ["Others"]
];

foreach ($categories as $cat => $subs) {
    // Insert Category
    mysqli_query($conn, "INSERT INTO category (categoryName, categoryDescription, creationDate) VALUES ('" . mysqli_real_escape_string($conn, $cat) . "', '', NOW())");
    $cat_id = mysqli_insert_id($conn);
    
    foreach ($subs as $sub) {
        mysqli_query($conn, "INSERT INTO subcategory (categoryid, subcategory, creationDate) VALUES ('$cat_id', '" . mysqli_real_escape_string($conn, $sub) . "', NOW())");
    }
}

echo "Database successfully updated!";
?>
