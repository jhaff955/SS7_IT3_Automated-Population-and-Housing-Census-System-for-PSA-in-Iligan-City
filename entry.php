<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$name = isset($_SESSION['Name']) ? $_SESSION['Name'] : 'Guest';
$id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
?>


<!DOCTYPE html>
<html>
<head>
<title>PSA Census Data Entry</title>
<style>
body {
  font-family: sans-serif;
  background-color: #004d99 ;
  color: white;
}

#censusForm {
  width: 500px;
  margin: 60px auto;
  border: 1px solid #ccc;
  padding: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input, select {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 15px;
  border: none;
  cursor: pointer;
}

#dataList {
  width: 80%;
  margin: 80px auto;
  border: 1px solid #ccc;
  padding: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #4CAF50;
}

#searchBar {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  box-sizing: border-box;

 }
        .back-button {
            position: absolute;
            margin: 20px;
            top: 20px;
            right: 20px;
            background: dodgerblue;
            color: white;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <a href="homepage.php" class="back-button">Back</a>
</style>
</head>
<body>

<form id="censusForm" method="post" action="process_entry.php">
  <h2>Census Data Entry</h2>
  <label for="householdNo">Household Number:</label>
  <input type="text" id="householdNo" name="householdNo">

  <label for="name">Name:</label>
  <input type="text" id="name" name="name">

  <label for="age">Age:</label>
  <input type="number" id="age" name="age">

  <label for="gender">Gender:</label>
  <select id="gender" name="gender">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    <option value="Other">Other</option>
  </select>

  <label for="address">Address:</label>
  <input type="text" id="address" name="address">

  <label for="income">Income Level:</label>
  <input type="text" id="income" name="income">

  <label for="members">Number of Members:</label>
  <input type="number" id="members" name="members">

  <label for="housingType">Housing Type:</label>
  <input type="text" id="housingType" name="housingType">

  <button type="submit">Add Data</button>
</form>

<div id="dataList">
  <h2>Census Data List</h2>
  <input type="text" id="searchBar" placeholder="Search by Name/Household No.">
  <table id="dataTable">
    <thead>
      <tr>
        <th>Household ID</th>
        <th>Head of Household</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Income Level</th>
        <th>Number of Members</th>
        <th>Housing Type</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Database connection
      include 'connect.php';

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Fetch data from household table
      $sql = "SELECT * FROM household";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row["Household_ID"] . "</td>
                  <td>" . $row["Head_name"] . "</td>
                  <td>" . $row["Age"] . "</td>
                  <td>" . $row["Gender"] . "</td>
                  <td>" . $row["Address"] . "</td>
                  <td>" . $row["Income_Level"] . "</td>
                  <td>" . $row["Number_of_Members"] . "</td>
                  <td>" . $row["Housing_Type"] . "</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</div>

<script>
let censusData = [];

document.getElementById("searchBar").addEventListener("input", function() {
  const searchTerm = this.value.toLowerCase();
  const rows = document.querySelectorAll("#dataTable tbody tr");
  rows.forEach(row => {
    const cells = row.querySelectorAll("td");
    const householdNo = cells[0].textContent.toLowerCase();
    const name = cells[1].textContent.toLowerCase();
    if (householdNo.includes(searchTerm) || name.includes(searchTerm)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});

document.querySelectorAll("#dataTable tbody tr").forEach(row => {
  row.addEventListener("click", function() {
    const householdId = this.querySelector("td").textContent;
    window.location.href = `members.php?household_id=${householdId}`;
  });
});
</script>

</body>
</html>