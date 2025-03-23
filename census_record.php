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

<div id="dataList">
  <h2>Census Data List</h2>
  <input type="text" id="searchBar" placeholder="Search by Name/Household No.">
  <table id="dataTable">
    <thead>
      <tr>
        <th>Record ID</th>
        <th>Household ID</th>
        <th>Date Collected</th>
        <th>Census Enumerator</th>
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

      // Fetch all data from census_record table
      $sql = "SELECT cr.Record_ID, cr.Household_ID, cr.Date_Collected, u.name AS User_Name 
              FROM census_record cr 
              JOIN user u ON cr.User_ID = u.user_id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr onclick=\"window.location.href='members.php?household_id=" . $row["Household_ID"] . "'\">
                  <td>" . $row["Record_ID"] . "</td>
                  <td>" . $row["Household_ID"] . "</td>
                  <td>" . $row["Date_Collected"] . "</td>
                  <td>" . $row["User_Name"] . "</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
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