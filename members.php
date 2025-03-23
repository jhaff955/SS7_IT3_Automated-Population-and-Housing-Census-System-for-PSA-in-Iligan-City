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

        .header
        {
          margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <a href="homepage.php" class="back-button">Back</a>
</style>
</head>
<body>

<div id="dataList">
  <h2>Census Data List</h2>
  <input type="text" id="searchBar" placeholder="Search by Name/Household No.">
<table class="header">
    <thead>
        <tr >
            <th>Head Nof the Household</th>
            <th>Address</th>
            <th>Number of Members</th>
            <th>Housing Type</th>
            <th>Income Level</th>
            <th>Age</th>
            <th>Gender</th>
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
        $household_id = isset($_GET['household_id']) ? $_GET['household_id'] : '';
        // Fetch data from households table
        $sql = "SELECT * FROM household where household_id = '$household_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                                
                                <td>" . $row["Head_name"] . "</td>
                                <td>" . $row["Address"] . "</td>
                                <td>" . $row["Number_of_Members"] . "</td>
                                <td>" . $row["Housing_Type"] . "</td>
                                <td>" . $row["Income_Level"] . "</td>
                                <td>" . $row["Age"] . "</td>
                                <td>" . $row["Gender"] . "</td>
                            </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>
 
  <table id="dataTable">
    <thead>
      <tr>
        <th>Member ID</th>
        <th>Household ID</th>
        <th>Gender</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Birthdate</th>
        <th>Address</th>
        <th>Civil Status</th>
        <th>Occupation</th>
        <th>Contact Number</th>
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

      // Get household ID from URL
      $household_id = isset($_GET['household_id']) ? $_GET['household_id'] : '';

      // Fetch data from members table where household ID matches
      $sql = "SELECT * FROM members WHERE Household_ID = '$household_id'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row["Member_ID"] . "</td>
                  <td>" . $row["Household_ID"] . "</td>
                  <td>" . $row["Gender"] . "</td>
                  <td>" . $row["fname"] . "</td>
                  <td>" . $row["mname"] . "</td>
                  <td>" . $row["lname"] . "</td>
                  <td>" . $row["birthdate"] . "</td>
                  <td>" . $row["Address"] . "</td>
                  <td>" . $row["CivilStatus"] . "</td>
                  <td>" . $row["Occupation"] . "</td>
                  <td>" . $row["ContactNumber"] . "</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='11'>No data found</td></tr>";
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
    const householdNo = cells[1].textContent.toLowerCase();
    const name = cells[3].textContent.toLowerCase();
    if (householdNo.includes(searchTerm) || name.includes(searchTerm)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});
</script>

</body>
</html>