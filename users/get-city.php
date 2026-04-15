<?php
include('includes/config.php');
if(!empty($_POST["stateid"])) {
    $state = $_POST["stateid"];
    
    // City Mapping for Indian States (Common cities)
    $cities = [
        "Andhra Pradesh" => ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Kurnool", "Others"],
        "Arunachal Pradesh" => ["Itanagar", "Tawang", "Ziro", "Others"],
        "Assam" => ["Guwahati", "Dibrugarh", "Silchar", "Jorhat", "Others"],
        "Bihar" => ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Others"],
        "Chhattisgarh" => ["Raipur", "Bhilai", "Bilaspur", "Others"],
        "Goa" => ["Panaji", "Margao", "Vasco da Gama", "Others"],
        "Gujarat" => ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Others"],
        "Haryana" => ["Gurgaon", "Faridabad", "Panipat", "Ambala", "Others"],
        "Himachal Pradesh" => ["Shimla", "Manali", "Dharamshala", "Others"],
        "Jharkhand" => ["Ranchi", "Jamshedpur", "Dhanbad", "Others"],
        "Karnataka" => ["Bangalore", "Mysore", "Hubli", "Mangalore", "Others"],
        "Kerala" => ["Thiruvananthapuram", "Kochi", "Kozhikode", "Others"],
        "Madhya Pradesh" => ["Indore", "Bhopal", "Jabalpur", "Gwalior", "Others"],
        "Maharashtra" => ["Mumbai", "Pune", "Nagpur", "Thane", "Nashik", "Others"],
        "Manipur" => ["Imphal", "Others"],
        "Meghalaya" => ["Shillong", "Others"],
        "Mizoram" => ["Aizawl", "Others"],
        "Nagaland" => ["Kohima", "Dimapur", "Others"],
        "Odisha" => ["Bhubaneswar", "Cuttack", "Rourkela", "Others"],
        "Punjab" => ["Ludhiana", "Amritsar", "Jalandhar", "Patiala", "Others"],
        "Rajasthan" => ["Jaipur", "Jodhpur", "Udaipur", "Kota", "Others"],
        "Sikkim" => ["Gangtok", "Others"],
        "Tamil Nadu" => ["Chennai", "Coimbatore", "Madurai", "Trichy", "Others"],
        "Telangana" => ["Hyderabad", "Warangal", "Nizamabad", "Others"],
        "Tripura" => ["Agartala", "Others"],
        "Uttar Pradesh" => ["Lucknow", "Kanpur", "Agra", "Varanasi", "Ghaziabad", "Noida", "Prayagraj", "Others"],
        "Uttarakhand" => ["Dehradun", "Haridwar", "Rishikesh", "Others"],
        "West Bengal" => ["Kolkata", "Howrah", "Durgapur", "Siliguri", "Others"],
        "Delhi" => ["New Delhi", "North Delhi", "South Delhi", "Others"],
        "Jammu and Kashmir" => ["Srinagar", "Jammu", "Others"],
        "Chandigarh" => ["Chandigarh"],
        "Puducherry" => ["Puducherry", "Others"]
    ];

    echo '<option value="">Select City</option>';
    if(isset($cities[$state])) {
        foreach($cities[$state] as $city) {
            echo '<option value="'.htmlentities($city).'">'.htmlentities($city).'</option>';
        }
    } else {
        echo '<option value="Others">Others</option>';
    }
}
?>
